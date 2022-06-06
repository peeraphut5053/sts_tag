<?php

while (list($key, $data) = each($_GET) OR list($key, $data) = each($_POST)) {
    ${$key} = trim($data);
}

$temp->setReplace("{crumb}", "พิมพ์แท็กบาร์โค้ด");
$temp->setReplace("{pagename}", ' <img src="./image/next.png" border="0" align="absmiddle">เปลี่ยนเลข Job Barcode');
$temp->setReplace("{content}", $temp->getTemplate("./template/tag_re_jobnum.html"));

$cSql = new SqlSrv();

$jobm = explode("+", $jobno);
$sql = "select MV_Job.*,job_mst.ord_num,job_mst.Uf_refno from MV_Job LEFT JOIN job_mst ON MV_Job.job = job_mst.job where ltrim(MV_Job.job) = '" . $jobm[0] . "' and MV_Job.suffix = '" . $jobm[1] . "' and MV_Job.oper_num = '" . $jobm[2] . "';";
$rs = $cSql->SqlQuery($conn, $sql);
//print_r($rs);
//print qty_mat 
$sql2 = "select CONVERT(DECIMAL(10,0), SUM( mat.qty)) as qty_mat from matltran_mst mat WHERE   1=1 AND  ref_num like '$jobm[0]'  AND  trans_type like '%I%'  ";
$rs2 = $cSql->SqlQuery($conn, $sql2);
$qty_mat = $rs2[1]["qty_mat"];

$sql3 = "select  custaddr_mst.city,custaddr_mst.name as custname,co_mst.* FROM co_mst LEFT JOIN custaddr_mst ON co_mst.cust_num = custaddr_mst.cust_num and co_mst.cust_seq = custaddr_mst.cust_seq where co_num = '" . $rs[1]["ord_num"] . "' ";
$rs3 = $cSql->SqlQuery($conn, $sql3);

$temp->setReplace("{job_no}", "" . $jobm[0] . "");
$temp->setReplace("{item}", "" . $rs[1]["item"] . "");
$temp->setReplace("{co_no}", "" . $rs[1]["ord_num"] . "");
$temp->setReplace("{Uf_refno}", "" . $rs[1]["Uf_refno"] . "");

if (isset($rs3[1]["city"])) {
    $temp->setReplace("{city}", "" . $rs3[1]["city"] . "");
    $temp->setReplace("{custname}", "" . $rs3[1]["custname"] . "");
} else {
    $temp->setReplace("{city}", "");
    $temp->setReplace("{custname}", "");
}


if (isset($rs[1]["qty_released"]) AND isset($rs[1]["Uf_pack"]))
    $pack_released = total_format($rs[1]["qty_released"] / $rs[1]["Uf_pack"]);
else
    $pack_released = 0;
$temp->setReplace("{pack_released}", "" . $pack_released . "");
if (isset($rs[1]["qty_issued"]))
    $qty_issued = total_format($rs[1]["qty_issued"]);
$qty_issued = 0;

//echo substr($rs[1]["item"],0,3);
$item_c = substr($rs[1]["item"], 0, 3);
if ($item_c == 'WSL') {
    $temp->setReplace("{funcprint}", "PrintTagSlit");
} else {
    $temp->setReplace("{funcprint}", "PrintTag");
}

$TagBarcode = new TagBarcode();
$TagBarcode->GetItemMst($rs[1]["item"]);


$sqlqty1 = "select  Uf_pack from MV_JOB where job = '$jobm[0]' ";
$rsqty1 = $cSql->SqlQuery($conn, $sqlqty1);

$temp->setReplace("{qty1}", $rsqty1[1]["Uf_pack"]);


$sql = "select *, CONVERT(VARCHAR(16), mfg_date, 120)  AS mfg_date from Mv_Bc_tag where ltrim(job) = '" . $jobm[0] . "' and suffix = '" . $jobm[1] . "' and oper_num = '" . $jobm[2] . "' order by uf_pack,lot, uf_grade;";
$rs = $cSql->SqlQuery($conn, $sql);


$list = "";

for ($i = $rs[0][0]; $i >= 1; $i--) {
    $lota = explode("-", $rs[$i]["lot"]);
    
    if ($rs[$i]["active"]) {
        $bg_color = "#ffffff";
        $disable = "";
        $cfont = "black";
    } else {
        $bg_color = "#b2b2b2";
        $disable = " disabled";
        $cfont = "gray";
    }

    $Heat_no_obj = new FunctionCenter();
    $Heat_no = $Heat_no_obj->GetHeatNo($rs[$i]['sts_no'], $rs[$i]['sts_no2'], $rs[$i]['sts_no3'], $rs[$i]['qty_sts_no'], $rs[$i]['qty_sts_no2'], $rs[$i]['qty_sts_no3']);
    $temp->setReplace("{Heat_no}", "" . $Heat_no . "");
    $list .= '<tr bgcolor="' . $bg_color . '" class="' . $cfont . '">
        <td>' . $rs[$i]["id"] . '</td>
        <td>' . $rs[$i]["lot"] . '</td>
	<td><button type="button" data-toggle="modal" data-target="#myModal" onclick=open_model(' . $rs[$i]["id"] . ')>' . $Heat_no . '&nbsp;</button>'
            . '<div id="d_sts_no_' . $rs[$i]["id"] . '"></div></td>
        <td align="right"><div id="d_qty_' . $rs[$i]["id"] . '">' . total_format($rs[$i]["qty1"]) . '</div></td>
        <td align="right"><div id="d_w_' . $rs[$i]["id"] . '">' . total_format($rs[$i]["uf_act_Weight"], 2) . '</div></td>
        <td align="center">' . $rs[$i]["uf_pack"] . '</td>
        <td align="center">' . $rs[$i]["uf_grade"] . '</td>
        <td align="center">' . $rs[$i]["active"] . '</td>
        <td align="center">' . dateformat($rs[$i]["mfg_date"], "d/m/y H:i") . '</td>';
    //<td align="center">'.$rs[$i]["print_by"].'</td>';

    $list .= '</tr>';
}

$temp->setReplace("{list}", $list);
?>