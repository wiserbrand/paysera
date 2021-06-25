<?php
namespace Payment\Currency;

/**
 * Undocumented interface
 */
interface CurrencyInterface {

    /**
     * Undocumented function
     *
     * @return string
     */
    public function getName(): string ;

    /**
     * Undocumented function
     *
     * @return float
     */
    public function getRate(): float ;

    /**
     * Undocumented function
     *
     * @return void
     */
    public function getScale() ;

    /**
     * Undocumented function
     *
     * @return void
     */
    public function getCeil() ;
}