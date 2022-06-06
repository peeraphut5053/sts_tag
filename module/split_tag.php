<?php

while (list($key, $data) = each($_GET) OR list($key, $data) = each($_POST)) {
    ${$key} = trim($data);
}

if ($tag == "coil")
    $pgn = "แบ่งแท็ก  Item";
elseif ($tag == "slit")
    $pgn = "แบ่งแท็กสลิต";
elseif ($tag == "fg")
    $pgn = "แบ่งแท็ก Finishing";
$temp->setReplace("{crumb}", "");
$temp->setReplace("{pagename}", '<img src="./image/next.png" border="0" align="absmiddle">' . $pgn);
$temp->setReplace("{content}", $temp->getTemplate("./template/split_tag.html"));
$atf1 = "";
$atf2 = "";
$dis = "";
$cdis = "";
$sc = "";
if (isset($id)) {




    $cSql = new SqlSrv();
    $sql = "select *, CONVERT(VARCHAR(16), mfg_date, 120) as mfg_date from Mv_Bc_tag where id = '" . $id . "';";
    $rs = $cSql->SqlQuery($conn, $sql);
    if (isset($rs[1]["id"])) {
        if (!trim($rs[1]["receipt"])) {
            $sc = "<script>popup('<font color=\"#ff0000\">Tag Id: <u>" . $id . "</u> ยังไม่ได้ทำรับ ไม่สามารถแบ่ง Tag ได้</font>');</script>";
            $id = "";
            $item = "";
            $lot = "";
            $job = "";
            $suffix = "";
            $qty1 = "";
            $mfg_date = "";
            $atf1 = "autofocus";
            $dis = "disabled";
            $cdis = "ui-state-disabled";
        } else {

            if (isset($rs)) {


                if (substr($id, 0, 1) == '0' || substr($id, 0, 1) == 'H' || substr($id, 0, 3) == 'STI' || substr($id, 0, 3) == 'RPS' || substr($id, 0, 3) == 'BCM' || substr($id, 0, 3) == 'RZI' || substr($id, 0, 2) == 'KK' ) {
                    $sql2 = "select top 1  * from lot_loc_mst LEFT JOIN lot_mst On lot_loc_mst.lot = lot_mst.lot "
                            . " where lot_loc_mst.lot = '" . $id . "' and (lot_loc_mst.loc like 'PS%' or lot_loc_mst.loc like 'P%') "
                            . " order by qty_on_hand desc;";
                } else {
                    $sql2 = "select top 1  * from mv_bc_tag where id = '" . $id . "'  ";
                }

                // echo $sql2;
                $rs2 = $cSql->SqlQuery($conn, $sql2);

//                $sc = "<script>popup('<font color=\"#ff0000\">ไม่พบข้อมูล Tag Id: <u>" . $sqlUpdate . "</u></font>');</script>";

                $sql3 = "select *, CONVERT(VARCHAR(16), mfg_date, 120) as mfg_date from Mv_Bc_tag where id = '" . $id . "';";
                $rs3 = $cSql->SqlQuery($conn, $sql3);

                $id = $rs3[1]["id"];
                $item = $rs[1]["item"];
                $lot = $rs3[1]["lot"];
                $job = $rs3[1]["job"];
                $suffix = $rs3[1]["suffix"];
                $qty1 = total_format($rs[1]["qty1"], 2);
//                $qty1 = $rs3[1]["qty1"];
                $mfg_date = dateformat($rs3[1]["mfg_date"], "d/m/Y H:i");
                $atf2 = "autofocus";

//                $sc = "<script>popup('<font color=\"#ff0000\">ไม่พบข้อมูล Tag Id: <u>" . $id . "</u></font>');</script>";
            } else {
                $id = $rs[1]["id"];
                $item = $rs[1]["item"];
                $lot = $rs[1]["lot"];
                $job = $rs[1]["job"];
                $suffix = $rs[1]["suffix"];
                $qty1 = total_format($rs[1]["qty1"], 2);
//                $qty1 = $rs[1]["qty1"];
                $mfg_date = dateformat($rs[1]["mfg_date"], "d/m/Y H:i");
                $atf2 = "autofocus";
            }
        }
    } else {
        if (substr($id, 0, 3) == 'STI' || substr($id, 0, 3) == 'RPS' || substr($id, 0, 3) == 'BCM' || substr($id, 0, 3) == 'RZI' || substr($id, 0, 2) == 'KK') {
            $sql22 = "select top 1  * from lot_loc_mst LEFT JOIN lot_mst On lot_loc_mst.lot = lot_mst.lot "
                    . " where lot_loc_mst.lot = '" . $id . "' and (lot_loc_mst.loc like 'PS%' or lot_loc_mst.loc like 'P%') "
                    . " order by qty_on_hand desc;";
            $rs22 = $cSql->SqlQuery($conn, $sql22);

            if (isset($rs22)) {
                $sqlInsertNewSTI = "INSERT INTO mv_bc_tag (id,lot,qty1,item,receipt,active) VALUES ('" . $id . "','" . $id . "','" . $rs22[1]["qty_on_hand"] . "','" . $rs22[1]["item"] . "',1,1)";
                $cSql->SqlQuery($conn, $sqlInsertNewSTI);
                $sc = "<script>popup('<font color=\"#ff0000\">สร้าง Barcode  <u>" . $id . "</u> ใหม่</font>');</script>";
            } else {
                $sc = "<script>popup('<font color=\"#ff0000\">ยังไม่ได้รับ LOT  <u>" . $id . "</u> เข้าใน Lot location</font>');</script>";
            }




//            if (substr($id, 0, 1) == '0' || substr($id, 0, 1) == 'H' || substr($id, 0, 3) == 'STI' || substr($id, 0, 4) == 'RPSC' || substr($id, 0, 3) == 'BCM') {
//                    $sqlUpdate = "update mv_bc_tag set qty1 = " . $rs2[1]["qty_on_hand"] . " ,item = '" . $rs2[1]["item"] . "', receipt = 1 where lot = '" . $id . "' and receipt = 0;";
//                    echo $sqlUpdate;
//
//                    $cSql->SqlQuery($conn, $sqlUpdate);
//                }
        } else {
            $sc = "<script>popup('<font color=\"#ff0000\">ไม่พบข้อมูล Tag Id: <u>" . $id . "</u></font>');</script>";
            $id = "";
            $item = "";
            $lot = "";
            $job = "";
            $suffix = "";
            $qty1 = "";
            $mfg_date = "";
            $atf1 = "autofocus";
            $dis = "disabled";
            $cdis = "ui-state-disabled";
        }
    }
} else {
    $id = "";
    $item = "";
    $lot = "";
    $job = "";
    $suffix = "";
    $qty1 = "";
    $mfg_date = "";
    $atf1 = "autofocus";
    $dis = "disabled";
    $cdis = "ui-state-disabled";
}
$temp->setReplace("{id}", "" . $id . "");
$temp->setReplace("{item}", "" . $item . "");
$temp->setReplace("{lot}", "" . $lot . "");
$temp->setReplace("{job}", "" . $job . "");
$temp->setReplace("{suffix}", "" . $suffix . "");
$temp->setReplace("{qty1}", "" . $qty1 . "");
$temp->setReplace("{mfg_date}", "" . $mfg_date . "");

$temp->setReplace("{atf1}", "" . $atf1 . "");
$temp->setReplace("{atf2}", "" . $atf2 . "");
$temp->setReplace("{dis}", "" . $dis . "");
$temp->setReplace("{cdis}", "" . $cdis . "");
$temp->setReplace("{tag}", "" . $tag . "");

$temp->setReplace("{sc}", "" . $sc . "");
?>