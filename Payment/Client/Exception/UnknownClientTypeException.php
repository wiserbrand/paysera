<?php
namespace Payment\Client\Exception;

/**
 * Undocumented class
 */
class UnknownClientTypeException extends \Exception {

    /**
     * Undocumented function
     *
     * @param [type] $type
     */
    public function __construct($type) {
        parent::__construct("Unknown type of client: $type");
    }

}