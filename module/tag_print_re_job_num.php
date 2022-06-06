<?php

while (list($key, $data) = each($_GET) or list($key, $data) = each($_POST)) {
    ${$key} = trim($data);
}
include "./initial.php";




$temp = new ReplaceHtml("../template/tag_print.html");

if (isset($_POST["tag_ids"])) {
    if ($c == 'usa')
        $temp->setReplace("{printlist}", $temp->getTemplate("../template/tag_print_block2.html"));
    else {
        if ($cert == 'sts')
            $temp->setReplace("{printlist}", $temp->getTemplate("../template/tag_print_block3.html"));
        else
            $temp->setReplace("{printlist}", $temp->getTemplate("../template/tag_print_block4.html"));
    }
    $id = $_POST["tag_ids"];
    $jobm0 = $job_no;
    $TagBarcode = new TagBarcode();
    $TagBarcode->GetTagBarcodeReprint($id, $jobm0);

    if ($TagBarcode->item != $_POST["item"]) {
        echo "Item code ของ Tag ไม่ตรงกับ item code ใน Job";
        exit;
    }
    if ($TagBarcode->qty1 < 1) {
        echo "ยอด qty1  = 0 ไม่สามารถ print ได้";
        exit;
    }
//isset($TagBarcode->sts_no

    if ($_POST['sts_no'] != "") {
        $Heat_no_obj = new FunctionCenter();
        $Heat_no = $Heat_no_obj->GetHeatNo($_POST['sts_no'], $_POST['sts_no2'], "", $_POST['qty_sts_no'], $_POST['qty_sts_no2'], "");
    } else {
        $Heat_no = $TagBarcode->Heat_no;
    }


    $lot = $TagBarcode->GetGenLot($jobm0, $TagBarcode->GetLateBundle_ReJob($jobm0));
    $temp->setReplace("{barcode}", "" . $id . "");
    $temp->setReplace("{Uf_refno}", "" . $TagBarcode->Uf_refno . "");
    $temp->setReplace("{spec}", "" . $TagBarcode->spec . "");
    $temp->setReplace("{grade}", $TagBarcode->Uf_Grade);
    $temp->setReplace("{Uf_tagdesc}", $TagBarcode->Uf_tagdesc);
    $temp->setReplace("{Uf_TypeEnd}", $TagBarcode->Uf_TypeEnd);
    $temp->setReplace("{Uf_NPS}", $TagBarcode->Uf_NPS);
    $temp->setReplace("{Uf_Schedule}", $TagBarcode->Uf_Schedule);
    $temp->setReplace("{Uf_length}", $TagBarcode->Uf_length);
    $temp->setReplace("{Uf_pack}", "" . total_format($TagBarcode->qty1) . "");
    $temp->setReplace("{lot}", $lot);
    $temp->setReplace("{unit_weight}", $TagBarcode->uf_act_Weight);
    $temp->setReplace("{pack_no}", $TagBarcode->GetLateBundle_ReJob($jobm0));
    $temp->setReplace("{Heat_no}", $Heat_no);
    $temp->setReplace("{sts_no}", $Heat_no);
    $temp->setReplace("{cust_num}", $TagBarcode->cust_name);
    $temp->setReplace("{cust_po}", $TagBarcode->cust_po);
    $temp->setReplace("{addr##1}", $TagBarcode->city);
    $temp->setReplace("{mfd}", "" . dateformat($TagBarcode->print_date, "d/m/Y") . "");
}
$temp->setReplace("{printlist}", "");
echo $temp->getReplace();
sqlsrv_close($conn);
