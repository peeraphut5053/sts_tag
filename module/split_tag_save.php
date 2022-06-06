<?php
while (list($key, $data) = each($_GET) OR list($key, $data) = each($_POST)) {
	${$key} = trim($data);
}
include "./initial.php";

//echo "<pre>";
//print_r($_POST);
//exit();
$cSql = new SqlSrv();




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
$id_new = $idl.sprintf("%'.04d", $id_next);	
//==

$sql = "select *, CONVERT(VARCHAR(16), mfg_date, 120) as mfg_date from Mv_Bc_tag where id = '".$id."';";
$rs = $cSql->SqlQuery($conn, $sql);

$job = trim($rs[1]["job"]);
if ($job) {
	$job1 = "'".$job."'";
    $suffix = trim($rs[1]["suffix"]);
	$oper_num = trim($rs[1]["oper_num"]);
} else {
	$job1 = "NULL";
	$suffix = "NULL";
	$oper_num = "NULL";
}

//$suffix = trim($rs[1]["suffix"]);
//if (!$suffix)  $suffix = "NULL";

//$oper_num = trim($rs[1]["oper_num"]);
//if (!$oper_num)  $oper_num = "NULL";

$item = $rs[1]["item"];
$lot = $rs[1]["lot"];
$uf_grade = $rs[1]["uf_grade"];
$qty1 = $rs[1]["qty1"];
$qty2 = $rs[1]["qty2"];
$act_Weight = $rs[1]["uf_act_Weight"];

$pack_no = trim($rs[1]["uf_pack"]);
if (!$pack_no)  $pack_no = "NULL";

$STS_job = $rs[1]["uf_sts_job"];
$receipt = $rs[1]["receipt"];
$mfg_date = dateformat($rs[1]["mfg_date"], "m/d/Y H:i");

$um1 = $rs[1]["um1"];
$um2 = $rs[1]["um2"];


$sts_no = $rs[1]["sts_no"];
$sts_no2 = $rs[1]["sts_no2"];
$sts_no3 = $rs[1]["sts_no3"];
$qty_sts_no = $rs[1]["qty_sts_no"];
$qty_sts_no2 = $rs[1]["qty_sts_no2"];
$qty_sts_no3 = $rs[1]["qty_sts_no3"];
//echo $act_Weight;
//exit();
//$sql = "select TOP 1 uf_pack from Mv_Bc_tag where job = '".$job."' and suffix = '".$suffix."' and oper_num = '".$oper_num."' and uf_grade = '".$uf_grade."' and active = '1' order by uf_pack desc;";
//$rs = $cSql->SqlQuery($conn, $sql);
//$pack_no = $rs[1]["uf_pack"];
//if (isset($rs[1]["uf_pack"])) {
//	$pack_no = $rs[1]["uf_pack"];
//} else {
//	$pack_no = 0;
//}
//$pack_no += 1;	

$print_day = date("m/d/Y H:i");
$qty2_new = ($qty2 / $qty1) * $qtyn;
$act_Weight_new = ($act_Weight / $qty1) * $qtyn;

$sql = "insert into Mv_Bc_tag (id, job, suffix, oper_num, item, lot, qty1, qty2, uf_act_Weight, uf_grade, uf_pack, mfg_date, print_date, ship_stat, active, receipt, uf_sts_job, um1, um2, sts_no, sts_no2, sts_no3, qty_sts_no, qty_sts_no2, qty_sts_no3) "
        . " values ('".$id_new."', ".$job1.", ".$suffix.", ".$oper_num.", '".$item."', '".$lot."', '".$qtyn."', '".$qty2_new."', '".$act_Weight_new."', '".$uf_grade."', ".$pack_no.", '".$mfg_date."', '".$print_day."', '0', '1', '".$receipt."', '".$STS_job."', '".$um1."', '".$um2."' , '".$sts_no."', '".$sts_no2."', '".$sts_no3."', '".$qtyn."', '".$qty_sts_no2."', '".$qty_sts_no3."');";
//echo $sql." =======================";
$rs1 = $cSql->IsUpDel($conn, $sql);

$qty2_split = ($qty2 / $qty1) * $qtys;
$act_Weight_split = ($act_Weight / $qty1) * $qtys;
$sql = "update Mv_Bc_tag set qty1 = '".$qtys."', qty2 = '".$qty2_split."', uf_act_Weight = '".$act_Weight_split."' where id = '".$id."';";
//echo $sql." =======================";
$rs2 = $cSql->IsUpDel($conn, $sql);

echo $id_new.",".$id."||".$rs1.$rs2;
//echo $rs1;
sqlsrv_close($conn);
?>