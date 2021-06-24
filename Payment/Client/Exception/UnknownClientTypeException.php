<?php
namespace Payment\Client\Exception;

class UnknownClientTypeException extends \Exception {
    public function __construct($userType) {
        parent::__construct("Unknown type of client: $userType");
    }

}