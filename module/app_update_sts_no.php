<?php
while (list($key, $data) = each($_GET) OR list($key, $data) = each($_POST)) {
	${$key} = trim($data);
}

$temp->setReplace("{crumb}", "");
$temp->setReplace("{pagename}", ' <img src="./image/next.png" border="0" align="absmiddle">เปลี่ยนเลข heat no');
$temp->setReplace("{content}", $temp->getTemplate("./template/app_update_sts_no.html"));


?>