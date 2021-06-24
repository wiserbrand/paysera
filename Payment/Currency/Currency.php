<?php
namespace Payment\Currency;

/**
 * Undocumented class
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
     * Undocumented function
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
     * Undocumented function
     *
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * Undocumented function
     *
     * @return float
     */
    public function getRate(): float {
        return $this->rate;
    }

    /**
     * Undocumented function
     *
     * @return integer
     */
    public function getScale(): int {
        return $this->scale;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function getCeil() {
        return $this->ceil;
    }
}

