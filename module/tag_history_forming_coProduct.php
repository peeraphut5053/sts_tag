<?php

while (list($key, $data) = each($_GET) OR list($key, $data) = each($_POST)) {
	${$key} = trim($data);
}

$temp->setReplace("{crumb}", "เลือก item");
$temp->setReplace("{pagename}", ' <img src="./image/next.png" border="0" align="absmiddle">ประวัติการพิมพ์แท็กท่อ');
$temp->setReplace("{content}", $temp->getTemplate("./template/tag_history_forming_coProduct.html"));

$cSql = new SqlSrv();

$jobm = explode("+", $jobno);
$sql = "select MV_Job.*,job_mst.ord_num,job_mst.Uf_refno, job_mst.Uf_remark from MV_Job LEFT JOIN job_mst ON MV_Job.job = job_mst.job where ltrim(MV_Job.job) = '" . $jobm[0] . "' and MV_Job.suffix = '" . $jobm[1] . "' and MV_Job.oper_num = '" . $jobm[2] . "';";

$rs = $cSql->SqlQuery($conn, $sql);

$sqlitem = "select job.job, job.item , item.description 
, case when mix.item is not null then 'main' else '' end as main_item
from jobitem_mst job inner join item_mst item on item.item = job.item
left join prod_mix_mst mix on mix.item = job.item
where job.job ='$jobm[0]'
order by  case when mix.item is not null then 'main' else '' end desc";

$rsitem = $cSql->SqlQuery($conn, $sqlitem);



$liist_item = "";
for ($i = $rsitem[0][0]; $i >= 1; $i--) {

	if ($rsitem[$i]["main_item"] == "main"){
		$bg_color = "yellow";
	}else {
		$bg_color = "white";
	}
	
$liist_item .= '<tr bgcolor="' . $bg_color . '" class="">
<td  align="center"><input name="item" type="radio" id="' . $rsitem[$i]["job"] . '" value="' . $rsitem[$i]["item"] . '" onclick ="items(this.id,value)";></td>
<td>' .$rsitem[$i]["item"] . '</td>
<td>' . $rsitem[$i]["description"] . '</td>
<td>' . $rsitem[$i]["main_item"] . '</td>';

$liist_item .= '</tr>';
}


$temp->setReplace("{liist_item}", $liist_item);
?>