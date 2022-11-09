<?php
declare(strict_types=1);

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
        $value = floatval($value);
        return \ByTIC\Money\Money::parse($value, $currency);
    }

    /**
     * @param $value
     * @param null $currency
     */
    public static function fromCents($value, $currency = null): ?\ByTIC\Money\Money
    {
        $value = intval($value);
        return \ByTIC\Money\Money::parse($value, $currency);
    }

    /**
     * @param $value
     * @param null $currency
     * @deprecated use ByTIC\Money\Money::currency
     */
    public static function create($value, $currency = null)
    {
        $currency = \ByTIC\Money\Money::currency($currency);
        return \ByTIC\Money\Money::parseByDecimal($value, $currency);
    }

    /**
     * @param $code
     * @return Currency
     * @deprecated use ByTIC\Money\Money::currency
     */
    public static function currency($code = null)
    {
        return \ByTIC\Money\Money::currency($code);
    }

    /**
     * @return string
     * @deprecated use ByTIC\Money\Money::currencyDefault
     */
    public static function currencyDefault()
    {
        return \ByTIC\Money\Money::currencyDefault();
    }

    /**
     * Get currencies.
     *
     * @return \Money\Currencies
     * @deprecated use ByTIC\Money\Money::getCurrencies
     */
    public static function getCurrencies()
    {
        return \ByTIC\Money\Money::getCurrencies();
    }
}