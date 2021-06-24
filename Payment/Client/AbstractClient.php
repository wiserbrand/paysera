<?php
namespace Payment\Client;

use Payment\Operation\OperationInterface;

abstract class AbstractClient implements ClientInterface {

    protected int $id;
    protected $operations = [];

    function __construct(int $id) {
        $this->id = $id;
    }

    public function getId(): int {
        return $this->id;
    }

    public static function get(int $userId, String $userType) {
        $classType = __NAMESPACE__ . "\\" . ucfirst($userType) . "Client";

        if (!class_exists($classType)) {
            throw new Exception\UnknownClientTypeException($userType);
        }

        return new $classType($userId);
    }

    public function addOperation(OperationInterface $operation) {
        $this->operations[] = $operation->getId();
    }

    public function equals(ClientInterface $client): bool {
        return $this->getId()==$client->getId();
    }
}