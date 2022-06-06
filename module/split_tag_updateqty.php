<?php

while (list($key, $data) = each($_GET) OR list($key, $data) = each($_POST)) {
    ${$key} = trim($data);
}
include "./initial.php";


$cSql = new SqlSrv();


$sql0 = "select item FROM lot_mst where lot = '$id' ";
$rs0 = $cSql->SqlQuery($conn, $sql0);

echo $rs0[1]["item"];


$sql = "update Mv_Bc_tag set qty1 = '" . $qtyUpdate . "' ,item = '" . $rs0[1]["item"] . "' where id = '" . $id . "';";
$rs2 = $cSql->IsUpDel($conn, $sql);
echo $sql;
sqlsrv_close($conn);
?>