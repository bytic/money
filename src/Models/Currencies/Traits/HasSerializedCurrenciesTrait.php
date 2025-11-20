<?php
declare(strict_types=1);

namespace ByTIC\Money\Models\Currencies\Traits;

use ByTIC\Money\Currencies\Actions\InitCurrency;
use Money\Currency;

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
    public function supportsCurrency($currency)
    {
        $currency = InitCurrency::from($currency);
        $currencies = $this->getCurrenciesModels();

        return isset($currencies[$currency->getCode()]);
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
    public function getCurrenciesArray(): ?array
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

    public function initCurrenciesArray(): void
    {
        $currenciesSerialized = $this->currencies;
        if (empty($currenciesSerialized)) {
            $this->currenciesArray = [];
            return;
        }
        $this->currenciesArray = unserialize($this->currencies);
    }

    public function serializeCurrencies()
    {
        $this->currencies = serialize($this->currenciesArray);
    }

    /**
     * @param string $code
     * @return Currency
     */
    public function initCurrency($code)
    {
        return InitCurrency::from($code);
    }
}
