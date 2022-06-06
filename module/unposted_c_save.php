<?php
while (list($key, $data) = each($_GET) OR list($key, $data) = each($_POST)) {
	//${$key} = trim($data);
	${$key} = str_replace(",","",trim($data));
}
include "./initial.php";

//echo "<pre>";
//print_r($_POST);
//exit();
/*
7:50	17:04		8:00
7:50	16:10		7:10
8:30	17:10		7:30
8:30	16:00		6:30
7:50	12:20		4:00
7:50	9:20		1:20
8:30	12:10		3:30
8:30	9:20		0:50
12:50		17:10		4:00
12:50		16:10		3:10
13:10		17:15		3:50
13:10		14:30		1:20

17:50		21:15		3:00
17:50		20:10		2:10
18:20		21:15		2:40
18:20		19:30		1:10  10.75

*/
$cSql = new SqlSrv();
//$start_time = "18:20";
//$end_time = "19:30";
$end_time = date('G:i'); //ใช้เวลา End จากเครื่อง Server 

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
//echo $nDay.".";
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

$upvalue = "";
if ($start_time >= $shift_end) {	
	$upvalue = ", pay_rate = 'O'";
	$shift = $rs1[1]["shift"];
	$pr_rate = $rs1[1]["ot_rate"];
	$job_rate = $rs1[1]["mfg_ot_rate"];	
	$upvalue .= ", pr_rate = '".$pr_rate."'";
	$upvalue .= ", job_rate = '".$job_rate."'";

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
$amount = $a_hrs * $job_rate;

//echo $a_hrs."*".$job_rate."=". $amount;
//exit();
$grade_b = 0;
$grade_wc = 0;
$grade_r = 0;
$grade_ws = 0;
$setvalue = "";
for($i=1; $i<=10; $i++) {
	if (${"Uf_B".$i} == "") ${"Uf_B".$i} = 0;
	if (${"Uf_WB".$i} == "") ${"Uf_WB".$i} = 0;
	$grade_b += ${"Uf_B".$i};
	$setvalue .= ", Uf_B".$i." = ".${"Uf_B".$i}."";
	$setvalue .= ", Uf_WB".$i." = ".${"Uf_WB".$i}."";
	$setvalue .= ", Uf_ReasonB".$i." = '".${"Uf_ReasonB".$i}."'";
}
for($i=1; $i<=10; $i++) {
	if (${"Uf_C".$i} == "") ${"Uf_C".$i} = 0;
	if (${"Uf_WC".$i} == "") ${"Uf_WC".$i} = 0;
	$grade_wc += ${"Uf_WC".$i};
	$setvalue .= ", Uf_C".$i." = ".${"Uf_C".$i}."";
	$setvalue .= ", Uf_WC".$i." = ".${"Uf_WC".$i}."";
	$setvalue .= ", Uf_ReasonC".$i." = '".${"Uf_ReasonC".$i}."'";
}
for($i=1; $i<=10; $i++) {
	if (${"Uf_R".$i} == "") ${"Uf_R".$i} = 0;
	if (${"Uf_WR".$i} == "") ${"Uf_WR".$i} = 0;
	$grade_r += ${"Uf_R".$i};
	$setvalue .= ", Uf_R".$i." = ".${"Uf_R".$i}."";
	$setvalue .= ", Uf_WR".$i." = ".${"Uf_WR".$i}."";
	$setvalue .= ", Uf_ReasonR".$i." = '".${"Uf_ReasonR".$i}."'";
}
for($i=1; $i<=3; $i++) {
	if (${"Uf_WS".$i} == "") ${"Uf_WS".$i} = 0;
	$grade_ws += ${"Uf_WS".$i};
	$setvalue .= ", Uf_WS".$i." = ".${"Uf_WS".$i}."";
	$setvalue .= ", Uf_ReasonS".$i." = '".${"Uf_ReasonS".$i}."'";
}

$qty_complete = $grade_a + $grade_b + $grade_r;
$qty_scrapped = $grade_wc + $grade_ws;
if ($Uf_WGradeA == "") $Uf_WGradeA = 0;

$jobm = explode("+", $job_no);
//คน
$sql = "update jobtran_mst set a_hrs = '".$a_hrs."', end_time = '".$end_time_r."', a_$ = ".$amount.", loc = 'STOCK'".$upvalue.", Uf_ReKey = '".$rekey."' where ltrim(job) = '".$jobm[0]."' and suffix = '".$jobm[1]."' and oper_num = '".$jobm[2]."' and ltrim(emp_num) = '".$emp_code."' and start_time = '".$start_time_s."' and trans_type = 'R' and end_time IS NULL;";
$rs = $cSql->IsUpDel($conn, $sql);
//echo $sql;	
//เครื่องจักร
$sql = "update jobtran_mst set a_hrs = '".$a_hrs."', qty_complete = ".$qty_complete.", qty_scrapped = ".$qty_scrapped.", end_time = '".$end_time_r."', Uf_GradeA = ".$grade_a.", Uf_WGradeA = ".$Uf_WGradeA.", reason_code = 'ZZZ', loc = 'STOCK'".$setvalue.", Uf_ReKey = '".$rekey."' where ltrim(job) = '".$jobm[0]."' and suffix = '".$jobm[1]."' and oper_num = '".$jobm[2]."' and Uf_mc = '".$resnum."' and start_time = '".$start_time_s."' and trans_type = 'C' and end_time IS NULL;";
$rs1 = $cSql->IsUpDel($conn, $sql);
//echo $sql;	
//$sql = "update jobtran_mst set a_hrs = '".$a_hrs."', qty_complete = ".$qty_complete.", qty_scrapped = ".$qty_scrapped.", end_time = '".$end_time_r."', a_$ = ".$amount.", Uf_GradeA = ".$grade_a.", Uf_WGradeA = ".$Uf_WGradeA.", reason_code = 'ZZZ', loc = 'STOCK'".$setvalue." where ltrim(job) = '".$jobm[0]."' and suffix = '".$jobm[1]."' and oper_num = '".$jobm[2]."' and ltrim(emp_num) = '".$emp_code."' and start_time = '".$start_time_s."';";
echo $rs.$rs1;
sqlsrv_close($conn);
?>