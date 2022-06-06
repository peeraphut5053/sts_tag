<?php
while (list($key, $data) = each($_GET) OR list($key, $data) = each($_POST)) {
	${$key} = trim($data);
}

$temp->setReplace("{crumb}", "");
$temp->setReplace("{pagename}", "พิมพ์แท็กสลิตซ้ำ");
$temp->setReplace("{content}", $temp->getTemplate("./template/slit_list.html"));

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
	$wh = "";
	$id = "";
	$top = "TOP 40";
}

if (isset($uf_spec) AND $uf_spec != '') {
	$wh .= " and uf_spec LIKE '%".$uf_spec."%'";
	$top = "";
} else {
	$uf_spec = "";
}

if (isset($lot) AND $lot != '') $wh .= " and lot LIKE '".$lot."%'";
else $lot = "";

if(isset($wh2)) {
	$temp->setReplace("{selected".$wh2."}", " selected");
	if ($wh2==1) $wh .= " and receipt is null";
	if ($wh2==2) $wh .= " and receipt = 1";
	if ($wh2==3) $wh .= " and active = 1";
	if ($wh2==4) $wh .= " and active = 0";
}

$sql = "select ".$top."*, CONVERT(VARCHAR(16), print_date, 120)  AS print_date from Mv_Bc_tag where item like 'W%'".$wh." order by id desc;";
$rs = $cSql->SqlQuery($conn, $sql);
//echo $sql;
$list = "";
$line = 0;
for($i=1; $i<=$rs[0][0]; $i++) {
	$bg = (($line++)%2 == 0)? "#ffffff":"#ffffdf";	
	if ($rs[$i]["active"]) {
		$bg_color = $bg;
		$disable = "";
		$cfont = "black";
	} else {
		$bg_color = "#b2b2b2";
		$disable = " disabled";
		$cfont = "gray";
	}
	$recimg = "";
	if (trim($rs[$i]["receipt"])) $recimg = '<img src="./image/true.gif" width="16" height="16" border="0" alt="">';
	$list .= '<tr bgcolor="'.$bg_color.'" class="'.$cfont.'" onmouseover=mOvr(this,"#ffff88"); onmouseout=mOut(this,"'.$bg_color.'");>
        <td  align="center"><input name="line" type="checkbox" id="line" value="'.$rs[$i]["id"].'"'.$disable.'></td>';
        //<td align="right">'.$line.'.</td>
		$jobso = $rs[$i]["job"];
		if (isset($rs[$i]["suffix"])) $jobso =  $jobso.'+'.$rs[$i]["suffix"];
		if (isset($rs[$i]["oper_num"])) $jobso = $jobso.'+'.$rs[$i]["oper_num"];
	$list .= '<td>'.$rs[$i]["id"].'</td>
		<td>'.$jobso.'</td>		
        <td>'.$rs[$i]["lot"].'</td>
		<td><div id="d_item_'.$rs[$i]["id"].'">'.$rs[$i]["item"].'</div></td>		
		<td>'.$recimg.'</td>
        <td align="right">'.total_format($rs[$i]["qty1"]).'</div></td>        
        <td><div id="d_spec_'.$rs[$i]["id"].'">'.$rs[$i]["uf_spec"].'</div></td>
		<td><div id="edit_b_'.$rs[$i]["id"].'"><a href="#" onclick="inpEditLine(\''.$rs[$i]["id"].'\',\''.$rs[$i]["item"].'\',\''.$rs[$i]["uf_spec"].'\');"><img src="./image/update.png" border="0"></div></a><div id="edit_c_'.$rs[$i]["id"].'" style="display:none;"><a href="#" onclick="scEditLine(\''.$rs[$i]["id"].'\');"><img src="./image/disk.png" border="0"></div></a></td>
        <td align="center">'.$rs[$i]["active"].'</td>
        <td align="center">'.dateformat($rs[$i]["print_date"], "d/m/y H:i").'</td>
        <td align="center">'.$rs[$i]["print_by"].'</td></tr>';
}
$temp->setReplace("{list}", $list);
$temp->setReplace("{id}", "".$id."");
$temp->setReplace("{uf_spec}", "".$uf_spec."");
$temp->setReplace("{lot}", "".$lot."");
?>