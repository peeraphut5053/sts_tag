<?php
while (list($key, $data) = each($_GET) OR list($key, $data) = each($_POST)) {
	${$key} = trim($data);
}
include "./initial.php";

$grn_num = explode("+", $grn_num);

//$sql = "select * from MV_Job where ltrim(job) = '".$jobm[0]."' and suffix = '".$jobm[1]."' and oper_num = '".$jobm[2]."';";
$sql = "select * from grn_hdr_mst where grn_num = '".$grn_num[0]."' ";



//echo $sql;
$cSql = new SqlSrv();
$rs = $cSql->SqlQuery($conn, $sql);
if ($rs[0][0]) echo "true";
else echo "false";
?>