<?php

namespace ByTIC\Money\Utility;

use ByTIC\Money\Formatter\HtmlFormatter;

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
        $money = Money::create($value, $currency);
        return money_formatter()->get('html')->format($money);
    }
}