<?php
while (list($key, $data) = each($_GET) OR list($key, $data) = each($_POST)) {
	${$key} = trim($data);
}
$temp->setReplace("{crumb}", "");
$temp->setReplace("{pagename}", '<img src="./image/next.png" border="0" align="absmiddle">สแกนใบสั่งผลิต');
$temp->setReplace("{content}", $temp->getTemplate("./template/scan_grn_lot_start.html"));
$temp->setReplace("{linkcmd}", "".$linkcmd."");

?>