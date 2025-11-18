<?php

while (list($key, $data) = each($_GET) OR list($key, $data) = each($_POST)) {
    ${$key} = trim($data);
}
//echo "<pre>";
//print_r($_GET);
//print_r($_POST);
$temp->setReplace("{crumb}", "พิมพ์แท็กบาร์โค้ด");
if (isset($mode)) {
    if ($mode == "tagfinishing") {
        $temp->setReplace("{pagename}", '  <img src="./image/next.png" border="0" align="absmiddle">ประวัติการพิมพ์แท็ก Finishing <img src="./image/next.png" border="0" align="absmiddle">พิมพ์ {static_grade}');
        $temp->setReplace("{content}", $temp->getTemplate("./template/tag_finishing.html"));
    } elseif ($mode == "tagimprovement") {
        $temp->setReplace("{pagename}", ' <img src="./image/next.png" border="0" align="absmiddle">ประวัติการพิมพ์แท็ก Improvement  <img src="./image/next.png" border="0" align="absmiddle">พิมพ์ {static_grade}');
        $temp->setReplace("{content}", $temp->getTemplate("./template/tag_improvement.html"));
    } elseif ($mode == "tag_b") {
        $temp->setReplace("{pagename}", ' <img src="./image/next.png" border="0" align="absmiddle">ประวัติการพิมพ์แท็ก B  <img src="./image/next.png" border="0" align="absmiddle">พิมพ์ {static_grade}');
        $temp->setReplace("{content}", $temp->getTemplate("./template/tag_b.html"));
    } elseif ($mode == "tag_c") {
        $temp->setReplace("{pagename}", ' <img src="./image/next.png" border="0" align="absmiddle">ประวัติการพิมพ์แท็ก C  <img src="./image/next.png" border="0" align="absmiddle">พิมพ์ {static_grade}');
        $temp->setReplace("{content}", $temp->getTemplate("./template/tag_c.html"));
    }
} else {
    $temp->setReplace("{pagename}", ' <img src="./image/next.png" border="0" align="absmiddle">ประวัติการพิมพ์แท็กท่อ co-product <img src="./image/next.png" border="0" align="absmiddle">พิมพ์ {static_grade}');
    $temp->setReplace("{content}", $temp->getTemplate("./template/tag_barcode_coProduct.html"));
}
$cSql = new SqlSrv();

$pdate = date("d/m/Y");

$jobm = explode("+", $jobno);


$sql = "select MV_Job.*,job_mst.ord_num,job_mst.Uf_refno, job_mst.Uf_remark, ji.item as jobitem, item.[description] as jobitem_desc, item.uf_pack as co_uf_pack, item.unit_weight as co_unit_weight, item.u_m as item_u_m
from MV_Job 
LEFT JOIN job_mst ON MV_Job.job = job_mst.job 
left join jobitem_mst ji on ji.job = job_mst.job
inner join item_mst item on item.item = ji.item 
where ltrim(MV_Job.job) = '" . $jobm[0] . "' 
and MV_Job.suffix = '" . $jobm[1] . "' and MV_Job.oper_num = '" . $jobm[2] . "'
and ji.item = '$item'";
// "select MV_Job.*,job_mst.ord_num from MV_Job "
//         . " LEFT Join job_mst ON MV_Job.job = job_mst.ord_num "
//         . " where ltrim(MV_Job.job) = '" . $jobm[0] . "' and MV_Job.suffix = '" . $jobm[1] . "' and oper_num = '" . $jobm[2] . "' order by joblot;";
//print_r($sql);
$rs = $cSql->SqlQuery($conn, $sql);
$item_u_m = $rs[1]["item_u_m"];
function CoType($jobno) {
    $jobSubStr = substr($jobno, 0, 2);
    if (
            $jobSubStr == 'AU' || $jobSubStr == 'US' || $jobSubStr == 'QT' || $jobSubStr == 'RR' || $jobSubStr == 'au' || $jobSubStr == 'us' || $jobSubStr == 'qt' || $jobSubStr == 'rr'
    ) {
        $CoType = 'EX';
    } else {
        $CoType = 'IN';
    }
    return $CoType;
}

