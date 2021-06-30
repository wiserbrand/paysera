<?php
namespace Payment\Entity\Client;

/**
 * Undocumented interface
 */
interface ClientInterface {

    /**
     * Undocumented function
     *
     * @return string
     */
    public function getType(): string; 

    /**
     * Undocumented function
     *
     * @return integer
     */
    public function getId(): int;

    /**
     * Undocumented function
     *
     * @param ClientInterface $client
     * @return boolean
     */
    public function equals(ClientInterface $client): bool;
}