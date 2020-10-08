<?php

namespace ByTIC\Money\Tests\Models\Currencies;

use ByTIC\Money\Tests\AbstractTest;
use ByTIC\Money\Tests\Fixtures\Currencies\Currency;

/**
 * Class CurrencyTraitTest.
 */
class CurrencyTraitTest extends AbstractTest
{

    public function test_getCode()
    {
        $currency = new Currency();
        $currency->code = 'RON';

        self::assertSame('RON', $currency->code);
        self::assertSame('RON', $currency->getCode());
    }

    /**
     * @dataProvider data_MoneyHTMLFormat
     * @param $data
     * @param $amount
     * @param $expected
     */
    public function test_MoneyHTMLFormat($data, $amount, $expected)
    {
        $currency = new Currency();
        $currency->writeData($data);
        static::assertSame($expected, $currency->moneyHTMLFormat($amount));
    }

    /**
     * @return array
     */
    public function data_MoneyHTMLFormat(): array
    {
        return [
            [
                ['position' => '', 'symbol' => 'lei'],
                '100',
                '<span class="price" content="100.0"><span class="money-int">100</span><sup class="money-decimal">.00</sup> <span class="money-currency">lei</span></span>',
            ],
            [
                ['position' => '', 'symbol' => 'lei'],
                100,
                '<span class="price" content="100.0"><span class="money-int">100</span><sup class="money-decimal">.00</sup> <span class="money-currency">lei</span></span>',
            ],
            [
                ['position' => '', 'symbol' => 'lei'],
                '100.05',
                '<span class="price" content="100.05"><span class="money-int">100</span><sup class="money-decimal">.05</sup> <span class="money-currency">lei</span></span>',
            ],
            [
                ['position' => '', 'symbol' => 'lei'],
                100.05,
                '<span class="price" content="100.05"><span class="money-int">100</span><sup class="money-decimal">.05</sup> <span class="money-currency">lei</span></span>',
            ],
            [
                ['position' => '', 'symbol' => 'lei'],
                '1123.40',
                '<span class="price" content="1123.40"><span class="money-int">1,123</span><sup class="money-decimal">.40</sup> <span class="money-currency">lei</span></span>',
            ],
        ];
    }
}
