<?php
declare(strict_types=1);

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