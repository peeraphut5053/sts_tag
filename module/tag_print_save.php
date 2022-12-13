<?php

while (list($key, $data) = each($_GET) OR list($key, $data) = each($_POST)) {
    ${$key} = trim($data);
}
include "./initial.php";

//echo "<pre>";
//print_r($_POST);
//print_r($_GET);
//print($_POST["sts_no2"]);
//exit();
$cSql = new SqlSrv();


isset($_POST["flagrejob"]) ? $flagrejob = $_POST["flagrejob"] : $flagrejob = 0;

if ($flagrejob == 1) {

    $tag_id = $_POST["tagid"];
    $job = $_POST["job"];

    $sqlChk = "select id,lot from MV_Bc_Tag where id = '" . $tag_id . "' and job = '" . $job . "' ";
    $rsChk = $cSql->SqlQuery($conn, $sqlChk);
    if (isset($rsChk[1])) {
        echo "Tag นี้ อยู่ใน Job นี้แล้ว";
        exit;
    }

    $sqlOldLot = "select * from MV_Bc_Tag where id = '" . $tag_id . "' ";
    $rsOldLot = $cSql->SqlQuery($conn, $sqlOldLot);

    $sqlLateBundle = "select TOP 1 uf_pack from MV_Bc_Tag where job = '" . $job . "' order by uf_pack desc ;";
    $rsLateBundle = $cSql->SqlQuery($conn, $sqlLateBundle);


    if ($rsLateBundle[1]["uf_pack"]) {
        $LateBundle = $rsLateBundle[1]["uf_pack"] + 1;
    } else {
        $LateBundle = 1;
    }

    $lot = $job . "-" . sprintf("%'.04d", ($LateBundle));
    ($_POST["sts_no"] != "") ? $sts_no = $_POST["sts_no"] : $sts_no = $rsOldLot[1]["sts_no"];

    $oldlot = $rsOldLot[1]["lot"];


    $sqlUpdateJob = " update Mv_Bc_Tag set job = '" . $job . "',"
            . " uf_pack = '" . $LateBundle . "',"
            . " lot = '" . $lot . "' ";

    $check_update = '';
    if ($_POST["sts_no"] != "") {
        $check_update = " ,sts_no = '" . $_POST["sts_no"] . "', "
                . " qty_sts_no = '" . $_POST["qty_sts_no"] . "', "
                . " sts_no2 = '" . $_POST["sts_no2"] . "', "
                . " qty_sts_no2 = '" . $_POST["qty_sts_no2"] . "' ";
    } else {
        $check_update = " ,sts_no = '" . $rsOldLot[1]["sts_no"] . "', "
                . " qty_sts_no = '" . $rsOldLot[1]["qty_sts_no"] . "', "
                . " sts_no2 = '" . $rsOldLot[1]["sts_no2"] . "', "
                . " qty_sts_no2 = '" . $rsOldLot[1]["qty_sts_no2"] . "' ";
    }

    $sqlUpdateJob = $sqlUpdateJob . $check_update . " where id = '" . $tag_id . "'";
    $rsUpdate = $cSql->IsUpDel($conn, $sqlUpdateJob);


    $sql_INSERT_LOT_LOC_MST = "exec [INSERT_LOT_LOC_MST] @oldlot = '$oldlot', @LOT ='$lot', @ITEM = '$item' , @sts_no = '$sts_no' ";
    $rsChk = $cSql->SqlQuery($conn, $sql_INSERT_LOT_LOC_MST);


    echo $sqlUpdateJob;
    echo '<br>';
    echo $sql_INSERT_LOT_LOC_MST;

    exit;
}



//ในกรณี reprint
if (!isset($_POST["qty1"])) {
    echo "2";
    exit;
}

$tag_a = @($qty1 / $perpack);
$tag_a1 = explode(".", $tag_a);
$tag_a3 = 0;
if (isset($tag_a1[1])) {
    $tag_a2 = $tag_a1[0];
    $tag_a3 = 1;
    $perpack1 = $qty1 - ($tag_a1[0] * $perpack);
} else {
    $tag_a2 = $tag_a1[0];
}

/* $sql = "select TOP 1 id from Mv_Bc_tag order by id desc;";
  $rs = $cSql->SqlQuery($conn, $sql);
  if (isset($rs[1]["id"])) {
  $id_last = explode("-",$rs[1]["id"]);
  if ($id_last[0] == date("ymd")) {
  $id_next = intval(''.$id_last[1].'');
  } else {
  $id_next = 0;
  }
  } else {
  $id_next = 0;
  } */
//Gen Id update 24/5/2560
$ip = $_SERVER['REMOTE_ADDR']; //Get user IP
$ip_a = explode(".", $ip);
$ipc = sprintf("%'.03d", $ip_a[3]);
$idl = date("ymd") . $ipc;
$sql = "select TOP 1 id from Mv_Bc_tag where id like '" . $idl . "%' order by id desc;";
$rs = $cSql->SqlQuery($conn, $sql);
if (isset($rs[1]["id"])) {
    $id_last = substr($rs[1]["id"], -4);
    $id_next = intval('' . $id_last . '');
} else {
    $id_next = 0;
}
//==

