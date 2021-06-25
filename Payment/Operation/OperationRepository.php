<?php
namespace Payment\Operation;

use Payment\Client\ClientInterface;
use Payment\Currency\CurrencyInterface;
use Payment\Money\MoneyInterface;

/**
 * Undocumented class
 */
class OperationRepository {

    /**
     * Undocumented variable
     *
     * @var array
     */
    private static $operations = [];

    /**
     * Undocumented variable
     *
     * @var integer
     */
    private static $sequence = 1;

    /**
     * Undocumented function
     *
     * @param ClientInterface $client
     * @param string $type
     * @param MoneyInterface $amount
     * @param \DateTime $date
     * @return OperationInterface
     */
    public static function create( 
        ClientInterface $client, 
        string $type,
        MoneyInterface $amount,
        \DateTime $date
    ): OperationInterface {

        $operation = AbstractOperation::create(self::$sequence++, $client, $type, $amount, $date);
        self::$operations[$operation->getId()] = $operation;

        return $operation;
    }

    /**
     * Undocumented function
     *
     * @param integer $id
     * @return OperationInterface
     */
    public static function get(int $id): OperationInterface {
        return self::$operation[$id];
    }

    /**
     * Undocumented function
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
