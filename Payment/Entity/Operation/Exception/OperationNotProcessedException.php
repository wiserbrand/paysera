<?php
namespace Payment\Operation\Exception;

/**
 * 
 */
class OperationNotProcessedException extends \Exception {
    
    /**
     *
     * @param [type] $id
     */
    public function __construct($id) {
        parent::__construct("Operation is not processed: $id");
    }

}
