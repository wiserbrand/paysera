<?php
namespace Payment\Entity\Currency;

/**
 * 
 */
class Currency implements CurrencyInterface {

    /**
     * 
     */
    private string $name;

    /**
     * 
     */
    private float $rate;

    /**
     * 
     */
    private int $scale;

    /**
     * 
     */
    private bool $ceil;

    /**
     *
     * @param string $name
     * @param float $rate
     * @param integer $scale
     * @param boolean $ceil
     * @return Currency
     */
    public static function create(string $name, float $rate, int $scale =2, bool $ceil =false): CurrencyInterface {
        return new Currency($name, $rate, $scale =2, $ceil);
    }

    /**
     *
     * @param string $name
     * @param float $rate
     * @param integer $scale
     * @param boolean $ceil
     */
    public function __construct(string $name, float $rate, int $scale =2, bool $ceil =false) {
        $this->name = $name;
        $this->rate = $rate;
        $this->scale = $scale;
        $this->ceil = $ceil;
    }

    /**
     *
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     *
     * @return float
     */
    public function getRate(): float {
        return $this->rate;
    }

    /**
     *
     * @return integer
     */
    public function getScale(): int {
        return $this->scale;
    }

    /**
     *
     * @return void
     */
    public function getCeil():bool {
        return $this->ceil;
    }
}

