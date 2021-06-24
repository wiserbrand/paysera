<?php
namespace Payment\Currency;

interface CurrencyInterface {
    public function getName(): string ;

    public function getRate(): float ;

    public function getScale() ;

    public function getCeil() ;
}