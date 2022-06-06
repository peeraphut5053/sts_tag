<?php
function Sec2Time($sec, $s=".") {
	if ($sec < 0) $sec *= -1;
	$h = $sec / 3600;
	$h_a = explode(".", $h);
	$m = $sec - ($h_a[0] * 3600);
	if ($m < 0) $m *= -1;
	$m = $m / 60;
	$m_a = explode(".", $m);
	if ($m_a[0] < 10) {
      $m_a[0] = "0".$m_a[0];
   } 
	$hrs = $h_a[0].$s.$m_a[0];

	return $hrs;
}

function Time2Sec($time) {
	$st_a = explode(":", $time);
	$st_a1 = $st_a[0] * 3600;
	$st_a2 = $st_a[1] * 60;
	$stime = $st_a1 + $st_a2;

	return $stime;
}

function Sec2TimeHrs($sec) {
	if ($sec < 0) $sec *= -1;
	$h = $sec / 3600;
	$h_a = explode(".", $h);
	$m = $sec - ($h_a[0] * 3600);
	if ($m < 0) $m *= -1;
	$m = $m / 60;
	$m_a = explode(".", $m);
	$m_h = $m_a[0] / 60;
	$hrs = $h_a[0] + $m_h;

	return $hrs;
}

function total_format($total,$pn=0,$s=","){
	if (isset($total)) {
		$total = str_replace(",","", $total);
		return number_format($total,$pn,'.',$s);
	} else {
		return 0;
	}
}

function dateformat($date, $format="", $op="") { //เข้าใช้ 2 format d/m/Y หรือ Y/m/d เดือนต้องอยู่กลางเสมอ
		if (trim($date) == "") return ;
		$d1 = preg_split('/[- :]/', $date);
		if (strlen($d1[0])>2) {
			$y = $d1[0];
			$d1[0] = $d1[2];
			$d1[2] = $y;
		}
		//print_r($d1);
		$d = $d1[0];
		$m = $d1[1];
		$y = $d1[2];
		$h = $d1[3];
		$i = $d1[4];

		if (trim($format) == "") 
			$date_f = @mktime($h, $i, 0, $m, $d, $y);
		else {
			$op1 = strtolower(substr($op, -1));
			$op2 = substr($op, 0, -1);
			if ($op1 == "h")
				$date_f = @date($format, mktime($h+$op2, $i, 0, $m, $d, $y));
			elseif ($op1 == "i")
				$date_f = @date($format, mktime($h, $i+$op2, 0, $m, $d, $y));
			elseif ($op1 == "m")
				$date_f = @date($format, mktime($h, $i, 0, $m+$op2, $d, $y));
			elseif ($op1 == "d")
				$date_f = @date($format, mktime($h, $i, 0, $m, $d+$op2, $y));
			elseif ($op1 == "y")
				$date_f = @date($format, mktime($h, $i, 0, $m, $d, $y+$op2));
			else 
				$date_f = @date($format, mktime($h, $i, 0, $m, $d, $y));
		}		
		return ($date_f);
	}
?>