<?php

while (list($key, $data) = each($_GET) OR list($key, $data) = each($_POST)) {
    ${$key} = trim($data);
}

//echo "<pre>";
//print_r($_GET);
//print_r($_POST);
include "./initial.php";

$temp = new ReplaceHtml("../template/tag_print.html");
$cSql = new SqlSrv();
$lot_tmp = "";
if (!empty($lot)) {

    $lot_tmp = $lot;
}
$jobm = explode("+", $job_no);

if (isset($_POST["tag_ids"])) {
    $s_tag = count($_POST["tag_ids"]);
    for ($t = 0; $t < $s_tag; $t++) {
        $temp->setReplace("{printlist}", $temp->getTemplate("../template/tag_print_block.html"));
        $id = $_POST["tag_ids"][$t];
        $sql = "select *, CONVERT(VARCHAR(16), print_date, 120)  AS print_date from Mv_Bc_tag where id = '" . $id . "';";
        $rs = $cSql->SqlQuery($conn, $sql);

        $sql1 = "select TOP 1 * from MV_Job where item = '" . $rs[1]["item"] . "';";
        $rs1 = $cSql->SqlQuery($conn, $sql1);

        $sql2 = "select * from item_mst where item = '" . $rs[1]["item"] . "';";
        $rs2 = $cSql->SqlQuery($conn, $sql2);
        
        $sql2_wc = "select wc FROM matltran_mst where ref_num = '" . $rs[1]["job"] . "'  and wc is not null ;";
        $rs2_wc = $cSql->SqlQuery($conn, $sql2_wc);

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

        /* if (isset($rs2[1]["Uf_od_text"])) {
          $size = $rs2[1]["Uf_od_text"];
          } elseif (isset($rs2[1]["uf_PipeSize1"])) {
          $size = $rs2[1]["uf_PipeSize1"]."x".$rs2[1]["uf_PipeSize2"];
          } else {
          $size = "";
          } */
        
        $img_qrcode = "";
        $img_tis = "";
        $img_sts = "<img style='margin-left:-1px;'  src='./image/logo_sts.png' width='100' height='100' border='0' alt=''>";
 
        if (isset($rs2[1]["Uf_sizeontag"]))
            $size = $rs2[1]["Uf_sizeontag"];
        $size = "";
        $Heat_no_obj = new FunctionCenter();
        $Heat_no = $Heat_no_obj->GetHeatNo($rs[1]['sts_no'], $rs[1]['sts_no2'], $rs[1]['sts_no3'], $rs[1]['qty_sts_no'], $rs[1]['qty_sts_no2'], $rs[1]['qty_sts_no3']);
        $temp->setReplace("{Heat_no}", "" . $Heat_no . "");
        $temp->setReplace("{img_qrcode}", "" . $img_qrcode . "");
        
        $qr_tis = "<table width='100%' border='0' cellspacing='0' cellpadding='0'> "
                . "<tr><td height='24'> </td></tr> "
                . "<tr> <td align='center'>==<span style='font-family:Code39; color: #000000; font-size: 9pt; white-space: nowrap;'>*".$id."*</span>==</td> </tr> "
                . "<tr> <td><table width='100%' border='0' cellspacing='0' cellpadding='0' style='font-family:Tahoma; font-size:9px;' align='right'> <tr><td>SPEC./มาตราฐาน:".$spec." ".$rs2[1]["Uf_Grade"]."</td> </tr>"
                . "<tr><td>SIZE/ขนาด:". $rs2[1]["Uf_NPS"]." x". $rs2[1]["Uf_Schedule"]." x". $rs2[1]["Uf_length"]."</td> </tr> "
                . "<tr><td>ACT WT./น้ำหนักจริง(Kgs.): ".total_format($rs[1]["uf_act_Weight"], 2)."  (".$rs[1]["uf_grade"].")</td> </tr> "
                . "<tr><td>LOT No./รุ่น: {lot}</td> </tr> <tr><td style='font-size: 13px'>H/N.: <span style='font-size:22px;'>".$Heat_no."</span></td> </tr> </table></td> </tr> </table>";
        
        
        if($rs2[1]["Uf_spec"] == "TIS.107" ||$rs2[1]["Uf_spec"] == "TIS.107 STK290" ||$rs2[1]["Uf_spec"] == "TIS.107 STK400"  ){
            $img_qrcode = "<img src='./image/2392603330.jpg' width='100' height='100'>";
            $img_tis = "<img src='./image/TIS1.jpg' width='100' height='100'>";
            $qr_tis = "<table><tr><td>".$img_qrcode."</td><td>".$img_tis."</td><td>".$img_sts."</td></tr></table>";
        }elseif($rs2[1]["Uf_spec"] == "TIS.276"){
            $img_qrcode = "<img src='./image/350563986.png' width='100' height='100'>";
            $img_tis = "<img src='./image/TIS1.jpg' width='100' height='100'>";
            $qr_tis = "<table><tr><td>".$img_qrcode."</td><td>".$img_tis."</td><td>".$img_sts."</td></tr></table>";
        } elseif ($rs2[1]["Uf_spec"] == "TIS.1228") {
            $img_qrcode = "<img src='./image/1612617444.png' width='100' height='100'>"; 
             $img_tis = "<img src='./image/TIS2.jpg' width='100' height='100'>";
            $qr_tis = "<table><tr><td>".$img_qrcode."</td><td>".$img_tis."</td><td>".$img_sts."</td></tr></table>";
        }
 
        $temp->setReplace("{qr_tis}", "".$qr_tis."");

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
        $temp->setReplace("{unwt}", "" . total_format($unwt, 2) . "");
        $temp->setReplace("{actwt}", "" . total_format($rs[1]["uf_act_Weight"], 2) . "");
        $temp->setReplace("{mfd}", "" . dateformat($rs[1]["print_date"], "d/m/Y H:i") . "");
        $temp->setReplace("{perpack}", "" . $rs[1]["qty1"] . "");
        $temp->setReplace("{pack_no}", "" . $rs[1]["uf_pack"] . "");
        $temp->setReplace("{grade}", "" . $rs[1]["uf_grade"] . "");
        $temp->setReplace("{grade1}", "" . $rs2[1]["Uf_Grade"] . "");
        $temp->setReplace("{wc}", $rs2_wc[1]["wc"]);

        $grade = $rs[1]["uf_grade"];
        if ($grade == "A"){
            $temp->setReplace("{Reject}", "");
        } else {
            $temp->setReplace("{Reject}", "Reject and Scrap");
        }
    }
} else {
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
    
    $_GET['sts_no'];
    $sql_sts_no = "select TOP 1 sts_no from Mv_Bc_tag where sts_no = '" . $_GET['sts_no'] . "' and tag_status = 'onhold' order by id desc;";
    $rs_sts_no = $cSql->SqlQuery($conn, $sql_sts_no);
    if(isset($rs_sts_no[1]["sts_no"])){
         if($rs_sts_no[1]["sts_no"]==$_GET['sts_no']){
         echo '<script>alert("แท็กถูกระงับ พบเลข H/N(1) '.$rs_sts_no[1]["sts_no"].' มีสถานะ ONHOLD ในแท็กอื่น '.$_GET['sts_no'].'"); location.reload();</script>';          
         }
    }

    //Gen Id update 24/5/2560
    $ip = $_SERVER['REMOTE_ADDR']; //Get user IP
    $ip_a = explode(".", $ip);
    if (!isset($ip_a[3]))
        $ip_a[3] = "001";
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

    $qty1 = str_replace(",", '', $qty1);
    $tag_a = $qty1 / $perpack;
    $tag_a1 = explode(".", $tag_a);
    $tag_a3 = 0;
    if (isset($tag_a1[1])) {
        $tag_a2 = $tag_a1[0];
        $tag_a3 = 1;
        $perpack1 = $qty1 - ($tag_a1[0] * $perpack);
    } else {
        $tag_a2 = $tag_a1[0];
    }

    /* $sql = "select TOP 1 uf_pack from Mv_Bc_tag where ltrim(job) = '".$jobm[0]."' and suffix = '".$jobm[1]."' and oper_num = '".$jobm[2]."' and uf_grade = '".$grade."' and active = '1' order by uf_pack desc;";
      $rs = $cSql->SqlQuery($conn, $sql);
      if (isset($rs[1]["uf_pack"])) {
      $pack_no = $rs[1]["uf_pack"];
      } else {
      $pack_no = 0;
      } */

    $sql2 = "select * from item_mst where item = '" . $item . "';";
    $rs2 = $cSql->SqlQuery($conn, $sql2);
    $spec = $rs2[1]["Uf_spec"];
    /* if (isset($rs2[1]["Uf_od_text"])) {
      $size = $rs2[1]["Uf_od_text"];
      } elseif (isset($rs2[1]["uf_PipeSize1"])) {
      $size = $rs2[1]["uf_PipeSize1"]."x".$rs2[1]["uf_PipeSize2"];
      } else {
      $size = "";
      } */


    $size = $rs2[1]["Uf_tagdesc"];
    for ($t = 1; $t <= $tag_a2; $t++) {
        $temp->setReplace("{printlist}", $temp->getTemplate("../template/tag_print_block.html"));
        //$id_next += 1;
        //$id = date("ymd")."-".sprintf("%'.06d", $id_next);
        $id_next += 1;
        $id = $idl . sprintf("%'.04d", $id_next);
        $temp->setReplace("{barcode}", "" . $id . "");
        

        $temp->setReplace("{commodity}", "" . $item_desc . "");
        $temp->setReplace("{spec}", "" . $spec . "");
        //$temp->setReplace("{size}", "".$size."");
        $temp->setReplace("{Uf_NPS}", "" . $rs2[1]["Uf_NPS"] . "");
        $temp->setReplace("{Uf_Schedule}", "" . $rs2[1]["Uf_Schedule"] . "");
        $temp->setReplace("{Uf_length}", "" . $rs2[1]["Uf_length"] . "");
        
//        $sql2_wc = "select wc FROM matltran_mst where ref_num = '" .  $jobm[0] . "';";
//        $rs2_wc = $cSql->SqlQuery($conn, $sql2_wc);
        

        if (isset($_GET["pack_no_fix"]))
            $pack = $pack_no_fix;
        else
            $pack += 1;


        $lot_tmp = (explode("-", $lot_tmp)[0] . "-" . sprintf("%'.04d", $pack));

        if ($grade == "A") {
            $lot_tmp = (explode("-", $lot_tmp)[0] . "-" . sprintf("%'.04d", $pack));
        } elseif ($grade == "C") {
            $lot_tmp = (explode("-", $lot_tmp)[0] . "-B" . sprintf("%'.03d", $pack));
        } elseif ($grade == "R") {
            $lot_tmp = (explode("-", $lot_tmp)[0] . "-R" . sprintf("%'.03d", $pack));
        } else {
            $lot_tmp = (explode("-", $lot_tmp)[0] . "-" . sprintf("%'.04d", $pack));
        }


        $temp->setReplace("{lot}", "" . isset($rs2[1]["lot"]) ? $rs2[1]["lot"] : $lot_tmp . "");
        $temp->setReplace("{pack_no}", "" . $pack . "");
        $unwt = $unit_weight * $perpack;
        $temp->setReplace("{unwt}", "" . total_format($unwt, 2) . "");
        $actwt = $uf_act_Weight;
        $temp->setReplace("{actwt}", "" . total_format($actwt, 2) . "");
        $temp->setReplace("{mfd}", "" . date("d/m/Y H:i") . "");
        //$temp->setReplace("{mfd}", "" . dateformat($rs[1]["print_date"], "d/m/Y H:i") . "");
        //$temp->setReplace("{mfd}", "" . $pdate . "");

        $temp->setReplace("{perpack}", "" . $perpack . "");

        $Heat_no_obj = new FunctionCenter();
        $Heat_no = $Heat_no_obj->GetHeatNo($_GET['sts_no'], $_GET['sts_no2'], $_GET['sts_no3'], $_GET['qty_sts_no'], $_GET['qty_sts_no2'], $_GET['qty_sts_no3']);
        $temp->setReplace("{Heat_no}", "" . $Heat_no . "");

        $temp->setReplace("{grade}", "" . $grade . "");
        $temp->setReplace("{grade1}", "" . $rs2[1]["Uf_Grade"] . "");
        $temp->setReplace("{wc}", $_GET['wc']);

        if ($grade == "A"){
            $temp->setReplace("{Reject}", "");
        } else {
            $temp->setReplace("{Reject}", "Reject and Scrap");
        }
        
        
                
        $qr_tis = "<table width='100%' border='0' cellspacing='0' cellpadding='0'> "
                . "<tr><td height='24'> </td></tr> "
                . "<tr> <td align='center'>==<span style='font-family:Code39; color: #000000; font-size: 9pt; white-space: nowrap;'>*".$id."*</span>==</td> </tr> "
                . "<tr> <td><table width='100%' border='0' cellspacing='0' cellpadding='0' style='font-family:Tahoma; font-size:9px;' align='right'> <tr><td>SPEC./มาตราฐาน:".$spec." ".$rs2[1]["Uf_Grade"]."</td> </tr>"
                . "<tr><td>SIZE/ขนาด:". $rs2[1]["Uf_NPS"]." x". $rs2[1]["Uf_Schedule"]." x". $rs2[1]["Uf_length"]."</td> </tr> "
                . "<tr><td>ACT WT./น้ำหนักจริง(Kgs.): ".total_format($actwt, 2)."  (".$grade.")</td> </tr> "
                . "<tr><td>LOT No./รุ่น: {lot}</td> </tr> <tr><td style='font-size: 13px'>H/N.: <span style='font-size:22px;'>".$Heat_no."</span></td> </tr> </table></td> </tr> </table>";
        $img_sts = "<img style='margin-left:-1px;'  src='./image/logo_sts.png' width='100' height='100' border='0' alt=''>";

        if($rs2[1]["Uf_spec"] == "TIS.107" ||$rs2[1]["Uf_spec"] == "TIS.107 STK290" ||$rs2[1]["Uf_spec"] == "TIS.107 STK400"  ){
            $img_qrcode = "<img src='./image/2392603330.jpg' width='100' height='100'>";
            $img_tis = "<img src='./image/TIS1.jpg' width='100' height='100'>";
            $qr_tis = "<table><tr><td>".$img_qrcode."</td><td>".$img_tis."</td><td>".$img_sts."</td></tr></table>";
        }elseif($rs2[1]["Uf_spec"] == "TIS.276"){
            $img_qrcode = "<img src='./image/350563986.png' width='100' height='100'>";
            $img_tis = "<img src='./image/TIS1.jpg' width='100' height='100'>";
            $qr_tis = "<table><tr><td>".$img_qrcode."</td><td>".$img_tis."</td><td>".$img_sts."</td></tr></table>";
        } elseif ($rs2[1]["Uf_spec"] == "TIS.1228") {
            $img_qrcode = "<img src='./image/1612617444.png' width='100' height='100'>"; 
             $img_tis = "<img src='./image/TIS2.jpg' width='100' height='100'>";
            $qr_tis = "<table><tr><td>".$img_qrcode."</td><td>".$img_tis."</td><td>".$img_sts."</td></tr></table>";
        }
        


        $temp->setReplace("{qr_tis}", "".$qr_tis."");


    }
    for ($t = 0; $t < $tag_a3; $t++) {
        $temp->setReplace("{printlist}", $temp->getTemplate("../template/tag_print_block.html"));
        //$id_next += 1;
        //$id = date("ymd")."-".sprintf("%'.06d", $id_next);
        $id_next += 1;
        $id = $idl . sprintf("%'.04d", $id_next);
        $temp->setReplace("{barcode}", "" . $id . "");
        
        $qr_tis = `2`;

        $temp->setReplace("{qr_tis}", "2");
        $temp->setReplace("{commodity}", "" . $item_desc . "");
        $temp->setReplace("{spec}", "" . $spec . "");
        $temp->setReplace("{size}", "" . $size . "");
        $temp->setReplace("{lot}", "" . $lot . "");
        $unwt = $unit_weight * $perpack1;
        $temp->setReplace("{unwt}", "" . total_format($unwt, 2) . "");
        $actwt = $uf_act_Weight;
        $temp->setReplace("{actwt}", "" . total_format($actwt, 2) . "");
        $temp->setReplace("{mfd}", "" . $pdate . "");
        $temp->setReplace("{wc}", '1234');


        $temp->setReplace("{perpack}", "" . $perpack1 . "");
        //$pack_no += 1;
        if (isset($_GET["pack_no_fix"]))
            $pack = $pack_no_fix;
        else
            $pack += 1;
        $temp->setReplace("{pack_no}", "" . $pack . "");
        $temp->setReplace("{grade}", "" . $grade . "");
        $temp->setReplace("{grade1}", "" . $rs2[1]["Uf_Grade"] . "");
    }
}
$temp->setReplace("{printlist}", "");

echo $temp->getReplace();

sqlsrv_close($conn);
?>