<?php
namespace Payment\Currency\Exception;

/**
 * Undocumented class
 */
class UnsupportedCurrencyException extends \Exception {

    /**
     * Undocumented function
     *
     * @param [type] $currency
     */
    public function __construct($currency) {
        parent::__construct("Unsupported Currency: $currency");
    }

}
