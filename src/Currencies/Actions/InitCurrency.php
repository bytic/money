<?php

namespace ByTIC\Money\Currencies\Actions;

use Money\Currency;

/**
 *
 */
class InitCurrency
{
    public static function from($currency)
    {
        if ($currency === null) {
            return null;
        }
        if ($currency instanceof Currency) {
            return $currency;
        }
        if (is_object($currency) && method_exists($currency, 'getCode')) {
            return new Currency($currency->getCode());
        }
        if (is_string($currency)) {
            return new Currency($currency);
        }
        throw new \InvalidArgumentException('Invalid currency type');
    }
}

