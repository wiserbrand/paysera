<?php
namespace Payment\Service\Comission;

use Payment\Entity\Money\MoneyInterface;
use Payment\Entity\Operation\OperationInterface;

/**
 * 
 */
class WithdrawBusiness implements ComissionInterface {

    /**
     * 
     */
    const COMISSION_RATE = 0.005;

    /**
     *
     * @param OperationInterface $operation
     * @return MoneyInterface
     */
    public function calculate(OperationInterface $operation): MoneyInterface {
        $comission = $operation
            ->getAmount()
            ->multiply(self::COMISSION_RATE);

        return $comission;
    }
}