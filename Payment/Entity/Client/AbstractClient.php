<?php
namespace Payment\Entity\Client;

use Payment\Entity\Operation\OperationInterface;

/**
 * Undocumented class
 */
abstract class AbstractClient implements ClientInterface {

    /**
     * 
     */
    protected int $id;

    /**
     * Undocumented function
     *
     * @param integer $id
     * @param String $type
     * @return void
     */
    public static function create(int $id, String $type) {
        $classType = __NAMESPACE__ . "\\" . ucfirst($type) . "Client";

        if (!class_exists($classType)) {
            throw new Exception\UnknownClientTypeException($type);
        }

        return new $classType($id);
    }

    /**
     * Undocumented function
     *
     * @param integer $id
     */
    private function __construct(int $id) {
        $this->id = $id;
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
     * @param ClientInterface $client
     * @return boolean
     */
    public function equals(ClientInterface $client): bool {
        return $this->getId()==$client->getId();
    }
}