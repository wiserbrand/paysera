<?php
namespace Payment\Client;

/**
 * Undocumented class
 */
class ClientRepository {

    /**
     * Undocumented variable
     *
     * @var array
     */
    private static $clients = [];

    /**
     * Undocumented function
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
