<?php

namespace ByTIC\Money\Models\Currencies;

use ByTIC\Money\Models\Currencies\CurrenciesTrait as Currency;
use ByTIC\Money\Models\Currencies\CurrencyTrait as Currencies;
use Nip\Records\Locator\ModelLocator;

/**
 * Class HasCurrencyRecord.
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
     * @return \Nip\Records\AbstractModels\RecordManager|CurrenciesTrait
     */
    public function getCurrenciesManager()
    {
        return currencyManager();
    }

    /**
     * @return string
     */
    abstract public function getCurrencyCode();
}
