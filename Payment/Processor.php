<?php
namespace Payment;

use Payment\Operation\OperationInterface;

class Processor {
    public static function process(OperationInterface &$operation) {
        $operation->calculateComission();
    }
}