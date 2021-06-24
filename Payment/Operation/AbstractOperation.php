<?php
namespace Payment\Operation;

use Payment\Client\ClientInterface;
use Payment\Currency\CurrencyInterface;
use Payment\Money\MoneyInterface;

abstract class AbstractOperation implements OperationInterface {
    protected $id;
    protected $comission;
    protected $client;
    protected $date;
    protected $amount;
    protected $isProcessed = false;

    public function __construct(int $id, $client, $amount, $date) {
        $this->id = $id;
        $this->client = $client;
        $this->date = $date;
        $this->amount = $amount;
    }

    public static function create(ClientInterface $client, String $type) {
        $classType = __NAMESPACE__ . "\\" . ucfirst($type);

        if (class_exists($classType . ucfirst($client->getType()))) {
            $classType .= ucfirst($client->getType());
        }

        if (!class_exists($classType)) {
            throw new Exception\UnknownOperationTypeException($type);
        }

        return $classType;
    }

    public function getId(): int {
        return $this->id;
    }

    public function setComission(MoneyInterface $comission) {
        if ($this->isProcessed == false) {
            $this->comission = $comission;
            $this->isProcessed = true;
        }
    }

    public function getComission(): MoneyInterface {
        if (!$this->isProcessed()) {
            throw new Exception\OperationNotProcessedException($this->id);
        }
        return $this->comission;
    }

    public function getClient(): ClientInterface {
        return $this->client;
    }

    public function getDate(): \DateTime {
        return $this->date;
    }

    public function isProcessed(): bool {
        return $this->isProcessed == true;
    }

    public function getAmount(): MoneyInterface {
        return $this->amount;
    }

    public function getCurrency(): CurrencyInterface {
        return $this->currency;
    }
}