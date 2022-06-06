<?php
while (list($key, $data) = each($_GET) OR list($key, $data) = each($_POST)) {
	${$key} = trim($data);
}
include "./initial.php";

$sql = "select RESID, DESCR from RESRC000_mst where ltrim(RESID) = '".$resid."';";
$cSql = new SqlSrv();
$rs = $cSql->SqlQuery($conn, $sql);
error_reporting( error_reporting() & ~E_NOTICE );
echo $rs[1]["RESID"]."||".$rs[1]["DESCR"];
?>