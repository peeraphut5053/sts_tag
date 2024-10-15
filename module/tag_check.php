<?php 

foreach ($_GET as $key => $value) {
    $$key = trim($value);
}

foreach ($_POST as $key => $value) {
    $$key = trim($value);
}

include "./initial.php";

//echo "<pre>";
//print_r($_POST);
//exit();
$cSql = new SqlSrv();
$computerName = gethostname();
$sql = "update Mv_Bc_tag set inspector = null, inspec_date = null, comp_name = null where id = '".$tag_id."';";
$rs = $cSql->IsUpDel($conn, $sql);
echo $rs;

sqlsrv_close($conn);
?>