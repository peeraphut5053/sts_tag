<?php
while (list($key, $data) = each($_GET) OR list($key, $data) = each($_POST)) {
	${$key} = trim($data);
}

//echo "<pre>";
//print_r($_GET);
//print_r($_POST);
//exit();
include "./initial.php";

$temp = new ReplaceHtml("../template/print_tag_coil.html");
$cSql = new SqlSrv();


if (isset($_POST["coil_ids"])) {
	$ci_n = count($_POST["coil_ids"]);
	$g = array();
	for ($t=0; $t<$ci_n; $t++) {
		$temp->setReplace("{printlist}", $temp->getTemplate("../template/tag_coil_block.html"));	

		$id = $_POST["coil_ids"][$t];
		$sql = "select *, CONVERT(VARCHAR(16), mfg_date, 120)  AS mfg_date from Mv_Bc_tag where id = '".$id."';";
		$rs = $cSql->SqlQuery($conn, $sql);
		$temp->setReplace("{reprint}", "".true."");
		$temp->setReplace("{barcode}", "".$id."");		
		$temp->setReplace("{Uf_Grade}", "".$rs[1]["uf_spec"]."");
		$temp->setReplace("{qty_rec}", "".total_format($rs[1]["qty1"])."");	
		$temp->setReplace("{Uf_coil_no}", "".$rs[1]["uf_coil_no"]."");
		$temp->setReplace("{mdate}", "".dateformat($rs[1]["mfg_date"], "d/m/Y")."");
		$temp->setReplace("{uf_Width}", "".$rs[1]["uf_Tickness"]." x ".total_format($rs[1]["uf_width"],2)."");
		$temp->setReplace("{name}", "".$rs[1]["uf_name"]."");
		$temp->setReplace("{lot}", "".$rs[1]["lot"]."");
		$temp->setReplace("{item}", "".$rs[1]["item"]."");
		$temp->setReplace("{po_num}", "".$rs[1]["po_num"]."");

		$temp->setReplace("{grndata}", json_encode($g));
		$temp->setReplace("{ids}", json_encode($g));
	}
} else {
	/*$sql = "select TOP 1 id from Mv_Bc_tag order by id desc;";
	$rs = $cSql->SqlQuery($conn, $sql);
	if (isset($rs[1]["id"])) {
		$id_last = explode("-",$rs[1]["id"]);
		if ($id_last[0] == date("ymd")) {	
			$id_next = intval(''.$id_last[1].'');
		} else {
			$id_next = 0;
		}
	} else {
		$id_next = 0;
	}*/

	//Gen Id update 24/5/2560
	$ip = $_SERVER['REMOTE_ADDR']; //Get user IP
	$ip_a = explode(".", $ip);
	$ipc = sprintf("%'.03d", $ip_a[3]);
	$idl = date("ymd").$ipc;
	$sql = "select TOP 1 id from Mv_Bc_tag where id like '".$idl."%' order by id desc;";
	$rs = $cSql->SqlQuery($conn, $sql);
	if (isset($rs[1]["id"])) {	
		$id_last = substr($rs[1]["id"], -4);
		$id_next = intval(''.$id_last.'');
	} else {
		$id_next = 0;
	}	
	//==

	$s_tag = count($_POST["tag_ids"]);
	$id_a = array();
	$tag = [];
	for ($t=0; $t<$s_tag; $t++) {
		$temp->setReplace("{printlist}", $temp->getTemplate("../template/tag_coil_block.html"));	
		
		//$id_next += 1;
		//$id = date("ymd")."-".sprintf("%'.06d", $id_next);	
		$id_next += 1;
		$id = $idl.sprintf("%'.04d", $id_next);	
		$ids[$t] = $id;

		$tid = array();
		$tid = explode("!!", $_POST["tag_ids"][$t]);
		
		$sql = "select *, CONVERT(VARCHAR(16), grn_hdr_date, 120)  AS grn_hdr_date from MV_GRN WHERE grn_num = '".$tid[0]."' and po_num = '".$tid[1]."' and lot = '".$tid[2]."' and item = '".$tid[3]."';";
		$rs = $cSql->SqlQuery($conn, $sql);
			
		$temp->setReplace("{barcode}", "".$id."");
		if (isset($rs[1]["Uf_Grade"])) $grade = $rs[1]["Uf_Grade"];
		else $grade = "";
		 if (isset($rs[1]["uf_Width"])) $ufw = $rs[1]["uf_Width"];
		else $ufw = 0;
		$temp->setReplace("{Uf_Grade}", "".$grade."");
		$temp->setReplace("{qty_rec}", "".total_format($rs[1]["qty_rec"])."");	
		$temp->setReplace("{Uf_coil_no}", "".$rs[1]["Uf_coil_no"]."");
		$temp->setReplace("{mdate}", "".dateformat($rs[1]["grn_hdr_date"], "d/m/Y")."");
		//$temp->setReplace("{uf_Width}", "".$rs[1]["uf_Thickness"]." x ".total_format($ufw,2)."");
		$temp->setReplace("{uf_Width}", "".(isset($rs[1]["Uf_thickness"])? $rs[1]["Uf_thickness"]:"")." x ".total_format($ufw,2)."");
		$temp->setReplace("{name}", "".$rs[1]["name"]."");
		$temp->setReplace("{lot}", "".$rs[1]["lot"]."");
		$temp->setReplace("{item}", "".$rs[1]["item"]."");
		$temp->setReplace("{po_num}", "".$rs[1]["po_num"]."");
		array_push( $tag, $_POST["tag_ids"][$t]);
	}	
	$temp->setReplace("{grndata}", "" . implode("??", $tag) . "");
    $temp->setReplace("{ids}", "" . implode("!!", $ids) . "");
	
}
$temp->setReplace("{printlist}", "");
echo $temp->getReplace();

sqlsrv_close($conn);
?>