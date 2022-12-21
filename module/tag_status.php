<?php
while (list($key, $data) = each($_GET) OR list($key, $data) = each($_POST)) {
	${$key} = trim($data);
}
$temp->setReplace("{crumb}", "");
$temp->setReplace("{pagename}", '<img src="./image/next.png" border="0" align="absmiddle">Tag_Status');
$temp->setReplace("{content}", $temp->getTemplate("./template/tag_status.html"));


if (isset($BtnSearch) AND $BtnSearch == 'SEARCH') {
$cSql = new SqlSrv();
if (isset($tag_id) AND $tag_id != '') {
	$wh = " and id LIKE '".$tag_id."%'";
	$top = "";
} else {
	$wh = "";
	$tag_id = "";
	$top = "";
}
if (isset($sts_no) AND $sts_no != '') $wh .= " and sts_no LIKE '".$sts_no."%'";
else $sts_no = "";

if (isset($job) AND $job != '') $wh .= " and job LIKE '".$job."%'";
else $job = "";

if (isset($item) AND $item != '') $wh .= " and item LIKE '".$item."%'";
else $item = "";

if (isset($lot) AND $lot != '') $wh .= " and lot LIKE '".$lot."%'";
else $lot = "";

if (isset($tag_status ) AND $tag_status  != '') $wh .= " and tag_status LIKE '".$tag_status."%'";
else $tag_status  = "";

if (isset($mfg_date ) AND $mfg_date  != '') $wh .= " and mfg_date between '".($mfg_date)." 00:00:00.000' and  '".($mfg_date)." 23:59:59.000'";
else $mfg_date  = "";

$sql = "select * from mv_bc_tag where id <> ''".$wh." order by id asc;";

if (!$wh) $sql = "";

// "select id,sts_no,job,item,lot,qty1,tag_status,detail from mv_bc_tag where mfg_date between '".($mfg_date)." 00:00:00.000' and  '".($mfg_date)." 23:59:59.000' order by id asc";

$rs = $cSql->SqlQuery($conn, $sql);
echo $sql;

$list = "";
$line = 0;

function select_value($tag_status){
    
    if(trim($tag_status)=="Good"){
        $option_select = "<option value='Good' selected> Good </option>"
                . "<option value='OnHold'> OnHold </option>";
    }else if(trim($tag_status)=="OnHold"){
        $option_select = "<option value='Good'  > Good </option>"
                . "<option value='OnHold' selected > OnHold </option>";
    }else{
        $option_select = "<option selected disabled value=''>-- select --</option>"
                . "<option value='Good' > Good </option>"
                . "<option value='OnHold'> OnHold </option>"; 
    }
    
    return $option_select;
}

for($i=1; $i<=$rs[0][0]; $i++) {
	$bg = (($line++)%2 == 0)? "#ffffff":"#f2f2ff";	
	$list .= '<tr bgcolor="'.$bg.'" class="font14" onmouseover=mOvr(this,"#d2d2ff"); onmouseout=mOut(this,"'.$bg.'");>
		<td>'.$rs[$i]["id"].'</td>
        <td>'.$rs[$i]["sts_no"].'</td>
        <td>'.$rs[$i]["job"].'</td>
        <td>'.$rs[$i]["item"].'</td>
		<td>'.$rs[$i]["lot"].'</td>
        <td>'.$rs[$i]["qty1"].'</td>
		<td>
		<select style="" name="'.$rs[$i]["id"].'" id="'.$rs[$i]["id"].'" onchange="UpdateStatus(this.id,value)"> //display:none
		'.select_value($rs[$i]["tag_status"]).'
	  </select>
		</td> 
        <td>
            <input type="text" size="30" id="'.$rs[$i]["id"].'" name="'.$rs[$i]["id"].'" value="'.$rs[$i]["detail"].'" onblur="SaveDetail(this.id,value)">
        </td>
        </tr>';
}}

if(trim($tag_status)=="Good"){
    $select_status = "<option value='Good' selected> Good </option>"
            . "<option value='OnHold'> OnHold </option>";
}else if(trim($tag_status)=="OnHold"){
    $select_status = "<option value='Good'  > Good </option>"
            . "<option value='OnHold' selected > OnHold </option>";
}else{
    $select_status = "<option selected disabled value=''>-- select --</option>"
            . "<option value='Good' > Good </option>"
            . "<option value='OnHold'> OnHold </option>"; 
}

$temp->setReplace("{list}", $list);
$temp->setReplace("{tag_id}", "".$tag_id."");
$temp->setReplace("{sts_no}", "".$sts_no."");
$temp->setReplace("{job}", "".$job."");
$temp->setReplace("{item}", "".$item."");
$temp->setReplace("{lot}", "".$lot."");
$temp->setReplace("{tag_status}", "".$select_status."");
$temp->setReplace("{mfg_date}", "".$mfg_date."");
?>