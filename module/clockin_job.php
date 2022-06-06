<?php
while (list($key, $data) = each($_GET) OR list($key, $data) = each($_POST)) {
	${$key} = trim($data);
}

$temp->setReplace("{crumb}", "");
$temp->setReplace("{pagename}", '<img src="./image/next.png" border="0" align="absmiddle">บันทึกเวลาเข้างาน');
$temp->setReplace("{content}", $temp->getTemplate("./template/clockin_job.html"));

$jobm = explode("+", $jobno);
$sql = "select * from MV_Job where ltrim(job) = '".$jobm[0]."' and suffix = '".$jobm[1]."' and oper_num = '".$jobm[2]."';";
$cSql = new SqlSrv();
$rs = $cSql->SqlQuery($conn, $sql);
$temp->setReplace("{job_no}", "".$jobno."");
$temp->setReplace("{job_nou}", "".urlencode($jobno)."");
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
$temp->setReplace("{trans_date}", date("d/m/Y"));
$temp->setReplace("{start_time}", date('G:i'));
$temp->setReplace("{u_m}", "".$rs[1]["u_m"]."");

?>