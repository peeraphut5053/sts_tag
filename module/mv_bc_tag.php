<?php

foreach ($_GET as $key => $value) {
    $$key = trim($value);
}

foreach ($_POST as $key => $value) {
    $$key = trim($value);
}

include "./initial.php";

if ($load == "old_lot") {
	$sql = "select * from mv_bc_tag where id = '" . $id_tag . "';";

	$sql2 = "select job.job, job.item
from jobmatl_mst job
  inner join mv_bc_tag tag on tag.item = job.item
where job.job ='" . $jobno . "'
   and tag.id ='" . $id_tag . "'";

//echo $sql;
$cSql = new SqlSrv();
$rs = $cSql->SqlQuery($conn, $sql);
$rs2 = $cSql->SqlQuery($conn, $sql2);

array_splice($rs2, count($rs2) - 1, 1);

$check = $rs2 ? true : false;

if ($check) {
	
} else {
	echo json_encode(false);
	http_response_code(404);
	return;
}

if ($rs[1]) {
	echo json_encode($rs[1]);
  } else {
	echo json_encode(false);
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

if ($load == "test") {
	$sql = "EXEC [dbo].[STS_lab_HRC_tag]
  @startDate = NULL,
  @endDate = NULL,
  @tag = '$tag_id',
  @sts_no = NULL";
	$cSql = new SqlSrv();
	$rs = $cSql->SqlQuery($conn, $sql);
	if ($rs[1]) {
		echo json_encode($rs[1]);
	} else {
		echo json_encode('false');
		http_response_code(404);
	}
}

if ($load == "test2") {
  $sql = "select sts_po_qc.grade, STS_QA_LAB.* 
from STS_QA_LAB inner join sts_po_qc
  on STS_QA_LAB.sts_no = sts_po_qc.sno and STS_QA_LAB.c_no = sts_po_qc.c_no
  and STS_QA_LAB.h_no = sts_po_qc.h_no where STS_QA_LAB.sts_no = '$sts_no'";
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
