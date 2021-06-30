<?php
namespace Payment\Entity\Client;

class PrivateClient extends AbstractClient {

    /**
     * Undocumented function
     *
     * @return string
     */
    public function getType(): string {
        return 'private';
    }

}
