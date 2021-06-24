<?php
namespace Payment\Money;

use Payment\Currency\CurrencyInterface;

interface MoneyInterface {
    public function getAmount(): float;
    public function getCurrency(): CurrencyInterface;
    public function add(MoneyInterface $money): MoneyInterface;
    public function subtract(MoneyInterface $money): MoneyInterface;
    public function multiply(float $multiplier): MoneyInterface;
    public function roundUp(): string;
}