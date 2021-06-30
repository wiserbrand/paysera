<?php
namespace Payment\Repository;

use Payment\Entity\Currency\CurrencyInterface;
use Payment\Entity\Currency\Currency;

/**
 * 
 */
class CurrencyRepository {

    private static $currencies = [];

    /**
     *
     * @param string $name
     * @return Currency
     */
    public static function get(string $name): Currency {
        if (!array_key_exists($name, self::$currencies)) {
            throw new \Payment\Entity\Currency\Exception\UnsupportedCurrencyException($name);
        }

        return self::$currencies[$name];
    }

    /**
     *
     * @param CurrencyInterface $currency
     * @return void
     */
    public static function add(CurrencyInterface $currency) {
        self::$currencies[$currency->getName()] = $currency;
    }

    /**
     *
     * @return CurrencyInterface
     */
    public static function getBaseCurrency(): CurrencyInterface {
        return self::get('EUR');
    }
}


