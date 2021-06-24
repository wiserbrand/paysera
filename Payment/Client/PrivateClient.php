<?php
namespace Payment\Client;

class PrivateClient extends AbstractClient {

    public function getType(): string {
        return 'private';
    }

}
