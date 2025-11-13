<?php

$temp->setReplace("{crumb}", "");
$temp->setReplace("{pagename}", '<img src="./image/next.png" border="0" align="absmiddle">พิมพ์บาร์โค้ด Lot');
$temp->setReplace("{content}", $temp->getTemplate("./template/print_lot_barcode.html"));

?>