<?php
while (list($key, $data) = each($_GET) OR list($key, $data) = each($_POST)) {
	${$key} = trim($data);
}
include "./initial.php";

$cSql = new SqlSrv();

if ($slit_lot) {
	$slot = explode("_a_", $slit_lot);
	$jobm = explode("+", $jobno);
	//$sql = "select TOP 1 uf_pack  from Mv_Bc_tag where ltrim(job) = '".$jobm[0]."' and suffix = '".$jobm[1]."' and oper_num = '".$jobm[2]."' and lot like '".$slot[0]."%' and active = '1' order by uf_pack desc;";
	$sql = "select TOP 1 uf_pack  from Mv_Bc_tag where lot like '".$slot[0]."%' and active = '1' and item = '".$item."' order by uf_pack desc;";
	$rs = $cSql->SqlQuery($conn, $sql);
	//echo $sql;
	if (isset($rs[1]["uf_pack"])) $pack_no = $rs[1]["uf_pack"];	
	else  $pack_no = 0;

	$lot = "-".sprintf("%'.03d", ($pack_no+1));
	echo $lot;
} else {
	echo "";
}
?>