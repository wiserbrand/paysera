<?php
namespace Payment\Operation;

use Payment\Helper\MoneyHelper;
use Payment\Money\MoneyInterface;

/**
 * Undocumented class
 */
class Deposit extends AbstractOperation {

    /**
     * Undocumented variable
     *
     * @var string
     */
    protected $type = 'deposit';

    /**
     * 
     */
    const COMISSION_RATE = 0.0003;

    /**
     * Undocumented function
     *
     * @return void
     */
    public function calculateComission(): MoneyInterface {
        $comission = $this
            ->getAmount()
            ->multiply(self::COMISSION_RATE);

        return $comission;
    }
}