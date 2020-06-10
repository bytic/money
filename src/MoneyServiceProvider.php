<?php

namespace ByTIC\Money;

use ByTIC\Assets\Encore\EntrypointLookupFactory;
use ByTIC\Assets\Encore\EntrypointsCollection;
use Money\Currencies\ISOCurrencies;
use Nip\Container\ServiceProviders\Providers\AbstractSignatureServiceProvider;
use Symfony\Component\Asset\Package;
use Symfony\Component\Asset\Packages;
use Symfony\Component\Asset\VersionStrategy\EmptyVersionStrategy;
use Symfony\WebpackEncoreBundle\Asset\EntrypointLookupCollection;
use Symfony\WebpackEncoreBundle\Asset\TagRenderer;

/**
 * Class MoneyServiceProvider
 * @package ByTIC\Money
 */
class MoneyServiceProvider extends AbstractSignatureServiceProvider
{
    /**
     * @inheritDoc
     */
    public function provides()
    {
        return [
            'money.currencies',
            'money.currency',
            'money.formatter',
        ];
    }

    public function register()
    {
        $this->registerCurrencies();
        $this->registerCurrency();
    }

    protected function registerCurrencies()
    {
        $this->getContainer()->share('money.currencies', function () {
            return new ISOCurrencies();
        });
    }

    protected function registerCurrency()
    {
        $this->getContainer()->share('money.currency', function () {
        });
    }
}