$pipe = "";
for ($p = 1; $p <= 4; $p++) {
    if (isset(${"pipeno_" . $p})) {
        if (${"pipeno_" . $p})
            $pipe .= ", '" . ${"pipeno_" . $p} . "'";
        else
            $pipe .= ", NULL";
    } else
        $pipe .= ", NULL";
}
for ($p = 1; $p <= 4; $p++) {
    if (isset(${"pipeqty_" . $p})) {
        if (${"pipeqty_" . $p})
            $pipe .= ", '" . ${"pipeqty_" . $p} . "'";
        else
            $pipe .= ", NULL";
    } else
        $pipe .= ", NULL";
}

$jobm = explode("+", $job_no);

/* if ($grade == "A" OR $grade == "R") {
  $sql = "select top 1 uf_pack from Mv_Bc_tag where ltrim(job) = '".$jobm[0]."' and suffix = '".$jobm[1]."' and oper_num = '".$jobm[2]."' and (uf_grade = 'A' or uf_grade = 'R') and active = '1' order by uf_pack desc;";
  } else {
  $sql = "select TOP 1 uf_pack from Mv_Bc_tag where ltrim(job) = '".$jobm[0]."' and suffix = '".$jobm[1]."' and oper_num = '".$jobm[2]."' and uf_grade = '".$grade."' and active = '1' order by uf_pack desc;";
  }
  $rs = $cSql->SqlQuery($conn, $sql);
  if (isset($rs[1]["uf_pack"])) {
  $pack_no = $rs[1]["uf_pack"];
  } else {
  $pack_no = 0;
  } */

$sql2 = "select TOP 1 u_m, uf_um2 from item_mst where item = '" . trim($item) . "';";
$rs2 = $cSql->SqlQuery($conn, $sql2);
$um1 = $rs2[1]["u_m"];
$um2 = $rs2[1]["uf_um2"];



//$print_day = date("m/d/Y H:i");
$pds = array();
$pds = explode("/", $pdate);
$print_day = $pds[1] . "/" . $pds[0] . "/" . $pds[2] . " " . date("H:i");
$rs1 = 0;
for ($i = 1; $i <= $tag_a2; $i++) {
    //$id_next += 1;
    //$id = date("ymd")."-".sprintf("%'.06d", $id_next);	
    $id_next += 1;
    $id = $idl . sprintf("%'.04d", $id_next);

    if (isset($_POST["pack_no_fix"]))
        $pack = $pack_no_fix;
    else
        $pack += 1;

    $qty2 = $unit_weight * $perpack;
    $act_weight = 0;

    $sqlchk_act_weigth = "select co_mst.co_num,job_mst.ord_num,co_mst.cust_num,* FROM job_mst LEFT JOIN co_mst ON job_mst.ord_num = co_mst.co_num where  (left(co_mst.cust_num,2) = 'TT' or left(co_mst.cust_num,2) = 'TH') and  job = '" . $jobm[0] . "' ";
    $rschk_act_weigth = $cSql->SqlQuery($conn, $sqlchk_act_weigth);
    $rschk_act_weigth[1]["cust_num"];

    if (isset($rschk_act_weigth[1]["cust_num"])) {

        $act_weight = $_POST["uf_act_Weight"];
    } else {
        $act_weight = $_POST["uf_act_Weight"];  //round($qty1 * $unit_weight / $tag_a2);
    }
    $lot = (explode("-", $lot)[0] . "-" . sprintf("%'.04d", $pack));


    if ($grade == "A") {
        $lot = (explode("-", $lot)[0] . "-" . sprintf("%'.04d", $pack));
    } elseif ($grade == "C") {
        $lot = (explode("-", $lot)[0] . "-B" . sprintf("%'.03d", $pack));
    } elseif ($grade == "R") {
        $lot = (explode("-", $lot)[0] . "-R" . sprintf("%'.03d", $pack));
    } else {
        $lot = (explode("-", $lot)[0] . "-" . sprintf("%'.04d", $pack));
    }



    $uf_sts_job2 = str_replace("'", " ", $uf_sts_job);

    $sql = "insert into Mv_Bc_tag"
            . " (id, sts_no , sts_no2, sts_no3, qty_sts_no, qty_sts_no2, qty_sts_no3, job, suffix, oper_num , item, lot ,"
            . " qty1, qty2, uf_act_Weight, uf_grade, uf_pack, mfg_date,"
            . " print_date, ship_stat, active, uf_sts_job, pipeno_1,"
            . " pipeno_2, pipeno_3, pipeno_4, pipeqty_1, pipeqty_2,"
            . " pipeqty_3, pipeqty_4, um1, um2, tag_status ) "
            . " values ('" . $id . "','" . $sts_no . "','" . $_POST["sts_no2"] . "','" . $_POST["sts_no3"] . "','" . $qty_sts_no . "','" . $qty_sts_no2 . "','" . $qty_sts_no3 . "',"
            . " '" . $jobm[0] . "', '" . $jobm[1] . "', '" . $jobm[2] . "',"
            . " '" . $item . "', '" . $lot . "', '" . $perpack . "', '" . $qty2 . "', '" . $act_weight . "', '" . $grade . "',"
            . " '" . $pack . "', '" . $print_day . "', '" . $print_day . "', '0', '1', '" . $uf_sts_job2 . "'" . $pipe . ","
            . " '" . $um1 . "', '" . $um2 . "', 'Good')";


    //echo(sprintf("%'.04d", $pack));
    //echo $sql . " =======================#1";
    $rs1 = $cSql->IsUpDel($conn, $sql);

    $sqlUpdate = " UPDATE Mv_Bc_Tag SET sts_no='" . $_POST["sts_no"] . "',"
            . " sts_no2 ='" . $_POST["sts_no2"] . "', "
            . " sts_no3 ='" . $_POST["sts_no3"] . "', "
            . " qty_sts_no = '" . $_POST["qty_sts_no"] . "',"
            . " qty_sts_no2 = '" . $_POST["qty_sts_no2"] . "',"
            . " qty_sts_no3 = '" . $_POST["qty_sts_no3"] . "' "
            . "  where id = '" . $id . "' ";
    $rsUpdate = $cSql->IsUpDel($conn, $sqlUpdate);
}

