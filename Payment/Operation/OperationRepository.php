<?php
namespace Payment\Operation;

use Payment\Client\ClientInterface;
use Payment\Currency\CurrencyInterface;
use Payment\Money\MoneyInterface;

class OperationRepository {
    private static $operations = [];
    private static $sequence = 1;

    public static function create( 
        ClientInterface $client, 
        string $type,
        MoneyInterface $amount,
        \DateTime $date
    ): OperationInterface {
        $classType = AbstractOperation::create($client, $type);
        $operation = new $classType(self::$sequence++, $client, $amount, $date);
        self::$operations[$operation->getId()] = $operation;

        return $operation;
    }

    public static function get(int $id): OperationInterface {
        return self::$operation[$id];
    }

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
