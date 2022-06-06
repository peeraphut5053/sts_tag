<?php
while (list($key, $data) = each($_GET) OR list($key, $data) = each($_POST)) {
	${$key} = trim($data);
}
include "./initial.php";



$sql3 = "DELETE FROM grn_line_mst where grn_num = '".$grn_num."' and grn_line = '".$grn_line."'" ;
$cSql3 = new SqlSrv();
$rs3 = $cSql3->SqlQuery($conn, $sql3);



