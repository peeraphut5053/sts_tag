<?php
while (list($key, $data) = each($_GET) OR list($key, $data) = each($_POST)) {
	${$key} = trim($data);
}
$temp->setReplace("{crumb}", "");
$temp->setReplace("{pagename}", '<img src="./image/next.png" border="0" align="absmiddle">reset_tag_status');
$temp->setReplace("{content}", $temp->getTemplate("./template/reset_tag_status.html"));

?>