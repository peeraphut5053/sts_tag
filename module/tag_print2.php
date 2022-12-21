<?php

while (list($key, $data) = each($_GET) or list($key, $data) = each($_POST)) {
    ${$key} = trim($data);
}
//echo "<pre>";
//print_r($_GET);
//print_r($_POST);
//exit();
include "./initial.php";
$temp = new ReplaceHtml("../template/tag_print.html");
$cSql = new SqlSrv();
$lot_tmp = "";
if (!empty($lot)) {
    $lot_tmp = $lot;
}

if (empty($cert)){
    $cert = "";
};

//echo $lot_tmp;
if (isset($_POST["tag_ids"])) {
    $jobm = explode("%2B", $job_no);
    $s_tag = count($_POST["tag_ids"]);
    for ($t = 0; $t < $s_tag; $t++) {
        if ($c == 'usa') {
            $temp->setReplace("{printlist}", $temp->getTemplate("../template/tag_print_block2.html"));
        }else if ($c == 'thai') {
            $temp->setReplace("{printlist}", $temp->getTemplate("../template/tag_print_block2Thai.html"));
        } else if ($c == 'tag_b') {
            $temp->setReplace("{printlist}", $temp->getTemplate("../template/tag_print_block_tag_b.html"));
        } else if ($c == 'tag_c') {
            $temp->setReplace("{printlist}", $temp->getTemplate("../template/tag_print_block_tag_c.html"));
        } else {
            if ($cert == 'sts')
                $temp->setReplace("{printlist}", $temp->getTemplate("../template/tag_print_block3.html"));
            else
                $temp->setReplace("{printlist}", $temp->getTemplate("../template/tag_print_block4.html"));
        }
        
        
        
        
        
        $id = $_POST["tag_ids"][$t];
        $jobm0 = $jobm[0];
        $TagBarcode = new TagBarcode();
        $TagBarcode->GetTagBarcodeReprint($id);
        
        $img_qrcode = "";
        $img_tis = "";
        $desc = "";
        $Uf_TheoryWeightPerItem  = "";
        if($TagBarcode->Uf_class == "TIS.107"){
            $img_qrcode = "<img src='./image/2392603330.jpg' width='100' height='100'>";
            $img_tis = "<img src='./image/TIS_107.jpg' width='100' height='100'>";
        }elseif($TagBarcode->Uf_class == "TIS.276"){
            $img_qrcode = "<img src='./image/350563986.png' width='100' height='100'>";
            $img_tis = "<img src='./image/TIS_276.jpg' width='100' height='100'>";
        } elseif($TagBarcode->Uf_class == "TIS.1228") {
            $img_qrcode = "<img src='./image/1612617444.png' width='100' height='100'>"; 
            $img_tis = "<img src='./image/TIS_1228.jpg' width='100' height='100'>";
            $desc = "เหล็กโครงสร้างรูปพรรณขึ้นรูปเย็นสำหรับงานโครงสร้างทั่วไป เหล็กรูปตัวซีมีขอบ";
            $Uf_TheoryWeightPerItem ="weight". " : " . number_format($TagBarcode->Uf_TheoryWeightPerItem,2) . " kg / m.";
        }
        
        
        
        $temp->setReplace("{barcode}", "" . $id . "");
        $temp->setReplace("{Uf_refno}", "" . $TagBarcode->Uf_refno . "");
        $temp->setReplace("{img_qrcode}", "" . $img_qrcode . "");
        $temp->setReplace("{img_tis}", "" . $img_tis . "");
        $temp->setReplace("{desc}", "" . $desc . "");
        $temp->setReplace("{Uf_TheoryWeightPerItem}", "" . $Uf_TheoryWeightPerItem . "");
       
        $temp->setReplace("{spec}", "" . $TagBarcode->spec . "");
        $temp->setReplace("{grade}", $TagBarcode->Uf_Grade);
        $temp->setReplace("{Uf_tagdesc}", $TagBarcode->Uf_tagdesc);
        $temp->setReplace("{Uf_TypeEnd}", $TagBarcode->Uf_TypeEnd);
        $temp->setReplace("{Uf_NPS}", $TagBarcode->Uf_NPS);
        $temp->setReplace("{Uf_Schedule}", $TagBarcode->Uf_Schedule);
        $temp->setReplace("{Uf_length}", $TagBarcode->Uf_length);
        $temp->setReplace("{Uf_pack}", "" . total_format($TagBarcode->qty1) . "");
        $temp->setReplace("{lot}", "" . isset($TagBarcode->lot) ? $TagBarcode->lot : $lot_tmp . "");
        $temp->setReplace("{unit_weight}", $TagBarcode->uf_act_Weight);
        $temp->setReplace("{pack_no}", $TagBarcode->uf_pack);
        $temp->setReplace("{Heat_no}", $TagBarcode->Heat_no);
        $temp->setReplace("{sts_no}", $TagBarcode->Heat_no);
        $temp->setReplace("{cust_num}", $TagBarcode->cust_name);
        $temp->setReplace("{cust_po}", $TagBarcode->cust_po);
        $temp->setReplace("{addr##1}", $TagBarcode->city);
        $temp->setReplace("{mfd}", "" . dateformat($TagBarcode->print_date, "d/m/Y H:i") . "");
    }
} else {

    $sql_sts_no = "select TOP 1 sts_no from Mv_Bc_tag where sts_no = '" . $_GET['sts_no'] . "' and tag_status = 'onhold' order by id desc;";
    $rs_sts_no = $cSql->SqlQuery($conn, $sql_sts_no);
    if(isset($rs_sts_no[1]["sts_no"])){
         if($rs_sts_no[1]["sts_no"]==$_GET['sts_no']){
         echo '<script>alert("แท็กถูกระงับ พบเลข H/N(1) '.$rs_sts_no[1]["sts_no"].' มีสถานะ ONHOLD ในแท็กอื่น '.$_GET['sts_no'].'"); location.reload();</script>';          
         }
    }
    $jobm = explode("+", $job_no);
    $TagBarcodePreview = new TagBarcode();
    $TagBarcodePreview->GetTagBarcodePreview($jobm[0], $item);
    $idl = $TagBarcodePreview->GetGenBarcode_1();
    $id_next = $TagBarcodePreview->GetGenBarcode_2();
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
    $qty1 = $TagBarcodePreview->qty1;
    $lot = $TagBarcodePreview->lot;
    $uf_act_Weight = $TagBarcodePreview->uf_act_Weight;
    $uf_pack = $TagBarcodePreview->uf_pack;
    $print_date = $TagBarcodePreview->print_date;
    $ord_num = $TagBarcodePreview->ord_num;
    $unit_weight = $TagBarcodePreview->unit_weight;
    $Heat_no = $TagBarcodePreview->GetHeatNo($_GET['sts_no'], $_GET['sts_no2'], $_GET['sts_no3'], $_GET['qty_sts_no'], $_GET['qty_sts_no2'], $_GET['qty_sts_no3']);

    for ($t = 1; $t <= $tag_a2; $t++) {
        if ($c == 'usa') {
            $temp->setReplace("{printlist}", $temp->getTemplate("../template/tag_print_block2.html"));
        } elseif ($c == 'thai') {
            $temp->setReplace("{printlist}", $temp->getTemplate("../template/tag_print_block2Thai.html"));
        } elseif ($c == 'tag_b') {
            $temp->setReplace("{printlist}", $temp->getTemplate("../template/tag_print_block_tag_b.html"));
        } elseif ($c == 'tag_c') {
            $temp->setReplace("{printlist}", $temp->getTemplate("../template/tag_print_block_tag_c.html"));
        } else {
            if ($cert == 'sts')
                $temp->setReplace("{printlist}", $temp->getTemplate("../template/tag_print_block3.html"));
            else
                $temp->setReplace("{printlist}", $temp->getTemplate("../template/tag_print_block4.html"));
        }
        $id_next += 1;
        $id = $idl . sprintf("%'.04d", $id_next);

        if ($_GET["c"] == 'thai') {
            $uf_act_Weight = $_GET["uf_act_Weight"];
            $WeightShow = $uf_act_Weight;
        } else {
            $WeightShow = $unit_weight * $perpack;
        }
        $temp->setReplace("{unit_weight}", "" . ($WeightShow) . "");
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
        
        $img_qrcode = "";
        $img_tis = "";
        $desc = "";
        $Uf_TheoryWeightPerItem  = "";
        if($TagBarcodePreview->Uf_class == "TIS.107"){
            $img_qrcode = "<img src='./image/2392603330.jpg' width='100' height='100'>";
            $img_tis = "<img src='./image/TIS_107.jpg' width='100' height='100'>";
        }elseif($TagBarcodePreview->Uf_class == "TIS.276"){
            $img_qrcode = "<img src='./image/350563986.png' width='100' height='100'>";
            $img_tis = "<img src='./image/TIS_276.jpg' width='100' height='100'>";
        } elseif($TagBarcodePreview->Uf_class == "TIS.1228") {
            $img_qrcode = "<img src='./image/1612617444.png' width='100' height='100'>"; 
            $img_tis = "<img src='./image/TIS_1228.jpg' width='100' height='100'>";
            $desc = "เหล็กโครงสร้างรูปพรรณขึ้นรูปเย็นสำหรับงานโครงสร้างทั่วไป เหล็กรูปตัวซีมีขอบ";
            $Uf_TheoryWeightPerItem ="weight". " : " . number_format($TagBarcodePreview->Uf_TheoryWeightPerItem,2) . " kg / m.";
        }
        
        
        

        $temp->setReplace("{barcode}", "" . $id . "");
        $temp->setReplace("{Uf_refno}", "" . $TagBarcodePreview->Uf_refno . "");
        $temp->setReplace("{img_qrcode}", "" . $img_qrcode . "");
        $temp->setReplace("{img_tis}", "" . $img_tis . "");
        $temp->setReplace("{desc}", "" . $desc . "");
        $temp->setReplace("{Uf_TheoryWeightPerItem}", "" . $Uf_TheoryWeightPerItem . "");
        
        $temp->setReplace("{spec}", "" . $TagBarcodePreview->spec . "");
        $temp->setReplace("{grade}", $TagBarcodePreview->Uf_Grade);
        $temp->setReplace("{Heat_no}", "" . $Heat_no . "");
        $temp->setReplace("{Uf_tagdesc}", $TagBarcodePreview->Uf_tagdesc);
        $temp->setReplace("{Uf_TypeEnd}", $TagBarcodePreview->Uf_TypeEnd);
        $temp->setReplace("{Uf_NPS}", "" . $TagBarcodePreview->Uf_NPS);
        $temp->setReplace("{Uf_Schedule}", "" . $TagBarcodePreview->Uf_Schedule);
        $temp->setReplace("{Uf_length}", "" . $TagBarcodePreview->Uf_length);
        $temp->setReplace("{Uf_pack}", "" . total_format($perpack) . "");
        $temp->setReplace("{lot}", "" . isset($rs2[1]["lot"]) ? $rs2[1]["lot"] : $lot_tmp . "");
        $temp->setReplace("{pack_no}", "" . $pack . "");
        $temp->setReplace("{sts_no}", $Heat_no);
        $temp->setReplace("{cust_num}", $TagBarcodePreview->cust_name);
        $temp->setReplace("{cust_po}", $TagBarcodePreview->cust_po);
        $temp->setReplace("{addr##1}", $TagBarcodePreview->city);
        //$temp->setReplace("{mfd}", "" . $pdate . "");
        $temp->setReplace("{mfd}", "" . date("Y-m-d H:i") . "");
    }
}
$temp->setReplace("{printlist}", "");
echo $temp->getReplace();
sqlsrv_close($conn);
