<?php
namespace Payment\Entity\Currency;

/**
 * 
 */
interface CurrencyInterface {

    /**
     *
     * @param string $name
     * @param float $rate
     * @param integer $scale
     * @param boolean $ceil
     * @return CurrencyInteface
     */
    public static function create(string $name, float $rate, int $scale =2, bool $ceil =false): CurrencyInterface;

    /**
     *
     * @return string
     */
    public function getName(): string ;

    /**
     *
     * @return float
     */
    public function getRate(): float ;

    /**
     *
     * @return void
     */
    public function getScale():int ;

    /**
     *
     * @return void
     */
    public function getCeil(): bool;
}