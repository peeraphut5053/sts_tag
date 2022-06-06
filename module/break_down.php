<?php
while (list($key, $data) = each($_GET) OR list($key, $data) = each($_POST)) {
	${$key} = trim($data);
}

$temp->setReplace("{crumb}", "สแกนใบสั่งผลิต");
$temp->setReplace("{pagename}", "Break Down");
$temp->setReplace("{content}", $temp->getTemplate("./template/break_down.html"));

$jobm = explode("+", $jobno);
$sql = "select * from MV_Job where ltrim(job) = '".$jobm[0]."' and suffix = '".$jobm[1]."' and oper_num = '".$jobm[2]."';";
$cSql = new SqlSrv();
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
$temp->setReplace("{trans_date}", date("d/m/Y"));
$temp->setReplace("{start_time}", date('G:i'));

$sql = "select ind_code, description from indcode_mst;";
$cSql = new SqlSrv();
$rs = $cSql->SqlQuery($conn, $sql);
$op_break_down = '<option value=""> </option>';
for($i=1; $i<=$rs[0][0]; $i++) {
	$op_break_down .= '<option value="'.$rs[$i]["ind_code"].'">'.$rs[$i]["description"].'</option>';
}
$temp->setReplace("{op_break_down}", $op_break_down);
?>