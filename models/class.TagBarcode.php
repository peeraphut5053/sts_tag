<?php

class TagBarcode extends sqlConn {

    public $item;
    public $qty1;
    public $ord_num;
    public $ord_type;
    public $Uf_refno;
    public $Uf_Grade;
    public $Uf_tagdesc;
    public $Uf_TypeEnd;
    public $Uf_NPS;
    public $Uf_Schedule;
    public $Uf_length;
    public $Uf_spec;
    public $Uf_class;
    public $lot;
    public $uf_act_Weight;
    public $uf_pack;
    public $print_date;
    public $sts_no;
    public $sts_no2;
    public $sts_no3;
    public $qty_sts_no;
    public $qty_sts_no2;
    public $qty_sts_no3;
    public $cust_num;
    public $cust_seq;
    public $cust_po;
    public $Uf_StsPO_refNo;
    public $cust_name;
    public $city;
    public $Heat_no;
    public $spec;
    public $unit_weight;

    function GetTagBarcodeReprint($id) {
        $cSql = new SqlSrv();
        $sql = "select *, CONVERT(VARCHAR(16), print_date, 120)  AS print_date from V_WebApp_Barcodeprint where id = '" . $id . "';";
        $rs = $cSql->SqlQuery($this->conn, $sql);
        $this->item = $rs[1]["item"];
        $this->qty1 = $rs[1]["qty1"];
        $this->lot = $rs[1]["lot"];
        $this->uf_act_Weight = $rs[1]["uf_act_Weight"];
        $this->uf_pack = $rs[1]["uf_pack"];
        $this->print_date = $rs[1]["print_date"];
        $this->sts_no = $rs[1]["sts_no"];
        $this->sts_no2 = $rs[1]["sts_no2"];
        $this->sts_no3 = $rs[1]["sts_no3"];
        $this->qty_sts_no = $rs[1]["qty_sts_no"];
        $this->qty_sts_no2 = $rs[1]["qty_sts_no2"];
        $this->qty_sts_no3 = $rs[1]["qty_sts_no3"];
        $this->Uf_Grade = $rs[1]["Uf_Grade"];
        $this->Uf_tagdesc = $rs[1]["Uf_tagdesc"];
        $this->Uf_TypeEnd = $rs[1]["Uf_TypeEnd"];
        $this->Uf_NPS = $rs[1]["Uf_NPS"];
        $this->Uf_Schedule = $rs[1]["Uf_Schedule"];
        $this->Uf_length = $rs[1]["Uf_length"];
        $this->Uf_spec = $rs[1]["Uf_spec"];
        $this->Uf_class = $rs[1]["Uf_class"];
        $this->unit_weight = $rs[1]["unit_weight"];
        $this->Uf_TheoryWeightPerItem = $rs[1]["Uf_TheoryWeightPerItem"];

        $this->cust_num = isset($rs[1]["cust_num"]) ? $rs[1]["cust_num"] : '-';
        $this->cust_seq = isset($rs[1]["cust_seq"]) ? $rs[1]["cust_seq"] : '-';
        $this->cust_po = isset($rs[1]["cust_po"]) ? $rs[1]["cust_po"] : '-';
        $this->Uf_StsPO_refNo = isset($rs[1]["Uf_StsPO_refNo"]) ? $rs[1]["Uf_StsPO_refNo"] : '-';
        $this->cust_name = isset($rs[1]["name"]) ? $rs[1]["name"] : '-';
        $this->city = isset($rs[1]["city"]) ? trim($rs[1]["city"]) : '-';

        $this->ord_num = $rs[1]["ord_num"];
        $this->ord_type = $rs[1]["ord_type"];

        $this->Uf_refno = $rs[1]["Uf_refno"];
        $this->spec = $rs[1]["spec"];
        $this->Heat_no = $this->GetHeatNo($this->sts_no, $this->sts_no2, $this->sts_no3, $this->qty_sts_no, $this->qty_sts_no2, $this->qty_sts_no3);
    }

    function GetTagBarcodePreview($jobm0, $item) {
        $this->GetJobMst($jobm0);
        $this->GetItemMst($item);
        $this->GetCoMst($this->ord_num,$item);
    }

    function GetJobMst($jobm0) {
        $cSql = new SqlSrv();
        $sql1 = "select * from job_mst where job = '" . $jobm0 . "';";
        $rs1 = $cSql->SqlQuery($this->conn, $sql1);
        $this->ord_num = $rs1[1]["ord_num"];
        $this->ord_type = $rs1[1]["ord_type"];
        $sql3 = " select * from co_mst "
                . " LEFT JOIN custaddr_mst ON co_mst.cust_num = custaddr_mst.cust_num and co_mst.cust_seq = custaddr_mst.cust_seq "
                . " where co_num = '" . $rs1[1]["ord_num"] . "' ";
        $rs3 = $cSql->SqlQuery($this->conn, $sql3);
        ($this->ord_type == "O") ? $this->Uf_refno = $rs3[1]["Uf_StsPO_refNo"] : $this->Uf_refno = $rs1[1]["Uf_refno"];
    }

