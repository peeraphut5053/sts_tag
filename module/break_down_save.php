<?php
while (list($key, $data) = each($_GET) OR list($key, $data) = each($_POST)) {
	${$key} = trim($data);
}
include "./initial.php";

//echo "<pre>";
//print_r($_POST);

$cSql = new SqlSrv();
$start_time = date('G:i'); //ใช้เวลา End จากเครื่อง Server 

$dateN = date("m/d/Y");
$nDay = date('N', strtotime($dateN));
$sql = "select * from shift_mst where shift = '".$shift."';";
$rs = $cSql->SqlQuery($conn, $sql);
$pay_rate = $rs[1]["pay_basis##".$nDay.""];

$sql = "select * from employee_mst where ltrim(emp_num) = '".$emp_code."';";
$cSql = new SqlSrv();
$rs = $cSql->SqlQuery($conn, $sql);
$shift = $rs[1]["shift"];
$pr_rate = $rs[1]["reg_rate"];
$job_rate = $rs[1]["mfg_reg_rate"];

$st_a = explode(":", $start_time);
$st_a1 = $st_a[0] * 3600;
$st_a2 = $st_a[1] * 60;
$start_time = $st_a1 + $st_a2;

$jobm = explode("+", $job_no);
$sql = "select top 1 * from jobtran_mst where ltrim(job) = '".$jobm[0]."' and suffix = '".$jobm[1]."' and oper_num = '".$jobm[2]."' and ltrim(emp_num) = '".$emp_code."' and trans_type = 'I' order by trans_num desc;";
//echo $sql;
$rs = $cSql->SqlQuery($conn, $sql);
if ($rs[0][0]) {
	if ($rs[1]["end_time"]) {
		$sql = "insert into jobtran_mst (site_ref, job, trans_type, trans_date, oper_num, emp_num, shift, pay_rate, pr_rate, job_rate, start_time, wc, ind_code) values ('".$site_ref."', '".sprintf("%' 10s",$jobm[0])."', 'I', '".date("m/d/Y H:i")."', '".$oper_num."', '".$emp_code."', '".$shift."', '".$pay_rate."', '".$pr_rate."', '".$job_rate."', '".$start_time."', '".$wc."', '".$break_down."');";
		$rs1 = $cSql->IsUpDel($conn, $sql);
		echo $rs1;
	} else {
		$st = Sec2Time($rs[1]["start_time"],":");
		echo "true||".$st."||".$rs[1]["start_time"]."||".$rs[1]["ind_code"];
	}
} else {
	$sql = "insert into jobtran_mst (site_ref, job, trans_type, trans_date, oper_num, emp_num, shift, pay_rate, pr_rate, job_rate, start_time, wc, ind_code) values ('".$site_ref."', '".sprintf("%' 10s",$jobm[0])."', 'I', '".date("m/d/Y H:i")."', '".$oper_num."', '".$emp_code."', '".$shift."', '".$pay_rate."', '".$pr_rate."', '".$job_rate."', '".$start_time."', '".$wc."', '".$break_down."');";
	$rs1 = $cSql->IsUpDel($conn, $sql);
	echo $rs1;
}
?>