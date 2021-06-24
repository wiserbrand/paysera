<?php
namespace Payment\Operation;

use Payment\Helper\MoneyHelper;

class Deposit extends AbstractOperation {
    const COMISSION_RATE = 0.0003;

    public function calculateComission() {
        $comission = $this
            ->getAmount()
            ->multiply(self::COMISSION_RATE);
        $this->setComission($comission);
    }

}