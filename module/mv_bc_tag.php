<?php
while (list($key, $data) = each($_GET) OR list($key, $data) = each($_POST)) {
	${$key} = trim($data);
}
include "./initial.php";

if ($load == "old_lot") {
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
}

if ($load == "scan") {
	$sql = "select id, sts_no, sts_no2,sts_no3, qty_sts_no, qty_sts_no2, qty_sts_no3, qty1, qty2 
from mv_bc_tag
where id = '" . $tag_id . "';";

//echo $sql;
$cSql = new SqlSrv();
$rs = $cSql->SqlQuery($conn, $sql);
if ($rs[1]) {
	echo json_encode($rs[1]);
  } else {
	echo json_encode('false');
	http_response_code(404);
  }
}

?>
