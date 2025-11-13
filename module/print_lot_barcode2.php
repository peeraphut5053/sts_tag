<?php

while (list($key, $data) = each($_GET) or list($key, $data) = each($_POST)) {
    ${$key} = trim($data);
}

//echo "<pre>";
//print_r($_GET);
//print_r($_POST);
include "./initial.php";

$temp = new ReplaceHtml("../template/print_lot.html");
$cSql = new SqlSrv();

//reprint

if (isset($_POST["lot"])) {
    $temp->setReplace("{printlist}", $temp->getTemplate("../template/print_lot_block.html"));
    $lot = $_POST["lot"];
    $sts_no = $_POST["sts_no"];
    $sql = "SELECT *, CONVERT(VARCHAR, create_date, 103) AS create_date_str FROM lot_mst WHERE lot = '" . $lot . "';";
    $rs = $cSql->SqlQuery($conn, $sql);

    $sql1 = "select TOP 1 * from MV_Job where item = '" . $rs[1]["item"] . "';";
    $rs1 = $cSql->SqlQuery($conn, $sql1);

    $sql2 = "select * ,case when item_mst.uf_market in ('AUS', 'USA') then 'เหล็กนำเข้าตามมาตรา 21 ตรี'
        else '' end as remark , substring(item,15,2) as TIS
        from item_mst where item  = '" . $rs[1]["item"] . "' ";
    $rs2 = $cSql->SqlQuery($conn, $sql2);

    //$sql2_wc = "select wc FROM matltran_mst where ref_num = '" . $rs[1]["job"] . "'  and wc is not null ;";
    //$rs2_wc = $cSql->SqlQuery($conn, $sql2_wc);

    if (isset($rs2[1]["Uf_spec"])) {
        $spec = $rs2[1]["Uf_spec"];
    } else {
        $spec = $rs2[1]["Uf_class"];
    }
    //พี่หลอดบอกว่าถ้าเป็นลูกค้า R&R TRADING CO.LTD. ให้ใช้ Uf_class
    if (isset($rs1[1]["ord_num"])) {
        $sql3 = "select * from co_mst where co_num = '" . $rs1[1]["ord_num"] . "';";
        $rs3 = $cSql->SqlQuery($conn, $sql3);
        if ($rs3[1]["cust_num"] == 'EX00007') {
            $spec = $rs2[1]["Uf_class"];
        }
    }

    $ip = $_SERVER['REMOTE_ADDR']; //Get user IP
    $ip_a = explode(".", $ip);
    $ipc = sprintf("%'.03d", $ip_a[3]);
    $idl = date("ymd") . $ipc;
    $sql = "select TOP 1 id from Mv_Bc_tag where id like '" . $idl . "%' order by id desc;";
    $rs3 = $cSql->SqlQuery($conn, $sql);
    if (isset($rs3[1]["id"])) {
        $id_last = substr($rs3[1]["id"], -4);
        $id_next = intval('' . $id_last . '');
    } else {
        $id_next = 0;
    }

    $id_next += 1;
    $id = $idl . sprintf("%'.04d", $id_next);

    $temp->setReplace("{reprint}", "" . true . "");

    $temp->setReplace("{barcode}", "" . $id . "");
    //$temp->setReplace("{commodity}", "".$rs1[1]["item"]."");
    $temp->setReplace("{commodity}", "" . isset($rs1[1]["item_desc"]) ? $rs1[1]["item_desc"] : "" . "");
    $temp->setReplace("{spec}", "" . $spec . "");
    //$temp->setReplace("{size}", "".$size."");
    $temp->setReplace("{Uf_NPS}", "" . $rs2[1]["Uf_NPS"] . "");
    $temp->setReplace("{Uf_Schedule}", "" . $rs2[1]["Uf_Schedule"] . "");
    $temp->setReplace("{Uf_length}", "" . $rs2[1]["Uf_length"] . "");
    $temp->setReplace("{lot}", "" . $rs[1]["lot"] . "");
    $unit_weight_cal = isset($rs1[1]["unit_weight"]) ? $rs1[1]["unit_weight"] : 0;
    $qty1_cal = isset($rs[1]["qty1"]) ? $rs[1]["qty1"] : 0;
    $unwt = $unit_weight_cal * $qty1_cal;
    $temp->setReplace("{unwt}", "" . total_format($rs2[1]["unit_weight"], 2) . "");
    $temp->setReplace("{actwt}", "" . total_format($rs2[1]["unit_weight"], 2) . "");
    $temp->setReplace("{mfd}", "" . $rs[1]["create_date_str"] . "");
    $temp->setReplace("{perpack}", "" . intval($rs[1]["rcvd_qty"]) . "");
    $temp->setReplace("{grade}", "" . $rs2[1]["Uf_Grade"] . "");
    $temp->setReplace("{grade1}", "" . $rs2[1]["Uf_Grade"] . "");
    $temp->setReplace("{Heat_no}", "" . $sts_no . "");
    //id, item, lot, qty1, mfg_date, print_date, ship_stat, active, um1, uf_grade, uf_Tickness, uf_width, uf_spec, receipt, tag_status
    $lotData = array(
        "id" => "" . $id . "",
        "item" => "" . $rs[1]["item"] . "",
        "lot" => "" . $rs[1]["lot"] . "",
        "qty1" => "" . $rs[1]["rcvd_qty"] . "",
        "mfg_date" => "" . $rs[1]["create_date_str"] . "",
        "um1" => "" . $rs2[1]["u_m"] . "",
        "uf_grade" => "" . $rs[1]["Uf_Grade"] . "",
        "uf_Tickness" => "" . isset($rs2[1]["Uf_Tickness"]) ? $rs2[1]["Uf_Tickness"] : "" . "",
        "uf_width" => "" . $rs2[1]["Uf_width"] . "",
        "uf_spec" => "" . $spec . "",
        "sts_no" => "" . $sts_no . "",
    );
    $temp->setReplace("{lotdata}", "" . implode("??", $lotData) . "");
}
$temp->setReplace("{printlist}", "");

echo $temp->getReplace();

sqlsrv_close($conn);
