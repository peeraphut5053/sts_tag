<?php
while (list($key, $data) = each($_GET) OR list($key, $data) = each($_POST)) {
	${$key} = trim($data);
}

$temp->setReplace("{crumb}", "");
$temp->setReplace("{pagename}", "Main Menu");
$temp->setReplace("{content}", $temp->getTemplate("./template/main_menu.html"));

if (isset($_COOKIE["m_id"])) $m_id = $_COOKIE["m_id"];
else $m_id = "m1";	
$loadsubfirst = "<script> LoadSubMenu('".$m_id."', './image/".$m_id.".png', './image/".$m_id."_bw.png'); </script>";

$temp->setReplace("{loadsubfirst}", $loadsubfirst);

?>