<?php
namespace Payment\Entity\Money;

use Payment\Entity\Currency\CurrencyInterface;

/**
 * 
 */
interface MoneyInterface {

    /**
     *
     * @return float
     */
    public function getAmount(): float;

    /**
     *
     * @return CurrencyInterface
     */
    public function getCurrency(): CurrencyInterface;

    /**
     *
     * @param MoneyInterface $money
     * @return MoneyInterface
     */
    public function add(MoneyInterface $money): MoneyInterface;

    /**
     *
     * @param MoneyInterface $money
     * @return MoneyInterface
     */
    public function subtract(MoneyInterface $money): MoneyInterface;

    /**
     *
     * @param float $multiplier
     * @return MoneyInterface
     */
    public function multiply(float $multiplier): MoneyInterface;

    /**
     *
     * @return string
     */
    public function roundUp(): string;
}