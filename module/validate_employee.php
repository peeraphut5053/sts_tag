<?php
while (list($key, $data) = each($_GET) OR list($key, $data) = each($_POST)) {
	${$key} = trim($data);
}
include "./initial.php";

$sql = "select emp_num, name, shift from employee_mst where ltrim(emp_num) = '".$emp_num."';";
$cSql = new SqlSrv();
$rs = $cSql->SqlQuery($conn, $sql);
error_reporting( error_reporting() & ~E_NOTICE );
echo $rs[1]["emp_num"]."||".$rs[1]["name"]."||".$rs[1]["shift"];
?>