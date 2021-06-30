<?php
namespace Payment\Service\Comission;

use Payment\Entity\Operation\OperationInterface;

/**
 * 
 */
class AbstractComission {

    /**
     *
     * @param OperationInterface $operation
     * @return void
     */
    public static function build(OperationInterface  $operation) {
        $class = explode('\\', get_class($operation));
        $classType = __NAMESPACE__ . "\\" . end($class);

        if (!class_exists($classType)) {
            throw new Exception\UnknownOperationStrategyException($operation);
        }

        return new $classType($operation);
    }
}