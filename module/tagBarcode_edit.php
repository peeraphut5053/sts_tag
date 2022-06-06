<?php
while (list($key, $data) = each($_GET) OR list($key, $data) = each($_POST)) {
	${$key} = trim($data);
}
include "./initial.php";


$cSql = new SqlSrv();
$sql = "update Mv_Bc_tag set qty1 = '".$qty1."', uf_act_Weight = ".str_replace(',','',$uf_act_Weight)." , sts_no = '".$sts_no."'  where id = '".$tag_id."';";
$rs = $cSql->IsUpDel($conn, $sql);
echo $sql;
sqlsrv_close($conn);
?>