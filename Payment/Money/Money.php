<?php
namespace Payment\Money;

use Payment\Currency\CurrencyInterface;

/**
 * Undocumented class
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
     * Undocumented function
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
     * Undocumented function
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
     * Undocumented function
     *
     * @return float
     */
    public function getAmount(): float {
        return $this->amount; 
    }

    /**
     * Undocumented function
     *
     * @return CurrencyInterface
     */
    public function getCurrency(): CurrencyInterface {
        return $this->currency;
    }

    /**
     * Undocumented function
     *
     * @param MoneyInterface $money
     * @return MoneyInterface
     */
    public function add(MoneyInterface $money): MoneyInterface {
        $this->amount += Money::create($money, $this->getCurrency())->getAmount();
        return $this;
    }

    /**
     * Subtract Money
     *
     * @param MoneyInterface $money
     * @return MoneyInterface
     */
    public function subtract(MoneyInterface $money): MoneyInterface {
        $this->amount -= Money::create($money, $this->getCurrency())->getAmount();
        return $this;
    }

    /**
     * Undocumented function
     *
     * @param float $multiplier
     * @return MoneyInterface
     */
    public function multiply(float $multiplier): MoneyInterface {
        $this->amount *= $multiplier;
        return $this;
    }

    /**
     * Undocumented function
     *
     * @return string
     */
    public function roundUp(): string {
        if ($this->getCurrency()->getCeil()) {
            return sprintf("%d", ceil($this->getAmount()));
        }
        $decimals = $this->getCurrency()->getScale();
        $scale = pow(10, $decimals);
        $value = $scale>0 
            ? ceil($this->getAmount()*$scale)/$scale
            : ceil($this->getAmount());
        return sprintf("%.${decimals}f", $value);
    }

    /**
     * Undocumented function
     *
     * @param MoneyInterface $money
     * @return boolean
     */
    public function lessOrEquals(MoneyInterface $money): bool {
        $localMoney = Money::create($money, $this->getCurrency());
        return $this->getAmount() <= $localMoney->getAmount();
    }
}