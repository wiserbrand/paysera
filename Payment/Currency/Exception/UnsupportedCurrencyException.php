<?php
namespace Payment\Currency\Exception;

class UnsupportedCurrencyException extends \Exception {
    public function __construct($currency) {
        parent::__construct("Unsupported Currency: $currency");
    }

}
