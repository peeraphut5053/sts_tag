<?php
while (list($key, $data) = each($_GET) OR list($key, $data) = each($_POST)) {
	${$key} = trim($data);
}

$temp->setReplace("{crumb}", 'พิมพ์แท็กบาร์โค้ด  <img src="./image/next.png" border="0" align="absmiddle">ประวัติการพิมพ์แท็กสลิต');
$temp->setReplace("{pagename}", ' <img src="./image/next.png" border="0" align="absmiddle">พิมพ์แท็กสลิต');
$temp->setReplace("{content}", $temp->getTemplate("./template/tag_slit.html"));
$cSql = new SqlSrv();

$pdate = date("d/m/Y");

$jobm = explode("+", $jobno);

$sql = "select * from MV_Job where ltrim(job) = '".$jobm[0]."' and suffix = '".$jobm[1]."' and oper_num = '".$jobm[2]."';";
$rs = $cSql->SqlQuery($conn, $sql);
$temp->setReplace("{job_no}", "".$jobno."");
$temp->setReplace("{item}", "".$rs[1]["item"]."");
//$temp->setReplace("{item_desc}", "".$rs[1]["item_desc"]."");
if (strpos($rs[1]["item_desc"] , '"'))
	$temp->setReplace("{item_desc}", "'".$rs[1]["item_desc"]."'");
elseif (strpos($rs[1]["item_desc"] , "'"))
	$temp->setReplace("{item_desc}", "\"".$rs[1]["item_desc"]."\"");
else 
	$temp->setReplace("{item_desc}", "\"".$rs[1]["item_desc"]."\"");
$temp->setReplace("{oper_num}", "".$rs[1]["oper_num"]."");
$temp->setReplace("{wc}", "".$rs[1]["wc"]."");
$temp->setReplace("{description}", "".$rs[1]["description"]."");
$weight_released = total_format($rs[1]["qty_released"] * $rs[1]["unit_weight"]);
$temp->setReplace("{weight_released}", "".$weight_released."");
$temp->setReplace("{uf_sts_job}", "".$rs[1]["uf_sts_job"]."");
$temp->setReplace("{tw}", "".$tolerances_weight."");
$uf_sts_job = $rs[1]["uf_sts_job"];
$temp->setReplace("{uf_Width}", "".$rs[1]["uf_Width"].""); //25-10-2017
//$temp->setReplace("{Uf_qty_slit}", "".$rs[1]["Uf_qty_slit"].""); //30-11-2017

$sql = "select * from MV_Job_Tran where ltrim(job) = '".$jobm[0]."' and suffix = '".$jobm[1]."' and oper_num = '".$jobm[2]."';";
$rs = $cSql->SqlQuery($conn, $sql);
$qty_complete = 0;
if (isset($rs[1]["qty_complete"])) $qty_complete += $rs[1]["qty_complete"];
$temp->setReplace("{qty_complete}", "".total_format($qty_complete)."");

$sql = "select * from Mv_Bc_tag where ltrim(job) = '".$jobm[0]."' and suffix = '".$jobm[1]."' and oper_num = '".$jobm[2]."' and active = '1';";
$rs = $cSql->SqlQuery($conn, $sql);
//echo $sql;
$uf_act_Weight1 = 0;
for($i=1; $i<=$rs[0][0]; $i++) {	
	$uf_act_Weight1 += $rs[$i]["uf_act_Weight"];
}
$temp->setReplace("{uf_act_Weight1}", "".total_format($uf_act_Weight1)."");

$sql = "select * from MV_SLIT_ON_LOC where uf_sts_job = '".$uf_sts_job."';";
$rs = $cSql->SqlQuery($conn, $sql);
$op_slit_lot = '<option value=" "> </option>';
//$op_slit_lot .= '<option value="1703280001||SAHA||SPHC">1703280001</option>';
//$op_slit_lot .= '<option value="1703280002||SAHA||SPHC">1703280002</option>';
$hwd= "";
$hwg = "";
for($i=1; $i<=$rs[0][0]; $i++) {
	$vl = $rs[$i]["slit_lot"]."_a_".$rs[$i]["Uf_manu"]."_a_".$rs[$i]["uf_grade"]."_a_".$rs[$i]["slit_lot"];
	$op_slit_lot .= '<option value="'.$vl.'">'.$rs[$i]["slit_lot"].'</option>';
	//$hwd .= '<input name="d'.$vl.'" type="hidden" id="d'.$vl.'" value="'.$rs[$i]["uf_act_Width"].'">';
	//$hwg .= '<input name="g'.$vl.'" type="hidden" id="g'.$vl.'" value="'.$rs[$i]["uf_act_Weight"].'">';
}
$temp->setReplace("{op_slit_lot}", $op_slit_lot);
$temp->setReplace("{hidden_w}", $hwd.$hwg);
$temp->setReplace("{pdate}", "".$pdate."");
if (isset($_COOKIE["sts_no"])) $sts_no_c = $_COOKIE["sts_no"];
else $sts_no_c  = "";
$temp->setReplace("{sts_no}", "".$sts_no_c."");

//*Lot fix
$sql = "select count(lot) as lotl  from Mv_Bc_tag where lot like '".$jobm[0]."%' and active = '1';";
$rs = $cSql->SqlQuery($conn, $sql);
$lot = $jobm[0]."-".sprintf("%'.04d", ($rs[1]["lotl"] + 1));
$temp->setReplace("{lot}", $lot);
?>