<?php
namespace Payment\Helper;

/**
 * 
 */
class MoneyHelper {

    /**
     *
     * @param [type] $amount
     * @param integer $decimals
     * @param boolean $ceil
     * @return float
     */
    public static function roundUp($amount, $decimals =2, $ceil =false): string {
        if ($ceil) {
            return sprintf("%d", ceil($amount));
        }

        $scale = pow(10, $decimals);
        $value = $scale>0 
            ? ceil($amount*$scale)/$scale
            : ceil($amount);
        return sprintf("%.${decimals}f", $value);
    }
}

