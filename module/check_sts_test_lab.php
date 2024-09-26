<?php

$temp->setReplace("{crumb}", "");
$temp->setReplace("{pagename}", '<img src="./image/next.png" border="0" align="absmiddle">check_sts_test_lab');
$temp->setReplace("{content}", $temp->getTemplate("./template/check_sts_test_lab.html"));

?>