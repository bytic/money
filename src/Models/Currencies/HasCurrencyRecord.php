<?php

namespace ByTIC\Money\Models\Currencies;

use ByTIC\Money\Models\Currencies\CurrencyTrait as Currencies;
use ByTIC\Money\Models\Currencies\CurrenciesTrait as Currency;

/**
 * Class HasCurrencyRecord
 * @package ByTIC\Common\Application\Models\Currencies\Traits
 */
trait HasCurrencyRecord
{
    protected $currencyObject;

    /**
     * @return Currency
     */
    public function getCurrency()
    {
        if ($this->currencyObject === null) {
            $this->initCurrency();
        }
        return $this->currencyObject;
    }

    public function initCurrency()
    {
        $this->currencyObject = $this->getCurrenciesManager()->getByCode($this->getCurrencyCode());
    }

    /**
     * @return Currencies
     */
    public function getCurrenciesManager()
    {
        return \Currencies::instance();
    }

    /**
     * @return string
     */
    abstract public function getCurrencyCode();
}
