<?php
while (list($key, $data) = each($_GET) OR list($key, $data) = each($_POST)) {
	${$key} = trim($data);
}
include "./initial.php";


$sql = "update mv_bc_tag set ship_stat = '".$updateVal."' where id = '".$tag_id."' ";
$cSql = new SqlSrv();
$rs = $cSql->SqlQuery($conn, $sql);


$sql2 = "delete from ast_ship where tag_id = '".$tag_id."' ";
$cSql2 = new SqlSrv();
$rs2 = $cSql2->SqlQuery($conn, $sql2);

$sql3 = "delete from ast_tmp_ship where tag_id = '".$tag_id."' ";
$cSql3 = new SqlSrv();
$rs3 = $cSql3->SqlQuery($conn, $sql3);
       
        
$sql = "select * from mv_bc_tag where id = '".$tag_id."' ";
$cSql = new SqlSrv();
$rs = $cSql->SqlQuery($conn, $sql);
if ($rs[0][0]) {
    echo json_encode($rs[1]);
}


