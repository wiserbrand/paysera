<?php
namespace Payment\Money;

use Payment\Currency\CurrencyInterface;

/**
 * Undocumented interface
 */
interface MoneyInterface {

    /**
     * Undocumented function
     *
     * @return float
     */
    public function getAmount(): float;

    /**
     * Undocumented function
     *
     * @return CurrencyInterface
     */
    public function getCurrency(): CurrencyInterface;

    /**
     * Undocumented function
     *
     * @param MoneyInterface $money
     * @return MoneyInterface
     */
    public function add(MoneyInterface $money): MoneyInterface;

    /**
     * Undocumented function
     *
     * @param MoneyInterface $money
     * @return MoneyInterface
     */
    public function subtract(MoneyInterface $money): MoneyInterface;

    /**
     * Undocumented function
     *
     * @param float $multiplier
     * @return MoneyInterface
     */
    public function multiply(float $multiplier): MoneyInterface;

    /**
     * Undocumented function
     *
     * @return string
     */
    public function roundUp(): string;
}