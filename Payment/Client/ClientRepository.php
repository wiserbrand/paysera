<?php
namespace Payment\Client;

class ClientRepository {
    private static $clients = [];

    public static function get(int $id, string $type): ClientInterface {
        if (!array_key_exists($id, self::$clients)) {
            self::$clients[$id] = ClientFactory::create($id, $type);
        }

        return self::$clients[$id];
    } 
}