$temp->setReplace("{job_no}", "" . $jobno . "");
$temp->setReplace("{co_type}", "" . CoType($jobno) . "");
$temp->setReplace("{item}", "" . $rs[1]["jobitem"] . "");
$item = $rs[1]["jobitem"];
//print_r($rs);
//$temp->setReplace("{item_desc}", "".$rs[1]["item_desc"]."");
if (strpos($rs[1]["item_desc"], '"'))
    $temp->setReplace("{item_desc}", "'" . $rs[1]["jobitem_desc"] . "'");
elseif (strpos($rs[1]["item_desc"], "'"))
    $temp->setReplace("{item_desc}", "\"" . $rs[1]["jobitem_desc"] . "\"");
else
    $temp->setReplace("{item_desc}", "\"" . $rs[1]["jobitem_desc"] . "\"");
$temp->setReplace("{oper_num}", "" . $rs[1]["oper_num"] . "");
$temp->setReplace("{wc}", "" . $rs[1]["wc"] . "");
$temp->setReplace("{description}", "" . $rs[1]["description"] . "");
$qty_released = total_format($rs[1]["qty_released"]);
$temp->setReplace("{qty_released}", "" . $qty_released . "");
$weight_released = total_format($rs[1]["qty_released"] * $rs[1]["co_unit_weight"], 2);
$temp->setReplace("{weight_released}", "" . $weight_released . "");
if (isset($rs[1]["Uf_pack"]) and isset($rs[1]["qty_released"]))
    $pack_released = total_format($rs[1]["qty_released"] / $rs[1]["Uf_pack"]);
else
    $pack_released = 0;
$temp->setReplace("{pack_released}", "" . $pack_released . "");
$temp->setReplace("{Uf_pack}", "" . $rs[1]["Uf_pack"] . "");
$temp->setReplace("{unit_weight}", "" . $rs[1]["co_unit_weight"] . "");
$temp->setReplace("{unit_weight_b}", "" . $rs[1]["co_unit_weight"] . "");
$temp->setReplace("{unit_weight1}", "" . total_format($rs[1]["co_unit_weight"], 2, "") . "");
$temp->setReplace("{uf_sts_job}", "" . $rs[1]["uf_sts_job"] . "");
$temp->setReplace("{qty1}", "" . $rs[1]["Uf_pack"] . "");

$stdpack_weight = $rs[1]["co_unit_weight"] * $rs[1]["Uf_pack"];
$temp->setReplace("{stdpack_weight}", "" . total_format($stdpack_weight, 0, "") . "");
$temp->setReplace("{stdpack_weight1}", "" . total_format($stdpack_weight, 2, "") . "");

//if (isset($mode)) $lot = $rs[1]["uf_sts_job"]; //Edit bu Oum 29/08/2561  โต้งบอกให้แก้
//else $lot = $rs[1]["uf_sts_job"]."-".$rs[1]["joblot"];
$lot = $jobm[0];

$temp->setReplace("{tw}", "" . $tolerances_weight . ""); //ค่า fix จาก config

$sql = "select * from MV_Job_Tran where ltrim(job) = '" . $jobm[0] . "' and suffix = '" . $jobm[1] . "' and oper_num = '" . $jobm[2] . "';";
$rs = $cSql->SqlQuery($conn, $sql);
$Uf_Grade = 0;
$Uf_WGrade = 0;
if ($grade == "A") {
    if (isset($rs[1]["Uf_GradeA"]))
        $Uf_Grade += $rs[1]["Uf_GradeA"];
    if (isset($rs[1]["Uf_WGradeA"]))
        $Uf_WGrade += $rs[1]["Uf_WGradeA"];
} elseif ($grade == "B") {
    if (isset($rs[1]["Uf_GradeB"]))
        $Uf_Grade += $rs[1]["Uf_GradeB"];
    if (isset($rs[1]["Uf_WGradeB"]))
        $Uf_WGrade += $rs[1]["Uf_WGradeB"];
} elseif ($grade == "C") {
    if (isset($rs[1]["Uf_GradeC"]))
        $Uf_Grade += $rs[1]["Uf_GradeC"];
    if (isset($rs[1]["Uf_WGradeC"]))
        $Uf_WGrade += $rs[1]["Uf_WGradeC"];
}

