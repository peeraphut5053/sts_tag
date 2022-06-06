<?php

while (list($key, $data) = each($_GET) OR list($key, $data) = each($_POST)) {
    ${$key} = trim($data);
}
include "./initial.php";

//echo "<pre>";
//print_r($_POST);
//exit();
$cSql = new SqlSrv();

//$id_new = 'xxx';
//==
//echo $id_new;
$sql = "select distinct lot_mst.item,lot_mst.lot,lot_mst.rcvd_qty from lot_mst left outer join mv_bc_tag on lot_mst.lot = mv_bc_tag.lot "
        . "where mv_bc_tag.lot is null and lot_mst.lot like 'RZI%'  and lot_mst.rcvd_qty <> 0 order by lot_mst.lot asc   ";
$rs = $cSql->SqlQuery($conn, $sql);

print_r($rs);

//$suffix = trim($rs[1]["suffix"]);
//if (!$suffix)  $suffix = "NULL";
//$oper_num = trim($rs[1]["oper_num"]);
//if (!$oper_num)  $oper_num = "NULL";
//echo $lot;



$receipt = 1;

$print_day = date("m/d/Y H:i");

for ($i = 1; $i < count($rs); $i++) {

    //Gen Id update 24/5/2560
    $ip = $_SERVER['REMOTE_ADDR']; //Get user IP
    $ip_a = explode(".", $ip);
    $ipc = sprintf("%'.03d", $ip_a[3]);
    $idl = date("ymd") . $ipc;
    $sql_gen = "select TOP 1 id from Mv_Bc_tag where id like '" . $idl . "%' order by id desc;";
    $rs_gen = $cSql->SqlQuery($conn, $sql_gen);
    if (isset($rs_gen[1]["id"])) {
        $id_last = substr($rs_gen[1]["id"], -4);
        $id_next = intval('' . $id_last . '');
    } else {
        $id_next = 0;
    }
    $id_next += 1;
    $id_new = $idl . sprintf("%'.04d", $id_next);
echo '</br>';


    $item = $rs[$i]["item"];
    $lot = $rs[$i]["lot"];
    $qty1 = $rs[$i]["rcvd_qty"];
    $sql = "insert into Mv_Bc_tag (id, item, lot, qty1, mfg_date, print_date , active, receipt) "
            . " values ('" . $id_new . "', '" . $item . "', '" . $lot . "', '" . $qty1 . "', '" . $print_day . "', '" . $print_day . "', '1', '1');";
    echo $sql . " ======================= </br>";

    $rs1 = $cSql->IsUpDel($conn, $sql);
}

sqlsrv_close($conn);
?>