<?php

namespace ByTIC\Money\Models\Currencies\Traits;

use ByTIC\Money\Models\Currencies\CurrencyTrait;

/**
 * Class HasSerializedCurrenciesTrait.
 *
 * @property string $currencies
 */
trait HasSerializedCurrenciesTrait
{
    /**
     * @var null|CurrencyTrait[]
     */
    protected $currenciesModels = null;
    /**
     * @var null
     */
    protected $currenciesArray = null;

    /**
     * @param CurrencyTrait $currency
     *
     * @return bool
     */
    public function supportsCurrency($currency)
    {
        $currencies = $this->getCurrenciesModels();

        return isset($currencies[$currency->code]);
    }

    /**
     * @return null|CurrencyTrait[]
     */
    public function getCurrenciesModels()
    {
        if ($this->currenciesModels == null) {
            $this->initCurrencies();
        }

        return $this->currenciesModels;
    }

    public function initCurrencies()
    {
        $currenciesCodes = $this->getCurrenciesArray();
        $this->currenciesModels = [];
        foreach ($currenciesCodes as $code) {
            $this->currenciesModels[$code] = $this->initCurrency($code);
        }
    }

    /**
     * @return null|array
     */
    public function getCurrenciesArray()
    {
        if ($this->currenciesArray === null) {
            $this->initCurrenciesArray();
        }

        return $this->currenciesArray;
    }

    /**
     * @param $c
     */
    public function setCurrenciesArray($c)
    {
        $this->currenciesArray = $c;
    }

    public function initCurrenciesArray()
    {
        $this->currenciesArray = unserialize($this->currencies);
    }

    public function serializeCurrencies()
    {
        $this->currencies = serialize($this->currenciesArray);
    }

    /**
     * @param string $code
     * @return CurrencyTrait
     */
    public function initCurrency($code)
    {
        return currencyManager()->getByCode($code);
    }
}
