<?php
namespace Payment\Entity\Currency\Exception;

/**
 * 
 */
class UnsupportedCurrencyException extends \Exception {

    /**
     *
     * @param [type] $currency
     */
    public function __construct($currency) {
        parent::__construct("Unsupported Currency: $currency");
    }

}
