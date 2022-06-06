<?php
$host = $_SERVER['HTTP_HOST'];
$root = $_SERVER['DOCUMENT_ROOT'];
$self = $_SERVER['PHP_SELF'];
$self_a = explode("/",$self);
$self_fd = explode(".",$self_a[1]);
if ($self_fd[1]<>"php") $path = $self_fd[0];
else $path = "";
$var['path']['root'] = $root."/".$path;
$var['url']['root'] = ((isset($host) && $host=='on') ? 'https://' : 'http://').$host.'/'.$path;
$var['url']['filename'] = basename($self);

include($var['path']['root']."/include/lib.php");	
?>