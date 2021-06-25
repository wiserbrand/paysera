<?php
namespace Payment\Operation;

use Payment\Client\ClientInterface;
use Payment\Currency\CurrencyInterface;
use Payment\Money\MoneyInterface;

abstract class AbstractOperation implements OperationInterface {
    protected $id;
    protected $type;
    protected $client;
    protected $date;
    protected $amount;
    protected $comission;
    protected $isProcessed = false;

    public static function create(
        int $id, 
        ClientInterface $client, 
        String $type,
        MoneyInterface $amount, 
        \DateTime $date
    ) {
        $classType = __NAMESPACE__ . "\\" . ucfirst($type);

        if (class_exists($classType . ucfirst($client->getType()))) {
            $classType .= ucfirst($client->getType());
        }

        if (!class_exists($classType)) {
            throw new Exception\UnknownOperationTypeException($type);
        }

        return new $classType($id, $client, $amount, $date);
    }

    protected function __construct(int $id, ClientInterface $client, MoneyInterface $amount, \DateTime $date) {
        $this->id = $id;
        $this->client = $client;
        $this->date = $date;
        $this->amount = $amount;
    }

    /**
     * Undocumented function
     *
     * @return integer
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * Undocumented function
     *
     * @param MoneyInterface $comission
     * @return void
     */
    public function setComission(MoneyInterface $comission): OperationInterface {
        if ($this->isProcessed()) {
            throw new Exception\OperationAlreadyProcessed($operation);
        }
        $this->comission = $comission;
        $this->setProcessed();

        return $this;
    }

    /**
     * Undocumented function
     *
     * @return MoneyInterface
     */
    public function getComission(): MoneyInterface {
        if (!$this->isProcessed()) {
            throw new Exception\OperationNotProcessedException($this->id);
        }
        return $this->comission;
    }

    /**
     * Undocumented function
     *
     * @return ClientInterface
     */
    public function getClient(): ClientInterface {
        return $this->client;
    }

    /**
     * Undocumented function
     *
     * @return \DateTime
     */
    public function getDate(): \DateTime {
        return $this->date;
    }

    /**
     * Undocumented function
     *
     * @return boolean
     */
    public function isProcessed(): bool {
        return $this->isProcessed == true;
    }

    /**
     * Undocumented function
     *
     * @return OperationInterface
     */
    protected function setProcessed(): OperationInterface {
        $this->isProcessed = true;

        return $this;
    }

    /**
     * Undocumented function
     *
     * @return MoneyInterface
     */
    public function getAmount(): MoneyInterface {
        return $this->amount;
    }

    /**
     * Undocumented function
     *
     * @return CurrencyInterface
     */
    public function getCurrency(): CurrencyInterface {
        return $this->currency;
    }
}