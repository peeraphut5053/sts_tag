<?php
while (list($key, $data) = each($_GET) OR list($key, $data) = each($_POST)) {
	${$key} = trim($data);
}
include "./initial.php";

//echo "<pre>";
//print_r($_POST);

$cSql = new SqlSrv();
//$start_time = "18:20";
//$end_time = "19:30";
$end_time = date('G:i'); //ใช้เวลา End จากเครื่อง Server 

//echo $end_time;
//exit();
$start_time = Time2Sec($start_time);
$end_time = Time2Sec($end_time); 
$end_time_r = $end_time;
$diff_se = $start_time - $end_time;
$diff_se1 = Sec2Time($diff_se);

$dateN = date("m/d/Y");
$nDay = date('N', strtotime($dateN))+1;
if ($nDay == 8) $nDay = 1;
$sql = "select *, 
CONVERT(VARCHAR(19), shift_start##1, 120)  AS shift_start1, 
CONVERT(VARCHAR(19), shift_start##2, 120)  AS shift_start2, 
CONVERT(VARCHAR(19), shift_start##3, 120)  AS shift_start3, 
CONVERT(VARCHAR(19), shift_start##4, 120)  AS shift_start4, 
CONVERT(VARCHAR(19), shift_start##5, 120)  AS shift_start5, 
CONVERT(VARCHAR(19), shift_start##6, 120)  AS shift_start6, 
CONVERT(VARCHAR(19), shift_start##7, 120)  AS shift_start7, 

CONVERT(VARCHAR(19), shift_end##1, 120)  AS shift_end1, 
CONVERT(VARCHAR(19), shift_end##2, 120)  AS shift_end2, 
CONVERT(VARCHAR(19), shift_end##3, 120)  AS shift_end3, 
CONVERT(VARCHAR(19), shift_end##4, 120)  AS shift_end4, 
CONVERT(VARCHAR(19), shift_end##5, 120)  AS shift_end5, 
CONVERT(VARCHAR(19), shift_end##6, 120)  AS shift_end6, 
CONVERT(VARCHAR(19), shift_end##7, 120)  AS shift_end7, 

CONVERT(VARCHAR(19), Uf_StartOT1, 120)  AS StartOT1,
CONVERT(VARCHAR(19), Uf_StartOT2, 120)  AS StartOT2, 
CONVERT(VARCHAR(19), Uf_StartOT3, 120)  AS StartOT3, 
CONVERT(VARCHAR(19), Uf_StartOT4, 120)  AS StartOT4, 
CONVERT(VARCHAR(19), Uf_StartOT5, 120)  AS StartOT5, 
CONVERT(VARCHAR(19), Uf_StartOT6, 120)  AS StartOT6, 
CONVERT(VARCHAR(19), Uf_StartOT7, 120)  AS StartOT7, 

CONVERT(VARCHAR(19), Uf_EndOT1, 120)  AS EndOT1, 
CONVERT(VARCHAR(19), Uf_EndOT2, 120)  AS EndOT2, 
CONVERT(VARCHAR(19), Uf_EndOT3, 120)  AS EndOT3, 
CONVERT(VARCHAR(19), Uf_EndOT4, 120)  AS EndOT4, 
CONVERT(VARCHAR(19), Uf_EndOT5, 120)  AS EndOT5, 
CONVERT(VARCHAR(19), Uf_EndOT6, 120)  AS EndOT6, 
CONVERT(VARCHAR(19), Uf_EndOT7, 120)  AS EndOT7, 

CONVERT(VARCHAR(19), lunch_start##1, 120)  AS lunch_start1, 
CONVERT(VARCHAR(19), lunch_start##2, 120)  AS lunch_start2, 
CONVERT(VARCHAR(19), lunch_start##3, 120)  AS lunch_start3, 
CONVERT(VARCHAR(19), lunch_start##4, 120)  AS lunch_start4, 
CONVERT(VARCHAR(19), lunch_start##5, 120)  AS lunch_start5, 
CONVERT(VARCHAR(19), lunch_start##6, 120)  AS lunch_start6, 
CONVERT(VARCHAR(19), lunch_start##7, 120)  AS lunch_start7, 

CONVERT(VARCHAR(19), lunch_end##1, 120)  AS lunch_end1, 
CONVERT(VARCHAR(19), lunch_end##2, 120)  AS lunch_end2, 
CONVERT(VARCHAR(19), lunch_end##3, 120)  AS lunch_end3, 
CONVERT(VARCHAR(19), lunch_end##4, 120)  AS lunch_end4, 
CONVERT(VARCHAR(19), lunch_end##5, 120)  AS lunch_end5, 
CONVERT(VARCHAR(19), lunch_end##6, 120)  AS lunch_end6, 
CONVERT(VARCHAR(19), lunch_end##7, 120)  AS lunch_end7 
from shift_mst where shift = '".$shift."';";

$rs = $cSql->SqlQuery($conn, $sql);
$lunch_h = $rs[1]["lunch_hrs##".$nDay.""] * 3600;
//$max_h = $rs[1]["shift_hrs##".$nDay.""];
$shift_start_a = explode(" ", $rs[1]["shift_start".$nDay.""]);
$shift_start = Time2Sec($shift_start_a[1]);
$shift_end_a = explode(" ", $rs[1]["shift_end".$nDay.""]);
$shift_end = Time2Sec($shift_end_a[1]);

$lunch_start_a = explode(" ", $rs[1]["lunch_start".$nDay.""]);
$lunch_start = Time2Sec($lunch_start_a[1]);
$lunch_end_a = explode(" ", $rs[1]["lunch_end".$nDay.""]);
$lunch_end = Time2Sec($lunch_end_a[1]);

$ot_start_a = explode(" ", $rs[1]["StartOT".$nDay.""]);
$ot_start = Time2Sec($ot_start_a[1]);
$ot_end_a = explode(" ", $rs[1]["EndOT".$nDay.""]);
$ot_end = Time2Sec($ot_end_a[1]);
	
$sql1 = "select * from employee_mst where ltrim(emp_num) = '".$emp_code."';";
$rs1 = $cSql->SqlQuery($conn, $sql1);

$setvalue = "";
if ($start_time >= $shift_end) {	
	$setvalue = ", pay_rate = 'O'";
	$shift = $rs1[1]["shift"];
	$pr_rate = $rs1[1]["ot_rate"];
	$job_rate = $rs1[1]["mfg_ot_rate"];	
	$setvalue .= ", pr_rate = '".$pr_rate."'";
	$setvalue .= ", job_rate = '".$job_rate."'";

	if ($end_time > $ot_end) $ot_end_e = $ot_end;
	else $ot_end_e = $end_time;
	if ($start_time > $ot_start) $ot_start_e = $start_time;
	else $ot_start_e = $ot_start;
	$total_h = $ot_end_e - $ot_start_e;
} else {
	$job_rate = $rs1[1]["mfg_reg_rate"];

	if ($start_time < $shift_start) $start_time = $shift_start;
	if ($start_time > $lunch_start AND $start_time < $lunch_end) $start_time = $lunch_end;
	if ($start_time > $lunch_start) $lunch_h = 0;
	if ($end_time > $lunch_start AND $end_time < $lunch_end) $end_time = $lunch_start;
	if ($end_time > $shift_end) $end_time = $shift_end;
	if ($end_time < $lunch_end) $lunch_h = 0;
	if ($end_time < $shift_start) {
		$end_time = 0;
		$start_time = 0;
	}
	$total_h = ($end_time - $start_time) - $lunch_h;	
}

$a_hrs = Sec2TimeHrs($total_h);
//echo $a_hrs;
//exit();

//if ($break_down) $set_reason = ",ind_code = '".$break_down."'";
//else $set_reason = ",ind_code = NULL";
//$reason_code = $scrap;

$qty_complete = 0;
$jobm = explode("+", $job_no);
$sql = "update jobtran_mst set a_hrs = '".$a_hrs."', end_time = '".$end_time."', qty_complete = ".$qty_complete.$setvalue." where ltrim(job) = '".$jobm[0]."' and suffix = '".$jobm[1]."' and oper_num = '".$jobm[2]."' and ltrim(emp_num) = '".$emp_code."' and start_time = '".$start_time_s."' and end_time IS NULL;";
$rs = $cSql->IsUpDel($conn, $sql);
	
echo $rs;
?>