<?php
declare(strict_types=1);

namespace ByTIC\Money;

use ByTIC\Assets\Encore\EntrypointLookupFactory;
use ByTIC\Assets\Encore\EntrypointsCollection;
use ByTIC\Money\Formatter\Manager;
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
    public const NAME = 'money';

    public const MONEY_CURRENCIES = 'money.currencies';
    /**
     * @inheritDoc
     */
    public function provides()
    {
        return [
            self::MONEY_CURRENCIES,
            'money.currency',
            'money.formatter',
        ];
    }

    public function register()
    {
        $this->registerCurrencies();
        $this->registerCurrency();
        $this->registerFormatter();
    }

    protected function registerCurrencies()
    {
        $this->getContainer()->share(self::MONEY_CURRENCIES, function () {
            return new ISOCurrencies();
        });
    }

    protected function registerCurrency()
    {
        $this->getContainer()->share('money.currency', function () {
        });
    }

    protected function registerFormatter()
    {
        $this->getContainer()->share('money.formatter', function () {
            return Manager::instance();
        });
    }
}
