<?php
while (list($key, $data) = each($_GET) OR list($key, $data) = each($_POST)) {
	${$key} = trim($data);
}
include "./initial.php";

$sql = "select * from mv_bc_tag where id = '" . $id_tag . "';";

//echo $sql;
$cSql = new SqlSrv();
$rs = $cSql->SqlQuery($conn, $sql);
if ($rs[1]) {
	echo json_encode($rs[1]);
  } else {
	echo json_encode('false');
	http_response_code(404);
  }
?>