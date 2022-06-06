<?php
while (list($key, $data) = each($_GET) OR list($key, $data) = each($_POST)) {
	${$key} = trim($data);
}

$temp->setReplace("{crumb}", "");
$temp->setReplace("{pagename}", '<img src="./image/next.png" border="0" align="absmiddle">พิมพ์แท็ก  Itemรับใหม่');
$temp->setReplace("{content}", $temp->getTemplate("./template/grn_list.html"));

$cSql = new SqlSrv();
if (isset($grn_num) AND $grn_num != '') {
	$wh = " and grn_num LIKE '".$grn_num."%'";
	$top = "";
} else {
	$wh = "";
	$grn_num = "";
	$top = "";
}
if (isset($lot) AND $lot != '') $wh .= " and lot LIKE '".$lot."%'";
else $lot = "";

//if ($tag == 'print_tag_slit') $bgc = "#ffffdf";
//else $bgc = "#e6fff2";
if (!$wh) $top = "TOP 10 ";

$sql = "select ".$top."*, CONVERT(VARCHAR(16), grn_hdr_date, 120)  AS grn_hdr_date from MV_GRN where grn_num <> ''".$wh." order by grn_num desc;";
$rs = $cSql->SqlQuery($conn, $sql);
//echo $sql;
$list = "";
$line = 0;
for($i=1; $i<=$rs[0][0]; $i++) {
	$sql1 = "select top 1 * from Mv_Bc_tag where uf_coil_no = '".$rs[$i]["Uf_coil_no"]."' and active = '1';";
	$rs1 = $cSql->SqlQuery($conn, $sql1);
	//if (isset($rs1[1]["uf_coil_no"])) continue;
	if ($rs1[1]["uf_coil_no"]) continue;
    if (isset($rs[$i]["uf_Width"])) $ufw = $rs[$i]["uf_Width"];
	else $ufw = 0;
	$bg = (($line++)%2 == 0)? "#ffffff":"#f2f2ff";	
	$chval = $rs[$i]["grn_num"]."!!".$rs[$i]["po_num"]."!!".$rs[$i]["lot"]."!!".$rs[$i]["item"]."!!".$rs[$i]["qty_rec"]."!!".$rs[$i]["u_m"];
	$chval .= "!!".$rs[$i]["Uf_Grade"]."!!".$rs[$i]["grn_line"]."!!".$rs[$i]["Uf_manu"]."!!".$rs[$i]["name"]."!!".$rs[$i]["Uf_coil_no"];
	$chval .= "!!".dateformat($rs[$i]["grn_hdr_date"], "m/d/Y")."!!".(isset($rs[$i]["Uf_thickness"])? $rs[$i]["Uf_thickness"]:"")."!!".$ufw;
	$chval .= "!!".$rs[$i]["uf_qty_ship2"];
	$list .= '<tr bgcolor="'.$bg.'" class="font14" onmouseover=mOvr(this,"#d2d2ff"); onmouseout=mOut(this,"'.$bg.'");>       
		<td align="center"><input name="line" type="checkbox" id="line" value="'.$chval.'"></td>
		<td align="right">'.$line.'.</td>
        <td>'.$rs[$i]["grn_num"].'</td>
        <td>'.$rs[$i]["po_num"].'</td>
        <td>'.$rs[$i]["lot"].'</td>
		<td>'.$rs[$i]["name"].'</td>
        <td>'.$rs[$i]["item"].'</td>';
	if (isset($rs[$i]["Uf_Grade"])) $grade = $rs[$i]["Uf_Grade"];
	else $grade = "";
	$list .= '<td>'.$grade.'</td>
        <td align="right">'.total_format($rs[$i]["qty_shipped_conv"]).'</td>
        <td align="right">'.total_format($rs[$i]["qty_rec"]).'</td>
        <td>'.$rs[$i]["u_m"].'</td></tr>';
}
$temp->setReplace("{list}", $list);
$temp->setReplace("{grn_num}", "".$grn_num."");
$temp->setReplace("{lot}", "".$lot."");
//$temp->setReplace("{bgc}", "".$bgc."");
?>