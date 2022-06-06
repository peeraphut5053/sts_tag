<?php
while (list($key, $data) = each($_GET) OR list($key, $data) = each($_POST)) {
	${$key} = trim($data);
}
include "./initial.php";

//echo "<pre>";
//print_r($_GET);
//print_r($_POST);
//exit();

if (!isset($_POST["grndata"])) {
	echo "2";
	exit;
}

$cSql = new SqlSrv();

$gdn = count($_POST["grndata"]);
for ($t=0; $t<$gdn; $t++) {
	$data = explode("!!", $_POST["grndata"][$t]);
	$id = $_POST["ids"][$t];
	$print_day = date("m/d/Y H:i");
	if (trim($data[12])=="") $data[12] = 0;
	$sql = "insert into Mv_Bc_tag (id, item, lot, qty1, mfg_date, print_date, ship_stat, active, grn_num, um1, uf_grade, grn_line, Uf_manu, uf_name, uf_coil_no, uf_Tickness, po_num, uf_width, uf_spec, qty2, receipt) values ('".$id."', '".$data[3]."', '".$data[2]."', '".$data[4]."', '".$data[11]."', '".$print_day."', '0', '1', '".$data[0]."', '".$data[5]."', 'A', '".$data[7]."', '".$data[8]."', '".$data[9]."', '".$data[10]."', '".$data[12]."', '".$data[1]."', '".$data[13]."', '".$data[6]."', '".$data[14]."', '1');";
	//echo $sql." =======================";
	$rs1 = $cSql->IsUpDel($conn, $sql);
	
	$sql3 = "DISABLE TRIGGER dbo.grn_line_mstIup ON dbo.grn_line_mst";
	$rs3 = $cSql->IsUpDel($conn, $sql3);
	
	$sql2 = "UPDATE grn_line_mst SET Uf_tag_status = '1' WHERE grn_num = '".$data[0]."' AND grn_line = '".$data[7]."';";
	$rs2 = $cSql->IsUpDel($conn, $sql2);

	$sql4 = "ENABLE TRIGGER dbo.grn_line_mstIup ON dbo.grn_line_mst";
	$rs4 = $cSql->IsUpDel($conn, $sql4);

}
echo $rs1;
sqlsrv_close($conn);
?>