$sql = "select * from Mv_Bc_tag where ltrim(job) = '" . $jobm[0] . "' and suffix = '" . $jobm[1] . "' and oper_num = '" . $jobm[2] . "' and uf_grade = '" . $grade . "' and active = '1';";
$rs = $cSql->SqlQuery($conn, $sql);
//echo $sql;
$qty_line = 0;
$uf_act_Weight = 0;
$pack_no = 0;
$printTagLaw = 0;
for ($i = 1; $i <= $rs[0][0]; $i++) {
    $qty_line += $rs[$i]["qty1"];
    $uf_act_Weight += $rs[$i]["uf_act_Weight"];
    //$pack_no = $rs[$i]["uf_pack"];	
    $printTagLaw = $i;
}

//$sql = "select top 1 uf_pack from Mv_Bc_tag where ltrim(job) = '".$jobm[0]."' and suffix = '".$jobm[1]."' and oper_num = '".$jobm[2]."' and (uf_grade = 'A' or uf_grade = 'R') and active = '1' order by uf_pack desc;";		
if ($grade == "A") {
    $sql = "select top 1 uf_pack  from Mv_Bc_tag where lot like '" . $lot . "%' and active = '1' and item = '" . $item . "' and (uf_grade = 'A' or uf_grade = 'R') order by uf_pack desc;";
} elseif ($grade == "C") {
    $sql = "select top 1 uf_pack  from Mv_Bc_tag where lot like '" . $lot . "%' and active = '1' and item = '" . $item . "' and uf_grade = '" . $grade . "' order by uf_pack desc;";
} elseif ($grade == "R") {
    $sql = "select top 1 uf_pack  from Mv_Bc_tag where lot like '" . $lot . "%' and active = '1' and item = '" . $item . "' and uf_grade = '" . $grade . "' order by uf_pack desc;";
} else {
    $sql = "select top 1 uf_pack  from Mv_Bc_tag where lot like '" . $lot . "%' and active = '1' and item = '" . $item . "' and uf_grade = '" . $grade . "' order by uf_pack desc;";
}
//echo $sql;
$rs = $cSql->SqlQuery($conn, $sql);
if (isset($rs[1]["uf_pack"]))
    $pack_no = $rs[1]["uf_pack"];
else
    $pack_no = 0;

$qty_remain = $Uf_Grade - $qty_line;
if ($qty_remain < 0)
    $qty_remain = 0;


if ($grade == "A") {
    $lot = $lot . "-$num" . sprintf("%'.03d", ($pack_no + 1));
} elseif ($grade == "C") {
    $lot = $lot . "-B" . sprintf("%'.03d", ($pack_no + 1));
} elseif ($grade == "R") {
    $lot = $lot . "-R" . sprintf("%'.03d", ($pack_no + 1));
} else {
    $lot = $lot . "-$num" . sprintf("%'.03d", ($pack_no + 1));
}
//$lot= $sql;
//print_r(sprintf("%'.04d", ($pack_no + 1)));
$temp->setReplace("{pack}", "" . $pack_no . "");
$temp->setReplace("{lot}", "" . $lot . "");
$temp->setReplace("{num}", "" . $num . "");
$temp->setReplace("{Uf_Grade}", "" . total_format($Uf_Grade) . "");
$temp->setReplace("{Uf_WGgrade}", "" . total_format($Uf_WGrade, 2) . "");
$temp->setReplace("{qty_line}", "" . total_format($qty_line) . "");
$temp->setReplace("{uf_act_Weight1}", "" . total_format($uf_act_Weight, 2) . "");
$temp->setReplace("{pack_no}", "" . total_format($printTagLaw) . "");
$temp->setReplace("{static_grade}", "" . $grade . "");
$temp->setReplace("{pdate}", "" . $pdate . "");
$temp->setReplace("{item_u_m}", $item_u_m);
if ($grade == "A") {
    $temp->setReplace("{event_ch}", 'onBlur="ChkActWeight();" ');
} else {
    $temp->setReplace("{event_ch}", "");
}
?>