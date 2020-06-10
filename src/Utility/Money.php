<?php

namespace ByTIC\Money\Utility;

use Money\Currency;

/**
 * Class Money
 * @package ByTIC\Money\Utility
 */
class Money
{
    /**
     * @param $value
     * @param null $currency
     */
    public static function fromFloat($value, $currency = null)
    {
        $currency = static::currency($currency);
        return new \Money\Money($value*100, $currency);
    }

    /**
     * @param $value
     * @param null $currency
     */
    public static function create($value, $currency = null)
    {
        $currency = static::currency($currency);
        return new \Money\Money($value, $currency);
    }

    /**
     * @param $code
     * @return Currency
     */
    public static function currency($code = null)
    {
        $code = $code ?: static::currencyDefault();
        return new Currency($code);
    }

    /**
     * @return string
     */
    public static function currencyDefault()
    {
        return 'RON';
    }
}