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
$sql = "update Mv_Bc_tag set inspector = '" . $inspector . "', inspec_date = getdate(), comp_name = '" . $computerName . "' where id = '".$tag_id."';";
$rs = $cSql->IsUpDel($conn, $sql);
echo $rs;

sqlsrv_close($conn);
?>