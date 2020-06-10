<?php

namespace ByTIC\Money\Formatter;

use Money\Currencies;
use Money\Money;
use Money\MoneyFormatter;

/**
 * Class HtmlFormatter
 * @package ByTIC\Money\Formatter
 */
class HtmlFormatter implements MoneyFormatter
{

    /**
     * @var Currencies
     */
    private $currencies;

    /**
     * @param Currencies $currencies
     */
    public function __construct(Currencies $currencies)
    {
        $this->currencies = $currencies;
    }

    /**
     * Formats a Money object as string.
     *
     * @param Money $money
     *
     * @return string
     *
     * Exception\FormatterException
     */
    public function format(Money $money)
    {
        $currencyCode = $money->getCurrency()->getCode();
        list($integer, $decimal, $negative) = $this->parseAmount($money);
        $output = $this->integer($integer);
        $output .= $this->decimal($decimal);
        $output .= $this->currency($currencyCode);
        $class = $negative ? ' negative' : '';
        return '<span class="price' . $class . '" content="' . $integer . '.' . $decimal . '">'
            . $output
            . '</span>';
    }

    /**
     * @param $money
     * @return array
     */
    protected function parseAmount($money)
    {
        $valueBase = $money->getAmount();
        $negative = false;

        if ($valueBase[0] === '-') {
            $negative = true;
            $valueBase = substr($valueBase, 1);

        }
        $subunit = $this->currencies->subunitFor($money->getCurrency());
        $valueLength = strlen($valueBase);

        if ($valueLength > $subunit) {
            $integer = substr($valueBase, 0, $valueLength - $subunit);
            $decimal = substr($valueBase, $valueLength - $subunit);
        } else {
            $integer = 0;
            $decimal = str_pad('', $subunit - $valueLength, '0') . $valueBase;
        }

        return [$integer, $decimal, $negative];
    }

    /**
     * @param $code
     * @return string
     */
    protected function currency($code)
    {
        return '<span class="money-currency">' . $code . '</span>';
    }

    /**
     * @param $value
     * @return string
     */
    protected function integer($value)
    {
        return '<span class="money-int">' . number_format($value) . '</span>';
    }

    /**
     * @param $value
     * @return string
     */
    protected function decimal($value)
    {
        $value = str_pad($value, 2, '0', STR_PAD_LEFT);
        return '<sup class="money-decimal">.' . $value . '</sup>';
    }
}
