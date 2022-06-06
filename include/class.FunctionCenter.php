<?php

class FunctionCenter {

    Function GetHeatNo($sts_no, $sts_no2, $sts_no3, $qty_sts_no, $qty_sts_no2, $qty_sts_no3) {
        $Heat_no1 = "";
        $Heat_no2 = "";
        $Heat_no3 = "";
        if ($sts_no != "") {
            $Heat_no1_1 = "";
            if ($qty_sts_no2 > 0 ) {
                $Heat_no1_1 = "(" . number_format($qty_sts_no) . ")";
            }
            $Heat_no1 = $sts_no . $Heat_no1_1;
        }
        if ($sts_no2 != "") {
            $Heat_no2 = "," . $sts_no2 . "(" . number_format($qty_sts_no2) . ")";
        }
        if ($sts_no3 != "") {
            $Heat_no3 = "," . $sts_no3 . "(" . number_format($qty_sts_no3) . "),";
        }
        $Heat_no = $Heat_no1 . $Heat_no2 . $Heat_no3;
        return $Heat_no;
    }
}
?>