<?php
while (list($key, $data) = each($_GET)) {
	${$key} = trim($data);
}

//echo "<pre>";
//print_r($_GET);
$bgcl = array(1=>"#17666a", "#00A400", "#db542d", "#2173ed", "#dd2856", "#b0b000", "#b38313", "#603CBA", "#018FA3", "#00006a", "#8f0901", "#425917", "#a28653", "#9b009b", "#cb07bc", "#47478f", "#868686", "#9200c2");
$menu = "";
if ($m_id == "m1") {
	$menu .= blockmenu("บันทึกเวลาเริ่มผลิต", $bgcl[1], "scan_jobOrder_start&linkcmd=clockin_job");
	$menu .= blockmenu("บันทึกเวลา Break Down", $bgcl[2], "scan_jobOrder_start&linkcmd=break_down");	
} elseif ($m_id == "m2") {
	$menu .= blockmenu("พิมพ์แท็ก  Item", $bgcl[5], "grn_list&tag=print_tag_coil");
	$menu .= blockmenu("พิมพ์แท็กสลิต", $bgcl[6], "scan_jobOrder_start&linkcmd=tag_history_slit");
	$menu .= blockmenu("พิมพ์แท็กท่อ", $bgcl[7], "scan_jobOrder_start&linkcmd=tag_history_forming");	
	$menu .= blockmenu("พิมพ์แท็ก Finishing", $bgcl[8], "scan_jobOrder_start&linkcmd=tag_history_finishing");	
	$menu .= blockmenu("พิมพ์แท็ก Improvement", $bgcl[9], "scan_jobOrder_start&linkcmd=tag_history_improvement");
	// $menu .= blockmenu_password("Tag Status", $bgcl[18], "tag_status");	
	$menu .= '<div id="1" class="clear" style="height:5px;">&nbsp;</div>';
	$menu .= '<div id="2" class="clear" style="height:2px; background-color:#0098e1">&nbsp;</div>';
	$menu .= '<div id="3" class="clear" style="height:5px;">&nbsp;</div>';
	$menu .= blockmenu("พิมพ์แท็ก  Item ซ้ำ", $bgcl[10], "coil_list");	
	$menu .= blockmenu("พิมพ์แท็กสลิตซ้ำ", $bgcl[11], "slit_list");	
	$menu .= blockmenu("พิมพ์แท็ก Finishing ซ้ำ", $bgcl[12], "print_tag_fg");
	$menu .= blockmenu("เปลี่ยนเลข Job Barcode", $bgcl[13], "scan_jobOrder_start&linkcmd=tag_re_jobnum");
	$menu .= blockmenu("เปลี่ยนเลข HEAT No.", $bgcl[14], "app_update_sts_no");
	$menu .= blockmenu("พิมพ์ Tag B", $bgcl[15], "scan_jobOrder_start&linkcmd=tag_history_tag_b");
	$menu .= blockmenu("พิมพ์ Tag C", $bgcl[15], "scan_jobOrder_start&linkcmd=tag_history_tag_c");
	$menu .= blockmenu("พิมพ์ Barcode MiscReceipt", $bgcl[16], "AppGenBarcodeMiscReceipt");
	$menu .= blockmenu("Move Qty (เวอร์ชั่นเดิม)", $bgcl[17], "sts_move_qty&linkcmd=movestock");
	$menu .= blockmenu("Move Qty ", $bgcl[17], "sts_move_qty_new&linkcmd=sts_move_qty_new");
	$menu .= blockmenu("Reset Tag ID Shipped", $bgcl[17], "reset_tag_id_shiped");
	$menu .= blockmenu("Delete GRN Line", $bgcl[8], "delete_grn_line");
} elseif ($m_id == "m3") {
	$menu .= blockmenu("บันทึกผลผลิตสลิต", $bgcl[10], "scan_jobOrder_start&linkcmd=unposted_job_slit");
	$menu .= blockmenu("บันทึกผลผลิตท่อ", $bgcl[11], "scan_jobOrder_start&linkcmd=unposted_job_forming");
	$menu .= blockmenu("บันทึกผล Finishing", $bgcl[12], "scan_jobOrder_start&linkcmd=unposted_job_finishing");
} elseif ($m_id == "m4") {
	$menu .= blockmenu("แบ่งแท็ก  Item", $bgcl[15], "split_tag&tag=coil");
	$menu .= blockmenu("แบ่งแท็กสลิต", $bgcl[16], "split_tag&tag=slit");
	$menu .= blockmenu("แบ่งแท็ก Finishing", $bgcl[17], "split_tag&tag=fg");
}
echo $menu;

function blockmenu($tmenu, $bgcl, $link) {
	$m = '<div class="submenufull" style="background-color:'.$bgcl.';"><table width="100%" height="100%" border="0" cellspacing="0" cellpadding="5" class="font14 white">
	<tr>
		<td align="center" class="submenuover" onclick="gotolink(\'./?'.$link.'\');">'.$tmenu.'</td>
	</tr>
	</table></div>';
	return $m;
}

function blockmenu_password($tmenu, $bgcl, $link) {
	$m = '
	<script>
	function myFunction() {
		let password = prompt("Please enter your password");
		if (password == 1234) {
			gotolink(\'./?'.$link.'\');
		} else {
			alert("Incorrect password. Try again."); 
		}
	  }
	</script>
	<div class="submenufull" style="background-color:'.$bgcl.';"><table width="100%" height="100%" border="0" cellspacing="0" cellpadding="5" class="font14 white">
	<tr>
		<td align="center" class="submenuover" onclick="myFunction()">'.$tmenu.'</td>
	</tr>
	</table></div>';
	return $m;
}
?>