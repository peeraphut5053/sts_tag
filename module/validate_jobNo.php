<?php
while (list($key, $data) = each($_GET) OR list($key, $data) = each($_POST)) {
	${$key} = trim($data);
}
include "./initial.php";

$jobm = explode("+", $jobno);

//$sql = "select * from MV_Job where ltrim(job) = '".$jobm[0]."' and suffix = '".$jobm[1]."' and oper_num = '".$jobm[2]."';";
$sql = "select * from job_mst LEFT JOIN jobroute_mst on job_mst.job = jobroute_mst.job where ltrim(job_mst.job) = '".$jobm[0]."' and job_mst.suffix = '".$jobm[1]."' and jobroute_mst.oper_num = '".$jobm[2]."'";



//echo $sql;
$cSql = new SqlSrv();
$rs = $cSql->SqlQuery($conn, $sql);
if ($rs[0][0]) echo "true";
else echo "false";
?>