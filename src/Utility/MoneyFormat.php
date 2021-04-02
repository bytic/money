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
        $currency = \ByTIC\Money\Money::currency($currency);
        $money = \ByTIC\Money\Money::parse($value, $currency);
        return $money->formatBy('html');
    }
}
