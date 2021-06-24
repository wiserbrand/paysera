<?php
namespace Payment\Operation;

use Payment\Helper\MoneyHelper;

class WithdrawBusiness extends AbstractOperation {
    const COMISSION_RATE = 0.005;

    public function calculateComission() {
        $comission = $this
            ->getAmount()
            ->multiply(self::COMISSION_RATE);
        $this->setComission($comission);
    }
}