<?php
while (list($key, $data) = each($_GET) OR list($key, $data) = each($_POST)) {
    ${$key} = trim($data);
}
include "./initial.php";

if ($load === "update") {
    $sql = "update mv_bc_tag set active = '$updateVal' where id = '".$tag_id."' ";

$cSql = new SqlSrv();
$rs = $cSql->SqlQuery($conn, $sql);

if (isset($rs)) {
    $sql = "select * from mv_bc_tag where id = '".$tag_id."' ";
    $cSql = new SqlSrv();
    $data = $cSql->SqlQuery($conn, $sql);
    echo json_encode($data[1]);
}else{
    echo false;
}

}

?>