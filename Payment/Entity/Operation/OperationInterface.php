<?php
namespace Payment\Entity\Operation;

use Payment\Entity\Money\MoneyInterface;
use Payment\Entity\Client\ClientInterface;
use Payment\Entity\Currency\CurrencyInterface;

/**
 * 
 */
interface OperationInterface {

    /**
     *
     * @return integer
     */
    public function getId(): int;

    /**
     *
     * @return MoneyInterface
     */
    public function getComission(): MoneyInterface;

    /**
     *
     * @param MoneyInterface $acomission
     * @return OperationInterface
     */
    public function setComission(MoneyInterface $acomission): OperationInterface;

    /**
     *
     * @return ClientInterface
     */
    public function getClient(): ClientInterface; 

    /**
     *
     * @return \DateTime
     */
    public function getDate(): \DateTime;

    /**
     *
     * @return boolean
     */
    public function isProcessed(): bool;

    /**
     *
     * @return MoneyInterface
     */
    public function getAmount(): MoneyInterface;

    /**
     *
     * @return CurrencyInterface
     */
    public function getCurrency(): CurrencyInterface;
}