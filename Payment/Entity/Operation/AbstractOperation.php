<?php
namespace Payment\Entity\Operation;

use Payment\Entity\Client\ClientInterface;
use Payment\Entity\Currency\CurrencyInterface;
use Payment\Entity\Money\MoneyInterface;

/**
 * 
 */
abstract class AbstractOperation implements OperationInterface {

    /**
     *
     * @var [type]
     */
    protected $id;

    /**
     *
     * @var [type]
     */
    protected $type;

    /**
     *
     * @var [type]
     */
    protected $client;

    /**
     *
     * @var [type]
     */
    protected $date;

    /**
     *
     * @var [type]
     */
    protected $amount;

    /**
     *
     * @var [type]
     */
    protected $comission;

    /**
     *
     * @var boolean
     */
    protected $isProcessed = false;

    /**
     *
     * @param integer $id
     * @param ClientInterface $client
     * @param String $type
     * @param MoneyInterface $amount
     * @param \DateTime $date
     * @return void
     */
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

    /**
     *
     * @param integer $id
     * @param ClientInterface $client
     * @param MoneyInterface $amount
     * @param \DateTime $date
     */
    protected function __construct(int $id, ClientInterface $client, MoneyInterface $amount, \DateTime $date) {
        $this->id = $id;
        $this->client = $client;
        $this->date = $date;
        $this->amount = $amount;
    }

    /**
     *
     * @return integer
     */
    public function getId(): int {
        return $this->id;
    }

    /**
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
     *
     * @return ClientInterface
     */
    public function getClient(): ClientInterface {
        return $this->client;
    }

    /**
     *
     * @return \DateTime
     */
    public function getDate(): \DateTime {
        return $this->date;
    }

    /**
     *
     * @return boolean
     */
    public function isProcessed(): bool {
        return $this->isProcessed == true;
    }

    /**
     *
     * @return OperationInterface
     */
    protected function setProcessed(): OperationInterface {
        $this->isProcessed = true;

        return $this;
    }

    /**
     *
     * @return MoneyInterface
     */
    public function getAmount(): MoneyInterface {
        return $this->amount;
    }

    /**
     *
     * @return CurrencyInterface
     */
    public function getCurrency(): CurrencyInterface {
        return $this->currency;
    }
}