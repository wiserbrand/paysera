<?php
namespace Payment\Service;

use Payment\Entity\Operation\OperationInterface;
use Payment\Entity\Client\ClientInterface;
use Payment\Entity\Money\MoneyInterface;
use Payment\Entity\Operation\AbstractOperation;
use Payment\Repository\OperationRepository;
use Payment\Service\Comission\AbstractComission;

class OperationService {

    /**
     * 
     */
    private static int $sequence = 1;

    /**
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
        OperationRepository::add($operation);

        return $operation;
    }

    /**
     *
     * @param OperationInterface $operation
     * @return void
     */
    public static function process(OperationInterface &$operation) {
        $comissionService = AbstractComission::build($operation);
        $comission = $comissionService->calculate($operation);
        $operation->setComission($comission);
    }
}