for ($t = 0; $t < $tag_a3; $t++) {
    //$id_next += 1;
    //$id = date("ymd")."-".sprintf("%'.06d", $id_next);	
    $id_next += 1;
    $id = $idl . sprintf("%'.04d", $id_next);

    if (isset($_POST["pack_no_fix"]))
        $pack = $pack_no_fix;
    else
        $pack += 1;

    $qty2 = $unit_weight * $perpack1;
    $act_weight = round($qty1 * $unit_weight / $tag_a3);
    $lot = (explode("-", $lot)[0] . "-" . sprintf("%'.04d", $pack));

    if ($grade == "A") {
        $lot = (explode("-", $lot)[0] . "-" . sprintf("%'.04d", $pack));
    } elseif ($grade == "C") {
        $lot = (explode("-", $lot)[0] . "-B" . sprintf("%'.03d", $pack));
    } elseif ($grade == "R") {
        $lot = (explode("-", $lot)[0] . "-R" . sprintf("%'.03d", $pack));
    } else {
        $lot = (explode("-", $lot)[0] . "-" . sprintf("%'.04d", $pack));
    }

    $sql = "insert into Mv_Bc_tag (id, sts_no, sts_no2, sts_no3, qty_sts_no, qty_sts_no2, qty_sts_no3,"
            . " job, suffix, oper_num, item, lot , qty1, qty2, uf_act_Weight, uf_grade,"
            . " uf_pack, mfg_date, print_date, ship_stat, active, uf_sts_job, pipeno_1,"
            . " pipeno_2, pipeno_3, pipeno_4, pipeqty_1, pipeqty_2, pipeqty_3, pipeqty_4,"
            . " um1, um2, tag_status  ) values ('" . $id . "','" . $sts_no . "','" . $_POST["sts_no2"] . "','" . $_POST["sts_no3"] . "','" . $qty_sts_no . "','" . $qty_sts_no2 . "','" . $qty_sts_no3 . "',"
            . " '" . $jobm[0] . "', '" . $jobm[1] . "', '" . $jobm[2] . "',"
            . " '" . $item . "', '" . $lot . "', '" . $perpack1 . "', '" . $qty2 . "',"
            . " '" . $act_weight . "', '" . $grade . "', '" . $pack . "', '" . $print_day . "',"
            . " '" . $print_day . "', '0', '1', '" . $uf_sts_job . "'" . $pipe . ", '" . $um1 . "',"
            . " '" . $um2 . "', 'Good')";

    //echo $sql . " ========================#2";
    $rs1 = $cSql->IsUpDel($conn, $sql);

    $sqlUpdate = " UPDATE Mv_Bc_Tag SET sts_no='" . $_POST["sts_no"] . "',"
            . " sts_no2 ='" . $_POST["sts_no2"] . "', "
            . " sts_no3 ='" . $_POST["sts_no3"] . "', "
            . " qty_sts_no = '" . $_POST["qty_sts_no"] . "',"
            . " qty_sts_no2 = '" . $_POST["qty_sts_no2"] . "',"
            . " qty_sts_no3 = '" . $_POST["qty_sts_no3"] . "' "
            . "  where id = '" . $id . "' ";
    $rsUpdate = $cSql->IsUpDel($conn, $sqlUpdate);
}



// echo "<pre>";
// print_r($sql);
exit();
//echo $tag_a3;
sqlsrv_close($conn);
?>