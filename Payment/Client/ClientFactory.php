<?php
namespace Payment\Client;

abstract class ClientFactory {
    
    public static function create(int $id, String $type) {
        $classType = __NAMESPACE__ . "\\" . ucfirst($type) . "Client";

        if (!class_exists($classType)) {
            throw new Exception\UnknownClientTypeException($type);
        }

        return new $classType($id);
    }
}