<?php
namespace Payment\Operation;

use Payment\Helper\MoneyHelper;
use Payment\Helper\DateHelper;
use Payment\Currency\CurrencyRepository;
use Payment\Money\Money;
use Payment\Money\MoneyInterface;

class WithdrawPrivate extends AbstractOperation {
    const FREE_QTY_OPERATION = 3;
    const FREE_AMOUNT = 1000;
    const COMISSION_RATE = 0.003;

    public function calculateComission(): MoneyInterface {
        $baseCurrency = CurrencyRepository::getBaseCurrency();
        $exceedAmount = new Money(0, $baseCurrency);

        $operations = OperationRepository::getFromDate(
            $this->getClient(), 
            DateHelper::getLastMonday($this->getDate())
        );

        if (count($operations)>self::FREE_QTY_OPERATION) {
            $exceedAmount = clone $this->getAmount();
        } else {
            $withdrawAmount = new Money(0, $baseCurrency);
            foreach ($operations as $op) {
                $withdrawAmount->add($op->getAmount());
            }

            $freeAmount = new Money(self::FREE_AMOUNT, $baseCurrency);
            if ($withdrawAmount->lessOrEquals($freeAmount)) {
                $exceedAmount = (clone $this->getAmount())->subtract(
                    $freeAmount->subtract($withdrawAmount)
                );
            }
            else {
                $exceedAmount = clone $this->getAmount();
            }
        }
        $zeroAmount = new Money(0, $exceedAmount->getCurrency());
        if ($exceedAmount->lessOrEquals($zeroAmount)) {
            $exceedAmount = $zeroAmount;
        }

        return $exceedAmount->multiply(self::COMISSION_RATE);
    }
}
