<?php
namespace Payment\Client;

class BusinessClient extends AbstractClient {

    public function getType(): string {
        return 'business';
    }

}