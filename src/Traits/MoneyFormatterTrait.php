<?php
declare(strict_types=1);

namespace ByTIC\Money\Traits;

use Money\Currencies;
use Money\Currencies\BitcoinCurrencies;
use Money\Formatter\AggregateMoneyFormatter;
use Money\Formatter\BitcoinMoneyFormatter;
use Money\Formatter\DecimalMoneyFormatter;
use Money\Formatter\IntlLocalizedDecimalFormatter;
use Money\Formatter\IntlMoneyFormatter;
use Money\MoneyFormatter;
use NumberFormatter;

/**
 * Trait MoneyFormatterTrait
 * @package ByTIC\Money\Traits
 */
trait MoneyFormatterTrait
{

    /**
     * Format.
     *
     * @param string|null $locale
     * @param \Money\Currencies $currencies
     * @param int $style
     *
     * @return string
     */
    public function format($locale = null, Currencies $currencies = null, $style = NumberFormatter::CURRENCY)
    {
        return $this->formatByIntl($locale, $currencies, $style);
    }

    /**
     * Format by aggregate.
     *
     * @param MoneyFormatter[] $formatters
     *
     * @return string
     */
    public function formatByAggregate(array $formatters)
    {
        $formatter = new AggregateMoneyFormatter($formatters);

        return $this->formatByFormatter($formatter);
    }

    /**
     * Format by bitcoin.
     *
     * @param int $fractionDigits
     * @param \Money\Currencies $currencies
     *
     * @return string
     */
    public function formatByBitcoin($fractionDigits = 2, Currencies $currencies = null)
    {
        $formatter = new BitcoinMoneyFormatter($fractionDigits, $currencies ?: new BitcoinCurrencies());

        return $this->formatByFormatter($formatter);
    }

    /**
     * Format by decimal.
     *
     * @param \Money\Currencies $currencies
     *
     * @return string
     */
    public function formatByDecimal(Currencies $currencies = null)
    {
        $formatter = new DecimalMoneyFormatter($currencies ?: static::getCurrencies());

        return $this->formatByFormatter($formatter);
    }

    public function formatByHtml(): string
    {
        return $this->formatBy('html');
    }

    /**
     * Format by Formater
     * @return string
     */
    public function formatBy($formatter)
    {
        $formatter = money_formatter()->get($formatter);

        return $this->formatByFormatter($formatter);
    }

    /**
     * Format by intl.
     *
     * @param string|null $locale
     * @param \Money\Currencies $currencies
     * @param int $style
     *
     * @return string
     */
    public function formatByIntl($locale = null, Currencies $currencies = null, $style = NumberFormatter::CURRENCY)
    {
        $numberFormatter = new NumberFormatter($locale ?: static::getLocale(), $style);
        $formatter = new IntlMoneyFormatter($numberFormatter, $currencies ?: static::getCurrencies());

        return $this->formatByFormatter($formatter);
    }

    /**
     * Format by intl localized decimal.
     *
     * @param string|null $locale
     * @param \Money\Currencies $currencies
     * @param int $style
     *
     * @return string
     */
    public function formatByIntlLocalizedDecimal(
        $locale = null,
        Currencies $currencies = null,
        $style = NumberFormatter::CURRENCY
    ) {
        $numberFormatter = new NumberFormatter($locale ?: static::getLocale(), $style);
        $formatter = new IntlLocalizedDecimalFormatter($numberFormatter, $currencies ?: static::getCurrencies());

        return $this->formatByFormatter($formatter);
    }

    /**
     * Format by formatter.
     *
     * @param \Money\MoneyFormatter $formatter
     *
     * @return string
     */
    public function formatByFormatter(MoneyFormatter $formatter)
    {
        return $formatter->format($this->money);
    }
}