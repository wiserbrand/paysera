<?php
namespace Payment\Operation;

use Payment\Money\MoneyInterface;

interface OperationInterface {
    public function getId(): int;
    public function setComission(MoneyInterface $comission);
    public function getComission(): MoneyInterface;
    public function calculateComission();

}