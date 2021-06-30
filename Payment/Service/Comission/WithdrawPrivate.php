<?php
namespace Payment\Service\Comission;

use Payment\Helper\DateHelper;
use Payment\Repository\CurrencyRepository;
use Payment\Repository\OperationRepository;
use Payment\Entity\Money\Money;
use Payment\Entity\Money\MoneyInterface;
use Payment\Entity\Operation\OperationInterface;

/**
 * 
 */
class WithdrawPrivate implements ComissionInterface {

    /**
     * 
     */
    const FREE_QTY_OPERATION = 3;

    /**
     * 
     */
    const FREE_AMOUNT = 1000;

    /**
     * 
     */
    const COMISSION_RATE = 0.003;

    /**
     * 
     *
     * @param OperationInterface $operation
     * @return MoneyInterface
     */
    public function calculate(OperationInterface $operation): MoneyInterface {
        $baseCurrency = CurrencyRepository::getBaseCurrency();
        $exceedAmount = new Money(0, $baseCurrency);

        $operations = OperationRepository::getFromDate(
            $operation->getClient(), 
            DateHelper::getLastMonday($operation->getDate())
        );

        if (count($operations)>self::FREE_QTY_OPERATION) {
            $exceedAmount = clone $operation->getAmount();
        } else {
            $withdrawAmount = new Money(0, $baseCurrency);
            foreach ($operations as $op) {
                $withdrawAmount->add($op->getAmount());
            }

            $freeAmount = new Money(self::FREE_AMOUNT, $baseCurrency);
            if ($withdrawAmount->lessOrEquals($freeAmount)) {
                $exceedAmount = (clone $operation->getAmount())->subtract(
                    $freeAmount->subtract($withdrawAmount)
                );
            }
            else {
                $exceedAmount = clone $operation->getAmount();
            }
        }
        $zeroAmount = new Money(0, $exceedAmount->getCurrency());
        if ($exceedAmount->lessOrEquals($zeroAmount)) {
            $exceedAmount = $zeroAmount;
        }

        return $exceedAmount->multiply(self::COMISSION_RATE);
    }
}
