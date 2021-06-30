<?php
namespace Payment\Repository;

use Payment\Entity\Client\ClientInterface;
use Payment\Entity\Currency\CurrencyInterface;
use Payment\Entity\Money\MoneyInterface;
use Payment\Entity\Operation\OperationInterface;

/**
 * 
 */
class OperationRepository {

    /**
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
     *
     * @param [type] $client
     * @param [type] $startDate
     * @return void
     */
    public static function getFromDate($client, $startDate) {
        $result = [];
        foreach (self::$operations as $op) {
            if ($op->getClient()->equals($client)) {
                if ($op->getDate()>=$startDate && $op->isProcessed()) {
                    $result[] = $op;
                }
            }
        }
        return $result;
    }
}
