<?php
while (list($key, $data) = each($_GET) OR list($key, $data) = each($_POST)) {
	${$key} = trim($data);
}
include "./initial.php";

if ( $load == "update_tag") {
	$cSql = new SqlSrv();
	$sql = "update mv_bc_tag set tag_status = '".$status_value."' where id = '".$id."' ";
    $rs = $cSql->SqlQuery($conn, $sql);
	echo $sql;
}

if ( $load == "save_detail") {
	$cSql = new SqlSrv();
	$sql = "update mv_bc_tag set detail = '".$detail_value."' where id = '".$detail_id."' ";
    $rs = $cSql->SqlQuery($conn, $sql);
	echo $sql;
}
?>

