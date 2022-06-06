
<?php

include "../../initial.php";

if ($_POST["ajax"] == "check_sts_no") {
    $TagBarcode = new TagBarcode();
    $TagBarcode->check_sts_no($_POST["tag_ids"]);
    $myObj = $TagBarcode->check_sts_no($_POST["tag_ids"]);
    $myJSON = json_encode($myObj);
    echo $myJSON;
}


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

