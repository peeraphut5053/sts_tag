<?php

while (list($key, $data) = each($_GET) OR list($key, $data) = each($_POST)) {
    ${$key} = trim($data);
}

$temp->setReplace("{crumb}", "พิมพ์แท็กบาร์โค้ด");
$temp->setReplace("{pagename}", ' <img src="./image/next.png" border="0" align="absmiddle">ประวัติการพิมพ์แท็ก Finishing');
$temp->setReplace("{content}", $temp->getTemplate("./template/tag_history_finishing.html"));

$cSql = new SqlSrv();

$jobm = explode("+", $jobno);
$sql = "select MV_Job.*,job_mst.ord_num,job_mst.Uf_refno,job_mst.Uf_remark from MV_Job LEFT JOIN job_mst ON MV_Job.job = job_mst.job where ltrim(MV_Job.job) = '" . $jobm[0] . "' and MV_Job.suffix = '" . $jobm[1] . "' and MV_Job.oper_num = '" . $jobm[2] . "';";
$rs = $cSql->SqlQuery($conn, $sql);
//print_r($rs);
//print qty_mat 
$sql2 = "select CONVERT(DECIMAL(10,0), SUM( mat.qty)) as qty_mat from matltran_mst mat WHERE   1=1 AND  ref_num like '$jobm[0]'  AND  trans_type like '%I%'  ";
$rs2 = $cSql->SqlQuery($conn, $sql2);
$qty_mat = $rs2[1]["qty_mat"];


$sql3 = "select  custaddr_mst.city,isnull(custaddr_mst.addr##2, custaddr_mst.name) as custname,co_mst.* FROM co_mst LEFT JOIN custaddr_mst ON co_mst.cust_num = custaddr_mst.cust_num and co_mst.cust_seq = custaddr_mst.cust_seq where co_num = '" . $rs[1]["ord_num"] . "' ";
$rs3 = $cSql->SqlQuery($conn, $sql3);




$temp->setReplace("{job_no}", "" . $jobno . "");
$temp->setReplace("{co_no}", "" . $rs[1]["ord_num"] . "");
$temp->setReplace("{Uf_refno}", "" . $rs[1]["Uf_refno"] . "");
$temp->setReplace("{Uf_remark}", "" . $rs[1]["Uf_remark"] . "");

if (isset($rs3[1]["city"])) {
    $temp->setReplace("{city}", "" . $rs3[1]["city"] . "");
    $temp->setReplace("{custname}", "" . $rs3[1]["custname"] . "");
} else {
    $temp->setReplace("{city}", "");
    $temp->setReplace("{custname}", "");
}


$temp->setReplace("{item}", "" . $rs[1]["item"] . "");
//$temp->setReplace("{item_desc}", "".$rs[1]["item_desc"]."");
if (strpos($rs[1]["item_desc"], '"'))
    $temp->setReplace("{item_desc}", "'" . $rs[1]["item_desc"] . "'");
elseif (strpos($rs[1]["item_desc"], "'"))
    $temp->setReplace("{item_desc}", "\"" . $rs[1]["item_desc"] . "\"");
else
    $temp->setReplace("{item_desc}", "\"" . $rs[1]["item_desc"] . "\"");
$temp->setReplace("{oper_num}", "" . $rs[1]["oper_num"] . "");
$temp->setReplace("{wc}", "" . $rs[1]["wc"] . "");
$temp->setReplace("{description}", "" . $rs[1]["description"] . "");
$qty_released = total_format($rs[1]["qty_released"]);
$temp->setReplace("{qty_released}", "" . $qty_released . "");
$weight_released = total_format($rs[1]["qty_released"] * $rs[1]["unit_weight"], 2);
$temp->setReplace("{weight_released}", "" . $weight_released . "");
if (isset($rs[1]["qty_released"]) AND isset($rs[1]["Uf_pack"]))
    $pack_released = total_format($rs[1]["qty_released"] / $rs[1]["Uf_pack"]);
else
    $pack_released = 0;
$temp->setReplace("{pack_released}", "" . $pack_released . "");
if (isset($rs[1]["qty_issued"]))
    $qty_issued = total_format($rs[1]["qty_issued"]);
$qty_issued = 0;
$temp->setReplace("{qty_issued}", "" . $qty_issued . "");
$temp->setReplace("{matl_um}", "" . $rs[1]["matl_um"] . "");
//echo substr($rs[1]["item"],0,3);
$item_c = substr($rs[1]["item"], 0, 3);
if ($item_c == 'WSL') {
    $temp->setReplace("{funcprint}", "PrintTagSlit");
} else {
    $temp->setReplace("{funcprint}", "PrintTag");
}

$da = array();
$db = array();
$dc = array();
$dr = array();

