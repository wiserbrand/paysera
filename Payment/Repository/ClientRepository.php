<?php
namespace Payment\Repository;

use Payment\Entity\Client\ClientInterface;
use Payment\Entity\Client\AbstractClient;

/**
 * 
 */
class ClientRepository {

    /**
     *
     * @var array
     */
    private static $clients = [];

    /**
     *
     * @param integer $id
     * @param string $type
     * @return ClientInterface
     */
    public static function get(int $id, string $type): ClientInterface {
        if (!array_key_exists($id, self::$clients)) {
            self::$clients[$id] = AbstractClient::create($id, $type);
        }

        return self::$clients[$id];
    } 
}
