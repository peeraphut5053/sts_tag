<?php
ini_set('display_errors', 1);
error_reporting(~0);

$serverName 	= $var['mssq']['host'];	
$userName = $var['mssq']['user'];
$userPass = $var['mssq']['pass'];
$dbName = $var['mssq']['db'];

$connectionInfo = array("Database"=>$dbName, "UID"=>$userName, "PWD"=>$userPass, "MultipleActiveResultSets"=>true, "CharacterSet"  => 'utf-8');
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if(!$conn){
	echo "<pre>";
	die( print_r( sqlsrv_errors(), true));
}
?>