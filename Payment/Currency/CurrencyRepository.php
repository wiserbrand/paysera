<?php
namespace Payment\Currency;

class CurrencyRepository {
    public static function get(string $name): Currency {
        $currencies = [
            'EUR' => new Currency('EUR', 1),
            'USD' => new Currency('USD', 1.1497),
            'JPY' => new Currency('JPY', 129.53, 0, true)
        ];
        
        if (!array_key_exists($name, $currencies)) {
            throw new Exception\UnsupportedCurrencyException($name);
        }

        return $currencies[$name];
    }

    public static function getBaseCurrency(): CurrencyInterface {
        return self::get('EUR');
    }
}


