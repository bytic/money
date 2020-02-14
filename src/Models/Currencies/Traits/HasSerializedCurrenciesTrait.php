<?php

namespace ByTIC\Money\Models\Currencies\Traits;

use Currencies;
use Currency;

/**
 * Class HasSerializedCurrenciesTrait.
 *
 * @property string $currencies
 */
trait HasSerializedCurrenciesTrait
{
    /**
     * @var null|Currency[]
     */
    protected $currenciesModels = null;
    /**
     * @var null
     */
    protected $currenciesArray = null;

    /**
     * @param Currency $currency
     *
     * @return bool
     */
    public function supportsCurrency(\Currency $currency)
    {
        $currencies = $this->getCurrenciesModels();

        return isset($currencies[$currency->code]);
    }

    /**
     * @return null|Currency[]
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
     * @param $code
     *
     * @return Currency
     */
    public function initCurrency($code)
    {
        return Currencies::instance()->getByCode($code);
    }
}
