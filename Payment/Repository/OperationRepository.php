<?php
namespace Payment\Repository;

use Payment\Entity\Client\ClientInterface;
use Payment\Entity\Currency\CurrencyInterface;
use Payment\Entity\Money\MoneyInterface;
use Payment\Entity\Operation\OperationInterface;
use Payment\Helper\DateHelper;

/**
 * 
 */
class OperationRepository {

    /**
     * In-memory storage
     *
     * @var array
     */
    private static $operations = [];

    /**
     *
     * @param OperationInterface $operation
     * @return void
     */
    public static function add(OperationInterface $operation) {
        self::$operations[$operation->getId()] = $operation;
    }

    /**
     *
     * @param integer $id
     * @return OperationInterface
     */
    public static function get(int $id): OperationInterface {
        return self::$operation[$id];
    }

    /**
     * Get list of operations for last week
     * 
     * @param [type] $client
     * @param [type] $class Base class to identify Operation
     * @param [type] $date
     * @return void
     */
    public static function getOperationsForWeek($client, $class, $date) {
        $result = [];

        $startDate = DateHelper::getLastMonday($date);
        foreach (self::$operations as $op) {
            if ($op->getClient()->equals($client)) {
                if (is_a($op, $class) && $op->isProcessed() && $op->getDate()>=$startDate && $op->getDate()<=$date) {
                    $result[] = $op;
                }
            }
        }
        return $result;
    }
}
