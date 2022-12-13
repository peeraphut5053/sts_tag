<?php
while (list($key, $data) = each($_GET) OR list($key, $data) = each($_POST)) {
	${$key} = trim($data);
}
include "./initial.php";

//echo "<pre>";
//print_r($_POST);
//exit();
if (!isset($_POST["uf_act_Weight"])) {
	echo "2";
	exit;
}
$cSql = new SqlSrv();

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

if (isset($slit_lot)) {
	$slot = explode("_a_", $slit_lot);
} else {
	$slot[0] = $slit_lotm;
}

if (!isset($slot[1])) $slot[1] = ""; 
if (!isset($slot[2])) $slot[2] = "";

$jobm = explode("+", $job_no);
//$sql = "select TOP 1 uf_pack  from Mv_Bc_tag where ltrim(job) = '".$jobm[0]."' and suffix = '".$jobm[1]."' and oper_num = '".$jobm[2]."' and lot like '".$slot[0]."%' and active = '1' order by uf_pack desc;";
$sql = "select TOP 1 uf_pack from Mv_Bc_tag where lot like '".$slot[0]."%' and active = '1' and item = '".$item."' order by uf_pack desc;";
$rs = $cSql->SqlQuery($conn, $sql);
//echo $sql;
if (isset($rs[1]["uf_pack"])) $pack_no = $rs[1]["uf_pack"];	
else  $pack_no = 0;
$pack_no += 1;	

$sql2 = "select TOP 1 u_m, uf_um2 from item_mst where item = '".trim($item)."';";
$rs2 = $cSql->SqlQuery($conn, $sql2);
$um1 = $rs2[1]["u_m"];
$um2 = $rs2[1]["uf_um2"];

//$print_day = date("m/d/Y H:i");
$pds = array();
$pds = explode("/", $pdate);
$print_day = $pds[1]."/".$pds[0]."/".$pds[2]." ".date("H:i");

$sql = "insert into Mv_Bc_tag (id, job, suffix, oper_num, item, lot, qty1, uf_act_Weight, uf_pack, mfg_date, print_date, ship_stat, active, uf_sts_job, uf_grade, Uf_manu, uf_spec, um1, um2, sts_no, tag_status) values ('".$id."', '".$jobm[0]."', '".$jobm[1]."', '".$jobm[2]."', '".$item."', '".$slot[0].$lot."', '".$uf_act_Weight."', '".$uf_act_Weight."', '".$pack_no."', '".$print_day."', '".$print_day."', '0', '1', '".$uf_sts_job."', 'A', '".$slot[1]."', '".$slot[2]."', '".$um1."', '".$um2."', '".$sts_no."', 'Good');";
//echo $sql." =======================";
$rs1 = $cSql->IsUpDel($conn, $sql);

echo $rs1;
sqlsrv_close($conn);
?>