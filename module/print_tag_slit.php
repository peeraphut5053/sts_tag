<?php
while (list($key, $data) = each($_GET) OR list($key, $data) = each($_POST)) {
	${$key} = trim($data);
}

//echo "<pre>";
//print_r($_GET);
//exit();
include "./initial.php";

$temp = new ReplaceHtml("../template/print_tag_slit.html");
$cSql = new SqlSrv();

if (isset($_POST["tag_ids"])) {
	$s_tag = count($_POST["tag_ids"]);
	for ($t=0; $t<$s_tag; $t++) {
		$temp->setReplace("{printlist}", $temp->getTemplate("../template/tag_slit_block.html"));	
		$id = $_POST["tag_ids"][$t];
		$sql = "select *, CONVERT(VARCHAR(16), print_date, 120)  AS print_date from Mv_Bc_tag where id = '".$id."';";
		$rs = $cSql->SqlQuery($conn, $sql);
		$item = $rs[1]["item"];
		$sql1 = "select * from item_mst where item = '".$item."';";
		$rs1 = $cSql->SqlQuery($conn, $sql1);
		if (isset($rs1[1]["Uf_width"])) $ufwidth = " x ".$rs1[1]["Uf_width"];
		else $ufwidth = "";
		$temp->setReplace("{barcode}", "".$id."");
		$temp->setReplace("{uf_Width}", $rs1[1]["Uf_thickness"].$ufwidth);
		$temp->setReplace("{qty_rec}", "".total_format($rs[1]["qty1"])."");
		$temp->setReplace("{mdate}", "".dateformat($rs[1]["print_date"], "d/m/Y")."");
		//$temp->setReplace("{job}", "".$rs[1]["job"]."");
		$temp->setReplace("{Uf_manu}", "".$rs[1]["Uf_manu"]."");
		$temp->setReplace("{uf_spec}", "".$rs[1]["uf_spec"]."");
		$temp->setReplace("{lot}", "".$rs[1]["lot"]."");
		$temp->setReplace("{item}", "".$rs[1]["item"]."");
		$temp->setReplace("{Uf_Grade}", "".$rs[1]["uf_grade"]."");
		
		$sql2 = "select Uf_qty_slit from job_mst where job = '".$rs[1]["job"]."' AND suffix = '".$rs[1]["suffix"]."';";
		$rs2 = $cSql->SqlQuery($conn, $sql2);		 
		$numtab = $rs[1]["uf_pack"]."/".$rs2[1]["Uf_qty_slit"];
		$temp->setReplace("{numtab}", "".$numtab."");		
		$temp->setReplace("{sts_no}", "".$rs[1]["sts_no"]."");		
	}
} else {
	$temp->setReplace("{printlist}", $temp->getTemplate("../template/tag_slit_block.html"));

	$jobm = explode("+", $job_no);
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
	}		
	$id_next += 1;
	$id = date("ymd")."-".sprintf("%'.06d", $id_next);*/

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
	$id_next += 1;
	$id = $idl.sprintf("%'.04d", $id_next);	
	//==

	$sql1 = "select * from item_mst where item = '".$item."';";
	$rs1 = $cSql->SqlQuery($conn, $sql1);
	if (isset($rs1[1]["Uf_width"])) $ufwidth = " x ".$rs1[1]["Uf_width"];
	else $ufwidth = "";
	
	if (isset($slit_lot)) {
		$slot = explode("_a_", $slit_lot);
	} else {
		$slot[0] = $slit_lotm;
	}
	
	$temp->setReplace("{Uf_Grade}", "".$rs1[1]["Uf_Grade"]."");
	$temp->setReplace("{lot}", "".$slot[0].$lot."");
	$temp->setReplace("{barcode}", "".$id."");
	$temp->setReplace("{uf_Width}", $rs1[1]["Uf_thickness"].$ufwidth);
	$temp->setReplace("{qty_rec}", "".total_format($uf_act_Weight)."");
	$temp->setReplace("{mdate}", "".$pdate."");
	$temp->setReplace("{item}", "".$item."");
	if (isset($slot[1])) $temp->setReplace("{Uf_manu}", "".$slot[1]."");
	else $temp->setReplace("{Uf_manu}", "");
	if (isset($slot[2])) $temp->setReplace("{uf_spec}", "".$slot[2]."");
	else $temp->setReplace("{uf_spec}", "");
	
	$sql2 = "select Uf_qty_slit from job_mst where job = '".$jobm[0]."' AND suffix = '".$jobm[1]."';";
	$rs2 = $cSql->SqlQuery($conn, $sql2);	
	$uf_pack = (int) substr($lot, 1, -1);
	$numtab = $uf_pack."/".$rs2[1]["Uf_qty_slit"];
	$temp->setReplace("{numtab}", "".$numtab."");
	$temp->setReplace("{sts_no}", "".$sts_no."");
	setcookie("sts_no",$sts_no, time() + (86400 * 30), "/");
	//echo $_COOKIE["sts_no"]."xxx";
}
$temp->setReplace("{printlist}", "");
echo $temp->getReplace();

sqlsrv_close($conn);
?>