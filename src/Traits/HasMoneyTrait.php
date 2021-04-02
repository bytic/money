<?php

namespace ByTIC\Money\Traits;

/**
 * Trait HasMoneyTrait
 * @package ByTIC\Money\Traits
 *
 * @method string getAmount
 */
trait HasMoneyTrait
{

    /**
     * @var \Money\Money
     */
    protected $money;

    /**
     * Get money.
     *
     * @return \Money\Money
     */
    public function getMoney(): \Money\Money
    {
        return $this->money;
    }
}