<?php
namespace Payment\Operation;

use Payment\Money\MoneyInterface;

/**
 * Undocumented class
 */
class WithdrawBusiness extends AbstractOperation {

    /**
     * 
     */
    const COMISSION_RATE = 0.005;

    /**
     * Undocumented function
     *
     * @return void
     */
    public function calculateComission(): MoneyInterface {
        $comission = $this
            ->getAmount()
            ->multiply(self::COMISSION_RATE);

        return $comission;
    }
}