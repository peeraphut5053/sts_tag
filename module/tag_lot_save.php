<?php
while (list($key, $data) = each($_GET) or list($key, $data) = each($_POST)) {
    ${$key} = trim($data);
}
include "./initial.php";

//echo "<pre>";
//print_r($_GET);
//print_r($_POST);
//exit();

if (!isset($_POST["grndata"])) {
    echo "2";
    exit;
}

$cSql = new SqlSrv();


$data = $_POST["grndata"];
if (trim($data[7]) == "") $data[7] = 0;
$sql = "insert into Mv_Bc_tag (id, item, lot, qty1, mfg_date, print_date, ship_stat, active, um1, uf_grade, uf_Tickness, uf_width, uf_spec, receipt, tag_status, sts_no) 
    values ('" . $data[0] . "', '" . $data[1] . "', '" . $data[2] . "', '" . $data[3] . "', '" . $data[4] . "', '" . date("Y-m-d H:i:s") . "', '0', '1', '" . $data[5] . "', 'A', " . $data[7] . ", '" . $data[8] . "', '" . $data[9] . "', '1', 'Good', '" . $data[10] . "');";
//echo $sql." =======================";
$rs1 = $cSql->IsUpDel($conn, $sql);

echo $rs1;
sqlsrv_close($conn);
