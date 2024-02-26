<?php
while (list($key, $data) = each($_GET) OR list($key, $data) = each($_POST)) {
	${$key} = trim($data);
}
include "./initial.php";

if ( $load = "save") {

	$cSql = new SqlSrv();
	$sql1 = "select * from  STS_forming_operation
	where job = '" . $operationJob. "' 
	and w_c = '" . $w_c. "' ";
    $rs1 = $cSql->SqlQuery($conn, $sql1);

	if ($rs1[1]['job'] == $operationJob){
		$sql = "update STS_forming_operation set operationWeight = '".$operationWeight."' ,operationTime = '".$operationTime."' where job = '" . $operationJob . "' and w_c = '" . $w_c. "' and item = '" . $operationItem. "'  ";
	}else {
		$sql = "insert into STS_forming_operation (operationWeight,operationTime,w_c,job,item)
		VALUES ('".$operationWeight."','".$operationTime."','".$w_c."','".$operationJob."','".$operationItem."')"; 
	}

	$rs = $cSql->SqlQuery($conn, $sql);
	echo $sql;
}

?>

