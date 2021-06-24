<?php
namespace Payment\Currency;

class CurrencyService {
    public function getRate(string $name): float {
        $rate['EUR'] = 1;
        $rate['USD'] = 1.1497;
        $rate['JPY'] = 129.53;
        return $rate[$name];
    }
}