$sql = "select *, CONVERT(VARCHAR(16), mfg_date, 120) AS mfg_date"
            . " from Mv_Bc_tag LEFT JOIN (select distinct job, Uf_pack, unit_weight from MV_Job) MV_Job on MV_Job.job = Mv_Bc_tag.job  where ltrim(Mv_Bc_tag.job) = '" . $jobm[0] . "' "
            . " and Mv_Bc_tag.suffix = '" . $jobm[1] . "' "
            . " and Mv_Bc_tag.oper_num = '" . $jobm[2] . "' "
            . " order by Mv_Bc_tag.uf_pack, Mv_Bc_tag.uf_grade;";

$rs = $cSql->SqlQuery($conn, $sql);
for ($i = 1; $i <= $rs[0][0]; $i++) {
    $lota = explode("-", $rs[$i]["lot"]);
    if ($rs[$i]["uf_grade"] == "A") {
        if ($rs[$i]["active"])
            $da[$lota[0]] = $i;
    }
    if ($rs[$i]["uf_grade"] == "B") {
        if ($rs[$i]["active"])
            $db[$lota[0]] = $i;
    }
    if ($rs[$i]["uf_grade"] == "C") {
        if ($rs[$i]["active"])
            $dc[$lota[0]] = $i;
    }
    if ($rs[$i]["uf_grade"] == "R") {
        if ($rs[$i]["active"])
            $dr[$lota[0]] = $i;
    }
}
$qty1_a = 0;
$qty2_a = 0;
$qty1_b = 0;
$qty2_b = 0;
$qty1_c = 0;
$qty2_c = 0;
$qty1_r = 0;
$qty2_r = 0;
$uf_pack_a = 0;
$uf_pack_b = 0;
$uf_pack_c = 0;
$uf_pack_r = 0;
$total_qty1 = 0;
$total_qty2 = 0;
$total_pack = 0;
$list = "";
echo $sql;
for ($i = $rs[0][0]; $i >= 1; $i--) {
    $lota = explode("-", $rs[$i]["lot"]);
    if ($rs[$i]["uf_grade"] == "A" AND $rs[$i]["active"]) {
        $qty1_a += $rs[$i]["qty1"];
        $qty2_a += $rs[$i]["qty2"];
        $uf_pack_a += 1;
    } elseif ($rs[$i]["uf_grade"] == "B" AND $rs[$i]["active"]) {
        $qty1_b += $rs[$i]["qty1"];
        $qty2_b += $rs[$i]["qty2"];
        $uf_pack_b += 1;
    } elseif ($rs[$i]["uf_grade"] == "C" AND $rs[$i]["active"]) {
        $qty1_c += $rs[$i]["qty1"];
        $qty2_c += $rs[$i]["qty2"];
        $uf_pack_c += 1;
    } elseif ($rs[$i]["uf_grade"] == "R" AND $rs[$i]["active"]) {
        $qty1_r += $rs[$i]["qty1"];
        $qty2_r += $rs[$i]["qty2"];
        $uf_pack_r += 1;
    }
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
        <td  align="center"><input name="line" type="checkbox" id="line" value="' . $rs[$i]["id"] . '"' . $disable . '></td>
        <td>' . $rs[$i]["id"] . '</td>
        <td>' . $rs[$i]["lot"] . '</td>
		<td><div id="d_sts_no_' . $rs[$i]["id"] . '">' . $Heat_no . '</div></td>
        <td align="right"><div id="d_qty_' . $rs[$i]["id"] . '">' . total_format($rs[$i]["qty1"]) . '</div></td>
        <td align="right"><div id="d_w_' . $rs[$i]["id"] . '">' . total_format($rs[$i]["uf_act_Weight"], 2) . '</div></td>
        <td align="right"><div id="' . $rs[$i]["id"] . '">' . total_format($rs[$i]["unit_weight"] * $rs[$i]["qty1"], 2) . '</div></td> 
        <td align="center">' . $rs[$i]["uf_pack"] . '</td>
        <td align="center">' . $rs[$i]["uf_grade"] . '</td>
        <td align="center">' . $rs[$i]["active"] . '</td>
        <td align="center">' . dateformat($rs[$i]["mfg_date"], "d/m/y H:i") . '</td>';
    //<td align="center">'.$rs[$i]["print_by"].'</td>';
    $list .= '<td>';
    if ($rs[$i]["active"] and $rs[$i]["receipt"] != 1) {
        $list .= '<div id="edit_b_' . $rs[$i]["id"] . '"><a href="#" onclick="inpEditLine(\'' . $rs[$i]["id"] . '\',\'' . total_format($rs[$i]["qty1"]) . '\',\'' . total_format($rs[$i]["uf_act_Weight"]) . '\',\'' . $rs[$i]["sts_no"] . '\');"><img src="./image/update.png" border="0"></div></a>';
        $list .= '<div id="edit_c_' . $rs[$i]["id"] . '" style="display:none;"><a href="#" onclick="scEditLine(\'' . $rs[$i]["id"] . '\',\'' . total_format($rs[$i]["qty1"]) . '\',\'' . total_format($rs[$i]["uf_act_Weight"]) . '\',\'' . $rs[$i]["sts_no"] . '\');"><img src="./image/disk.png" border="0"></div></a>';
    }

    if (isset($da[$lota[0]])) {
        //if ($rs[$i]["active"] and $i == $da[$lota[0]] and $rs[$i]["receipt"] != 1 and $rs[$i]["uf_grade"] == "A") {
        if ($rs[$i]["active"] and $rs[$i]["receipt"] != 1 and $rs[$i]["uf_grade"] == "A") {
            $list .= '<a href="#" onclick="DeleteTag(\'' . $rs[$i]["id"] . '\');"><img src="./image/del.png" border="0"></a>';
        }
    }
    if (isset($db[$lota[0]])) {
        //if ($rs[$i]["active"] and $i == $db[$lota[0]] and $rs[$i]["receipt"] != 1 and $rs[$i]["uf_grade"] == "B") {
        if ($rs[$i]["active"] and $rs[$i]["receipt"] != 1 and $rs[$i]["uf_grade"] == "B") {
            $list .= '<a href="#" onclick="DeleteTag(\'' . $rs[$i]["id"] . '\');"><img src="./image/del.png" border="0"></a>';
        }
    }
    if (isset($dc[$lota[0]])) {
        //if ($rs[$i]["active"] and $i == $dc[$lota[0]] and $rs[$i]["receipt"] != 1 and $rs[$i]["uf_grade"] == "C") {
        if ($rs[$i]["active"] and $rs[$i]["receipt"] != 1 and $rs[$i]["uf_grade"] == "C") {
            $list .= '<a href="#" onclick="DeleteTag(\'' . $rs[$i]["id"] . '\');"><img src="./image/del.png" border="0"></a>';
        }
    }
    if (isset($dr[$lota[0]])) {
        //if ($rs[$i]["active"] and $i == $dr[$lota[0]] and $rs[$i]["receipt"] != 1 and $rs[$i]["uf_grade"] == "R") {
        if ($rs[$i]["active"] and $rs[$i]["receipt"] != 1 and $rs[$i]["uf_grade"] == "R") {
            $list .= '<a href="#" onclick="DeleteTag(\'' . $rs[$i]["id"] . '\');"><img src="./image/del.png" border="0"></a>';
        }
    }
    $list .= '</td>';
    $list .= '<td align="center">' . ($rs[$i]["inspector"] ? "ตวรจแล้ว" : "ยังไม่ตวรจ") . ($rs[$i]["inspector"] ? '' : ' <button type="button" onclick="inpActiveLine(\'' . $rs[$i]["id"] . '\');">Check</button>') . '</td>';
    $list .= '</tr>';
}
$total_qty1 = $qty1_a;
$total_qty2 = $qty2_a;
$total_pack = $uf_pack_a;
$total_qty1 += $qty1_b;
$total_qty2 += $qty2_b;
$total_pack += $uf_pack_b;
$total_qty1 += $qty1_c;
$total_qty2 += $qty2_c;
$total_pack += $uf_pack_c;
$total_qty1 += $qty1_r;
$total_qty2 += $qty2_r;
$total_pack += $uf_pack_r;

