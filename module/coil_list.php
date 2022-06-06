<?php
while (list($key, $data) = each($_GET) OR list($key, $data) = each($_POST)) {
	${$key} = trim($data);
}

$temp->setReplace("{crumb}", "");
$temp->setReplace("{pagename}", ' <img src="./image/next.png" border="0" align="absmiddle">พิมพ์แท็ก  Itemซ้ำ');
$temp->setReplace("{content}", $temp->getTemplate("./template/coil_list.html"));

$cSql = new SqlSrv();
$wh = "";
if (isset($id) AND $id != '') {
	//$wh = " and id LIKE '".$id."%'";
	$ids = explode(",",$id);
	foreach($ids as $ida) {	
		$wh .= " or id LIKE '%".$ida."%'";
	}
	$wh = substr($wh, 4);
	$wh = " and (".$wh.")";
	$top = "";
} else {	
	$id = "";
	$top = "";
}
if (isset($grn) AND $grn != '') $wh .= " and grn_num LIKE '".$grn."%'";
else $grn = "";

if (isset($lot) AND $lot != '') $wh .= " and lot LIKE '".$lot."%'";
else $lot = "";

if (isset($coil) AND $coil != '') $wh .= " and uf_coil_no LIKE '".$coil."%'";
else $coil = "";

//$sql = "select ".$top."*, CONVERT(VARCHAR(16), mfg_date, 120)  AS mfg_date from Mv_Bc_tag where (item like 'M%' OR item like 'WSL%')".$wh." order by id desc;";
$sql = "select ".$top."*, CONVERT(VARCHAR(16), mfg_date, 120)  AS mfg_date from Mv_Bc_tag where (item like 'RH%' OR item like 'RC%')".$wh." order by id desc;";
$rs = $cSql->SqlQuery($conn, $sql);

$list = "";
$line = 0;
for($i=1; $i<=$rs[0][0]; $i++) {
	$bg = (($line++)%2 == 0)? "#ffffff":"#ecffff";	
	if ($rs[$i]["active"]) {
		$bg_color = $bg;
		$disable = "";
		$cfont = "black";
	} else {
		$bg_color = "#b2b2b2";
		$disable = " disabled";
		$cfont = "gray";
	}
	$list .= '<tr bgcolor="'.$bg_color.'" class="'.$cfont.'" onmouseover=mOvr(this,"#d2ffff"); onmouseout=mOut(this,"'.$bg_color.'");>
        <td  align="center"><input name="line" type="checkbox" id="line" value="'.$rs[$i]["id"].'"'.$disable.'></td>
        <td>'.$rs[$i]["id"].'</td>
		<td>'.$rs[$i]["grn_num"].'</td>
        <td>'.$rs[$i]["lot"].'</td>		
        <td align="right">'.total_format($rs[$i]["qty1"])." ".$rs[$i]["um1"].'</td>
        <td>'.$rs[$i]["uf_name"].'</td>
        <td align="center">'.$rs[$i]["uf_coil_no"].'</td>
		<td align="center">'.$rs[$i]["uf_spec"].'</td>
        <td align="center">'.$rs[$i]["active"].'</td>
        <td align="center">'.dateformat($rs[$i]["mfg_date"], "d/m/y").'</td>';
		$list .= '<td align="center">';
		if ($rs[$i]["active"] and $rs[$i]["receipt"] != 1) {
			$list .= '<a href="#" onclick="DeleteTag(\''.$rs[$i]["id"].'\');"><img src="./image/del.png" border="0"></a>';
		}
		$list .= '</td></tr>';
}
$temp->setReplace("{list}", $list);
$temp->setReplace("{id}", "".$id."");
$temp->setReplace("{grn}", "".$grn."");
$temp->setReplace("{lot}", "".$lot."");
$temp->setReplace("{coil}", "".$coil."");

?>