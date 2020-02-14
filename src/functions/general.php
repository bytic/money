<?php

use ByTIC\Money\Models\Currencies\CurrenciesTrait;
use Nip\Records\AbstractModels\RecordManager;
use Nip\Records\Locator\ModelLocator;

if (!function_exists('currencyManager')) {
    /**
     * @return CurrenciesTrait|RecordManager
     */
    function currencyManager()
    {
        return ModelLocator::get('currencies');
    }
}
