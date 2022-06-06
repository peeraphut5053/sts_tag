<?php
while (list($key, $data) = each($_GET) OR list($key, $data) = each($_POST)) {
	${$key} = trim($data);
}
include "./initial.php";

//echo "<pre>";
//print_r($_POST);
//exit();
$cSql = new SqlSrv();

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
$sql = "select top 1 *, convert(varchar(10), trans_date, 103) as trans_date2 from jobtran_mst where ltrim(job) = '".$jobm[0]."' and suffix = '".$jobm[1]."' and oper_num = '".$jobm[2]."' and ltrim(emp_num) = '".$emp_code."' AND trans_type = 'R' order by trans_num desc;";
$rs = $cSql->SqlQuery($conn, $sql);
if ($rs[0][0]) {
	if ($rs[1]["end_time"]) {		
		
		echo "insok";
	} else {
		$st = Sec2Time($rs[1]["start_time"],":");
		if ($rs[1]["trans_date2"] != date("d/m/Y")) $rk = '1';
		else $rk = '0';
		echo "true||".$st."||".$rs[1]["start_time"]."||".$rk."||".$rs[1]["trans_date2"];
	}
} else {	

	echo "insok";
}

sqlsrv_close($conn);
?>