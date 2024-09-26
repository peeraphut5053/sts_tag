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

if ($load == "test") {

	$where = '';

	if ($tag_id != '') {
		$where = " and mv_bc_tag.id = '" . $tag_id . "'";
	}

	if ($sts_no != '') {
		$where = " and mv_bc_tag.sts_no = '" . $sts_no . "'";
	}

	$sql = "select  qc_oper_num , id 
  , uf_nps as size, item_mst.uf_schedule, item_mst.uf_length, item_mst.uf_spec as [standard]
  , item_mst.uf_grade
   ,sts_no = sts_po_qc.sno --mv_bc_tag.sts_no
  , STS_QA_LAB.c_no as Coil_No, STS_po_qc.h_no as Heat_no
  , matltran_mst.wc as FM, concat(sts_po_qc.thick,' x ',sts_po_qc.width) as thick
  , convert(date,mv_bc_tag.mfg_date) as [date], mv_bc_tag.item
  , sts_po_qc.grade
  , mv_bc_tag.lot
  , STS_QA_LAB.sts_c
  , STS_QA_LAB.sts_si
  , STS_QA_LAB.sts_mn
  , STS_QA_LAB.sts_p
  , STS_QA_LAB.sts_s
  , STS_QA_LAB.sts_cu
  , STS_QA_LAB.sts_v
  , STS_QA_LAB.sts_ni
  , STS_QA_LAB.sts_cr
  , STS_QA_LAB.sts_mo
  , STS_QA_LAB.sts_ti
  , STS_QA_LAB.sts_nb
  , STS_QA_LAB.sts_al
  , STS_QA_LAB.sts_b
  , STS_QA_LAB.sts_co
  , STS_QA_LAB.sts_pb
  , STS_QA_LAB.sts_fe
  , STS_QA_LAB.sts_ts
  , STS_QA_LAB.sts_ys
  , STS_QA_LAB.sts_el
from mv_bc_tag inner join item_mst on item_mst.item = mv_bc_tag.item
      inner join sts_po_qc on sno <> '' and
        ( Ltrim(rtrim(sts_po_qc.sno)) = mv_bc_tag.sts_no 
        or Ltrim(rtrim(sts_po_qc.sno)) = Ltrim(rtrim(mv_bc_tag.sts_no2))
        or Ltrim(rtrim(sts_po_qc.sno)) = Ltrim(rtrim(mv_bc_tag.sts_no3))
         )

   inner join matltran_mst on matltran_mst.lot = mv_bc_tag.lot --and matltran_mst.item = mv_bc_tag.item
      and matltran_mst.trans_type='F'
   left join STS_QA_LAB on Ltrim(rtrim(STS_QA_LAB.sts_no)) = Ltrim(rtrim(sts_po_qc.sno)) 
 --  and STS_QA_LAB.c_no = sts_po_qc.c_no 
   and Ltrim(rtrim(STS_QA_LAB.h_no)) = Ltrim(rtrim(sts_po_qc.h_no))
   and Ltrim(rtrim(STS_QA_LAB.thick)) = Ltrim(rtrim(sts_po_qc.thick)) 
   and Ltrim(rtrim(STS_QA_LAB.width)) = Ltrim(rtrim(sts_po_qc.width))
where mv_bc_tag.active = 1 and matltran_mst.wc like '%FM%' $where";
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
