<?php
namespace Payment\Client;

interface ClientInterface {
    public function getId(): int;
    public function equals(ClientInterface $client): bool;
}