$temp->setReplace("{qty1_a}", "" . total_format($qty1_a) . "");
$temp->setReplace("{qty2_a}", "" . total_format($qty2_a, 2) . "");
$temp->setReplace("{uf_pack_a}", "" . total_format($uf_pack_a) . "");
$temp->setReplace("{qty1_b}", "" . total_format($qty1_b) . "");
$temp->setReplace("{qty2_b}", "" . total_format($qty2_b, 2) . "");
$temp->setReplace("{uf_pack_b}", "" . total_format($uf_pack_b) . "");
$temp->setReplace("{qty1_c}", "" . total_format($qty1_c) . "");
$temp->setReplace("{qty2_c}", "" . total_format($qty2_c, 2) . "");
$temp->setReplace("{uf_pack_c}", "" . total_format($uf_pack_c) . "");
$temp->setReplace("{qty1_r}", "" . total_format($qty1_r) . "");
$temp->setReplace("{qty2_r}", "" . total_format($qty2_r, 2) . "");
$temp->setReplace("{uf_pack_r}", "" . total_format($uf_pack_r) . "");
$temp->setReplace("{total_qty1}", "" . total_format($total_qty1) . "");
$temp->setReplace("{total_qty2}", "" . total_format($total_qty2, 2) . "");
$temp->setReplace("{total_pack}", "" . total_format($total_pack) . "");
$temp->setReplace("{list}", $list);
$temp->setReplace("{qty_mat}", $qty_mat);
?>