<?php

namespace ByTIC\Money\Utility;

/**
 * Class MoneyFormat
 * @package ByTIC\Money\Utility
 */
class MoneyFormat
{
    /**
     * @param $value
     * @param $currency
     */
    public static function html($value, $currency = null)
    {
        $money = $value instanceof \Money\Money ? $value : Money::create($value, $currency);
        return money_formatter()->get('html')->format($money);
    }
}