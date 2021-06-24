<?php
namespace Payment\Operation\Exception;

class UnknownOperationTypeException extends \Exception {
    public function __construct($type) {
        parent::__construct("Unknown operation type: $type");
    }

}
