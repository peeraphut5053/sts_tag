<?php

include "../../initial.php";

while (list($key, $data) = each($_GET) OR list($key, $data) = each($_POST)) {
    ${$key} = trim($data);
}
if ($load == "GetStsNo") {
    $sql = "  select top 1"
            . " MV_BC_TAG.lot,MV_BC_TAG.sts_no,sts_no2,sts_no3 "
            . " ,isnull(qty_sts_no,0) as qty_sts_no "
            . " ,isnull(qty_sts_no2,0) as qty_sts_no2 "
            . " ,isnull(qty_sts_no3,0) as qty_sts_no3 "
            . " ,lot_mst.Uf_lot_sts_no as s_sts_no "
            . " ,lot_mst.uf_sts_no2 as s_sts_no2 "
            . " ,lot_mst.uf_sts_no3 as s_sts_no3 "
            . " ,lot_mst.uf_qty_sts_no as s_qty_sts_no "
            . " ,lot_mst.uf_qty_sts_no2 as s_qty_sts_no2 "
            . " ,lot_mst.uf_qty_sts_no3 as s_qty_sts_no3 "
            . " FROM MV_BC_TAG INNER JOIN lot_mst ON MV_BC_TAG.lot = lot_mst.lot "
            . " where id = '$tag_id' ";
    $cSql = new SqlSrv();
    $rs = $cSql->SqlQuery($conn, $sql);
    array_splice($rs, count($rs) - 1, 1);
    echo json_encode($rs);
} else if ($load == "updateStsNo") {

    if ($id != "" && $lot != "") {
        $sql0 = "update mv_bc_tag set sts_no = '$w_sts_no',sts_no2= '$w_sts_no2',sts_no3= '$w_sts_no3',"
                . " qty_sts_no= $w_qty_sts_no,qty_sts_no2= $w_qty_sts_no2,qty_sts_no3= $w_qty_sts_no3 where id = '$id' ";
        $cSql0 = new SqlSrv();
        $rs0 = $cSql0->SqlQuery($conn, $sql0);


        $sql = "update lot_mst set Uf_lot_sts_no = '$w_sts_no',uf_sts_no2= '$w_sts_no2',uf_sts_no3= '$w_sts_no3',"
                . " uf_qty_sts_no= $w_qty_sts_no,uf_qty_sts_no2= $w_qty_sts_no2,uf_qty_sts_no3= $w_qty_sts_no3 where lot = '$lot' ";
        $cSql = new SqlSrv();
        $rs = $cSql->SqlQuery($conn, $sql);

        echo json_encode($sql);
    }else{
        echo "error";
    }
}
?>