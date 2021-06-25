<?php
namespace Payment;

use Payment\Operation\OperationInterface;

class Processor {
    public static function process(OperationInterface &$operation) {
        $comission = $operation->calculateComission();
        $operation->setComission($comission);
    }
}