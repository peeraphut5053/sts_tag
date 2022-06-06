<?php
while (list($key, $data) = each($_GET) OR list($key, $data) = each($_POST)) {
	${$key} = trim($data);
}


$temp->setReplace("{crumb}", "");
$temp->setReplace("{pagename}", '<img src="./image/next.png" border="0" align="absmiddle">ย้ายสินค้า');
$temp->setReplace("{content}", $temp->getTemplate("./template/sts_move_qty_new.html"));
//$temp->setReplace("{content}", $temp->getTemplate("./template/sts_move_qty/iframe_page.html"));
$temp->setReplace("{linkcmd}", "".$linkcmd."");

?>