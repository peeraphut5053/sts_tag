<?php
while (list($key, $data) = each($_GET) OR list($key, $data) = each($_POST)) {
	${$key} = trim($data);
}
include "./initial.php";

//echo "<pre>";
//print_r($_POST);
//exit();
$cSql = new SqlSrv();
$sql = "update Mv_Bc_tag set active = '0' where id = '".$tag_id."';";
$rs = $cSql->IsUpDel($conn, $sql);
//echo $rs;
sqlsrv_close($conn);
?>