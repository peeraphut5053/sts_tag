<?php
while (list($key, $data) = each($_GET) OR list($key, $data) = each($_POST)) {
	${$key} = trim($data);
}

$temp->setReplace("{crumb}", "");
$temp->setReplace("{pagename}", ' <img src="./image/next.png" border="0" align="absmiddle">บันทึกผลผลิต');
$temp->setReplace("{content}", $temp->getTemplate("./template/unposted_job_forming.html"));
//$temp->setReplace("{act}", "".$act."");

$jobm = explode("+", $jobno);
$sql = "select * from MV_Job where ltrim(job) = '".$jobm[0]."' and suffix = '".$jobm[1]."' and oper_num = '".$jobm[2]."';";
$cSql = new SqlSrv();
$rs = $cSql->SqlQuery($conn, $sql);
$temp->setReplace("{job_no}", "".$jobno."");
$temp->setReplace("{item}", "".$rs[1]["item"]."");
//$temp->setReplace("{item_desc}", "".$rs[1]["item_desc"]."");
if (strpos($rs[1]["item_desc"] , '"'))
	$temp->setReplace("{item_desc}", "'".$rs[1]["item_desc"]."'");
elseif (strpos($rs[1]["item_desc"] , "'"))
	$temp->setReplace("{item_desc}", "\"".$rs[1]["item_desc"]."\"");
else 
	$temp->setReplace("{item_desc}", "\"".$rs[1]["item_desc"]."\"");
$temp->setReplace("{oper_num}", "".$rs[1]["oper_num"]."");
$temp->setReplace("{wc}", "".$rs[1]["wc"]."");
$temp->setReplace("{description}", "".$rs[1]["description"]."");
$temp->setReplace("{trans_date}", date("d/m/Y"));
$temp->setReplace("{start_time}", date('G:i'));
$temp->setReplace("{u_m}", "".$rs[1]["u_m"]."");

$qty1_a = 0;
$qty2_a = 0;
$sql1 = "select * from Mv_Bc_tag where ltrim(job) = '".$jobm[0]."' and suffix = '".$jobm[1]."' and oper_num = '".$jobm[2]."';";
$rs1 = $cSql->SqlQuery($conn, $sql1);
for($i=1; $i<=$rs1[0][0]; $i++) {
	if ($rs1[$i]["uf_grade"] == "A" AND $rs1[$i]["active"]) {
		$qty1_a += $rs1[$i]["qty1"];
		$qty2_a += $rs1[$i]["qty2"];
	}
}
$sql1 = "select * from jobtran_mst where ltrim(job) = '".$jobm[0]."' and suffix = '".$jobm[1]."' and oper_num = '".$jobm[2]."';";
$rs1 = $cSql->SqlQuery($conn, $sql1);
for($i=1; $i<=$rs1[0][0]; $i++) {	
	$qty1_a -= $rs1[$i]["Uf_GradeA"];
	$qty2_a -= $rs1[$i]["Uf_WGradeA"];	
}
if ($qty1_a < 0) $temp->setReplace("{qty1_a}", "0");
else $temp->setReplace("{qty1_a}", "".total_format($qty1_a)."");
if ($qty2_a < 0) $temp->setReplace("{qty2_a}", "0");
else $temp->setReplace("{qty2_a}", "".total_format($qty2_a)."");

//$date = date("m/d/Y");
//$nameOfDay = date('N', strtotime($date));
//echo $nameOfDay;

$sql1 = "select reason_code, description from reason_mst where reason_class = 'mfg scrap' order by reason_code;";
$cSql1 = new SqlSrv();
$rs1 = $cSql1->SqlQuery($conn, $sql1);
$op_reason = '<option value=""> </option>';
for($i=1; $i<=$rs1[0][0]; $i++) {
	$op_reason .= '<option value="'.$rs1[$i]["reason_code"].'">'.addslashes($rs1[$i]["description"]).'</option>';
}

$input_b = "";
$input_c = "";
$input_r = "";
$input_s = "";
for($i=1; $i<=10; $i++) {
	$input_b .= '<tr>
		<td>จำนวน <input name="Uf_B'.$i.'" type="text" id="Uf_B'.$i.'" size="15" class="default" value="0" onClick="this.select();"> '.$rs[1]["u_m"].'</td>
		<td>น้ำหนัก <input name="Uf_WB'.$i.'" type="text" id="Uf_WB'.$i.'" size="15" class="default" value="0" onClick="this.select();"> KG.</td>
		<td>เหตุผล <select name="Uf_ReasonB'.$i.'" id="Uf_ReasonB'.$i.'" class="mydefault">
				'.$op_reason.'
		</select></td>
	</tr>';
}
$temp->setReplace("{input_b}", $input_b);

for($i=1; $i<=10; $i++) {
	$input_c .= '<tr>
		<td>จำนวน <input name="Uf_C'.$i.'" type="text" id="Uf_C'.$i.'" size="15" class="default" value="0" onClick="this.select();"> '.$rs[1]["u_m"].'</td>
		<td>น้ำหนัก <input name="Uf_WC'.$i.'" type="text" id="Uf_WC'.$i.'" size="15" class="default" value="0" onClick="this.select();"> KG.</td>
		<td>เหตุผล <select name="Uf_ReasonC'.$i.'" id="Uf_ReasonC'.$i.'" class="mydefault">
				'.$op_reason.'
		</select></td>
	</tr>';
}
$temp->setReplace("{input_c}", $input_c);

for($i=1; $i<=10; $i++) {
	$input_r .= '<tr>
		<td>จำนวน <input name="Uf_R'.$i.'" type="text" id="Uf_R'.$i.'" size="15" class="default" value="0" onClick="this.select();"> '.$rs[1]["u_m"].'</td>
		<td>น้ำหนัก <input name="Uf_WR'.$i.'" type="text" id="Uf_WR'.$i.'" size="15" class="default" value="0" onClick="this.select();"> KG.</td>
		<td>เหตุผล <select name="Uf_ReasonR'.$i.'" id="Uf_ReasonR'.$i.'" class="mydefault">
				'.$op_reason.'
		</select></td>
	</tr>';
}
$temp->setReplace("{input_r}", $input_r);

for($i=1; $i<=3; $i++) {
	$input_s .= '<tr>
		<td>&nbsp;</td>
		<td>น้ำหนัก <input name="Uf_WS'.$i.'" type="text" id="Uf_WS'.$i.'" size="15" class="default" value="0" onClick="this.select();"> KG.</td>
		<td>เหตุผล <select name="Uf_ReasonS'.$i.'" id="Uf_ReasonS'.$i.'" class="mydefault">
				'.$op_reason.'
		</select></td>
	</tr>';
}
$temp->setReplace("{input_s}", $input_s);
?>