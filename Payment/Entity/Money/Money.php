<?php
namespace Payment\Entity\Money;

use Payment\Entity\Currency\CurrencyInterface;
use Payment\Helper\MoneyHelper;

/**
 * 
 */
class Money implements MoneyInterface {
    /**
     * 
     */
    private float $amount;

    /**
     * 
     */
    private CurrencyInterface $currency;

    /**
     *
     * @param float $amount
     * @param CurrencyInterface $currency
     */
    public function __construct(
        float $amount, 
        CurrencyInterface $currency
    ) {
        $this->amount = $amount;
        $this->currency = $currency;
    }

    /**
     *
     * @param MoneyInterface $money
     * @param CurrencyInterface $currency
     * @return MoneyInterface
     */
    public static function create(
        MoneyInterface $money, 
        CurrencyInterface $currency
    ): MoneyInterface {
        $inRate = $money->getCurrency()->getRate();
        $outRate = $currency->getRate();
        $newAmount = $money->getAmount() * ($outRate/$inRate);
        return new Money($newAmount, $currency);
    } 

    /**
     *
     * @return float
     */
    public function getAmount(): float {
        return $this->amount; 
    }

    /**
     *
     * @return CurrencyInterface
     */
    public function getCurrency(): CurrencyInterface {
        return $this->currency;
    }

    /**
     *
     * @param MoneyInterface $money
     * @return MoneyInterface
     */
    public function add(MoneyInterface $money): MoneyInterface {
        $this->amount += Money::create($money, $this->getCurrency())->getAmount();
        return $this;
    }

    /**
     *
     * @param MoneyInterface $money
     * @return MoneyInterface
     */
    public function subtract(MoneyInterface $money): MoneyInterface {
        $this->amount -= Money::create($money, $this->getCurrency())->getAmount();
        return $this;
    }

    /**
     *
     * @param float $multiplier
     * @return MoneyInterface
     */
    public function multiply(float $multiplier): MoneyInterface {
        $this->amount *= $multiplier;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function roundUp(): string {
        $currency = $this->getCurrency();
        return MoneyHelper::roundUp(
            $this->getAmount(), 
            $currency->getScale(),
            $currency->getCeil()
        );
    }

    /**
     *
     * @param MoneyInterface $money
     * @return boolean
     */
    public function lessOrEquals(MoneyInterface $money): bool {
        $localMoney = Money::create($money, $this->getCurrency());
        return $this->getAmount() <= $localMoney->getAmount();
    }
}