    function GetItemMst($item) {
        $cSql = new SqlSrv();
        $sql2 = "select * from item_mst where item = '" . $item . "'";
        $rs2 = $cSql->SqlQuery($this->conn, $sql2);
        $this->Uf_Grade = $rs2[1]["Uf_Grade"];
        $this->Uf_tagdesc = $rs2[1]["Uf_tagdesc"];
        $this->Uf_TypeEnd = $rs2[1]["Uf_TypeEnd"];
        $this->Uf_NPS = $rs2[1]["Uf_NPS"];
        $this->Uf_Schedule = $rs2[1]["Uf_Schedule"];
        $this->Uf_length = $rs2[1]["Uf_length"];
        $this->Uf_spec = $rs2[1]["Uf_spec"];
        $this->Uf_class = $rs2[1]["Uf_class"];
        $this->unit_weight = $rs2[1]["unit_weight"];
        $this->Uf_TheoryWeightPerItem = $rs2[1]["Uf_TheoryWeightPerItem"];
    }

    function GetCoMst($co_num,$item) {
        $cSql = new SqlSrv();
        $sql3 = " select * from co_mst "
                . " LEFT JOIN custaddr_mst ON co_mst.cust_num = custaddr_mst.cust_num and co_mst.cust_seq = custaddr_mst.cust_seq "
                . " where co_num = '" . $co_num . "' ";
        $rs3 = $cSql->SqlQuery($this->conn, $sql3);
        $this->cust_num = isset($rs3[1]["cust_num"]) ? $rs3[1]["cust_num"] : '-';
        $this->cust_seq = isset($rs3[1]["cust_seq"]) ? $rs3[1]["cust_seq"] : '-';
        $this->cust_po = isset($rs3[1]["cust_po"]) ? $rs3[1]["cust_po"] : '-';
        $this->Uf_StsPO_refNo = isset($rs3[1]["Uf_StsPO_refNo"]) ? $rs3[1]["Uf_StsPO_refNo"] : '-';
        $this->cust_name = isset($rs3[1]["name"]) ? $rs3[1]["name"] : '-';
        $this->city = isset($rs3[1]["city"]) ? trim($rs3[1]["city"]) : '-';
        $this->Heat_no = $this->GetHeatNo($this->sts_no, $this->sts_no2, $this->sts_no3, $this->qty_sts_no, $this->qty_sts_no2, $this->qty_sts_no3);
        $this->spec = $this->GetSpec($item);
    }

    Function GetHeatNo($sts_no, $sts_no2, $sts_no3, $qty_sts_no, $qty_sts_no2, $qty_sts_no3) {
        $Heat_no1 = "";
        $Heat_no2 = "";
        $Heat_no3 = "";
        if ($sts_no != "") {
            $Heat_no1_1 = "";
            if ($qty_sts_no2 > 0) {
                $Heat_no1_1 = "(" . $qty_sts_no . ")";
            }
            $Heat_no1 = $sts_no . $Heat_no1_1;
        }
        if ($sts_no2 != "") {
            $Heat_no2 = "," . $sts_no2 . "(" . $qty_sts_no2 . ")";
        }
        if ($sts_no3 != "") {
            $Heat_no3 = "," . $sts_no3 . "(" . $qty_sts_no3 . ")";
        }
        $Heat_no = $Heat_no1 . $Heat_no2 . $Heat_no3;
        return $Heat_no;
    }

    Function GetSpec($item) {
        isset($this->Uf_spec) ? $spec = $this->Uf_spec : $spec = $this->Uf_class;
//        if ($this->cust_num == 'EX00007') {
//            $cSql = new SqlSrv();
//            $sql2 = "select Uf_class from item_mst where item = '".$item."';";
//            $rs2 = $cSql->SqlQuery($this->conn, $sql2);
//            $spec = $rs2[1]["Uf_class"];
//        }
        return $spec;
    }

    Function GetLateBundle_ReJob($job) {
        $cSql = new SqlSrv();
        $sqlLateBundle = "select TOP 1 uf_pack from MV_Bc_Tag where job = '" . $job . "' order by uf_pack desc ;";
        $rsLateBundle = $cSql->SqlQuery($this->conn, $sqlLateBundle);
        $LateBundle = 1;
        if (isset($rsLateBundle[1]["uf_pack"])) {
            $LateBundle = $rsLateBundle[1]["uf_pack"] + 1;
        }
        return $LateBundle;
    }

    function GetGenBarcode_1() {
        $ip = $_SERVER['REMOTE_ADDR']; //Get user IP
        $ip_a = explode(".", $ip);
        if (!isset($ip_a[3])) {
            $ip_a[3] = "001";
        }
        $ipc = sprintf("%'.03d", $ip_a[3]);
        $idl = date("ymd") . $ipc;
        return $idl;
    }

    function GetGenBarcode_2() {
        $cSql = new SqlSrv();
        $sql = "select TOP 1 id from Mv_Bc_tag where id like '" . $this->GetGenBarcode_1() . "%' order by id desc;";
        $rs = $cSql->SqlQuery($this->conn, $sql);
        if (isset($rs[1]["id"])) {
            $id_last = substr($rs[1]["id"], -4);
            $id_next = intval('' . $id_last . '');
        } else {
            $id_next = 0;
        }
        return $id_next;
    }

    function GetGenLot($job, $id_next) {
        $lot = $job . "-" . sprintf("%'.04d", ($id_next));
        return $lot;
    }

    function check_sts_no($tag_ids) {
        $cSql = new SqlSrv();
        $sql = "select TOP 1 * from Mv_Bc_tag where id = '" . $tag_ids . "' order by id desc;";
        $rs = $cSql->SqlQuery($this->conn, $sql);
      
        if ($rs[1]["tag_status"] == "Reject") {
            $tag_ids = "2";
            return $tag_ids;
        } 

        if (isset($rs[1]["sts_no"])) {
            $tag_ids = "1";
        } else {
            $tag_ids = "0";
        }
        return $tag_ids;
    }

}

//class PrintTagBarCode extends ReplaceHtml{
//    
//}
