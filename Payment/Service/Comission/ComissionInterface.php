<?php
namespace Payment\Service\Comission;

use Payment\Entity\Money\MoneyInterface;
use Payment\Entity\Operation\OperationInterface;

/**
 * 
 */
interface ComissionInterface {
    
    /**
     *
     * @return MoneyInterface
     */
    public function calculate(OperationInterface $operation): MoneyInterface;

}