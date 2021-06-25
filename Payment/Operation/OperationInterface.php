<?php
namespace Payment\Operation;

use Payment\Money\MoneyInterface;
use Payment\Client\ClientInterface;
use Payment\Currency\CurrencyInterface;

/**
 * Undocumented interface
 */
interface OperationInterface {

    /**
     * Undocumented function
     *
     * @return integer
     */
    public function getId(): int;

    /**
     * Undocumented function
     *
     * @return MoneyInterface
     */
    public function getComission(): MoneyInterface;

    /**
     * Undocumented function
     *
     * @return MoneyInterface
     */
    public function calculateComission(): MoneyInterface;

    /**
     * 
     */
    public function setComission(MoneyInterface $acomission): OperationInterface;

    /**
     * Undocumented function
     *
     * @return ClientInterface
     */
    public function getClient(): ClientInterface; 

    /**
     * Undocumented function
     *
     * @return \DateTime
     */
    public function getDate(): \DateTime;

    /**
     * Undocumented function
     *
     * @return boolean
     */
    public function isProcessed(): bool;

    /**
     * Undocumented function
     *
     * @return MoneyInterface
     */
    public function getAmount(): MoneyInterface;

    /**
     * Undocumented function
     *
     * @return CurrencyInterface
     */
    public function getCurrency(): CurrencyInterface;
}