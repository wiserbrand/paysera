<?php
namespace Payment\Operation\Exception;

class OperationNotProcessedException extends \Exception {
    public function __construct($id) {
        parent::__construct("Operation is not processed: $id");
    }

}
