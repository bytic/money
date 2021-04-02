<?php

namespace ByTIC\Money\Tests\Traits;

use ByTIC\Money\Money;
use ByTIC\Money\Tests\AbstractTest;

/**
 * Class MoneyParserTraitTest
 * @package ByTIC\Money\Tests\Traits
 */
class MoneyParserTraitTest extends AbstractTest
{

    /**
     * @dataProvider \ByTIC\Money\Tests\Traits\MoneyParserTraitTest::data_parseByDecimal
     */
    public function test_parseByDecimal($value, $money)
    {
        self::assertEquals(
            $money,
            Money::parseByDecimal($value, Money::currency(Money::DEFAULT_CURRENCY))
        );
    }

    public static function data_parseByDecimal(): array
    {
        return [
            ['1', Money::USD(100)],
            ['1.23', Money::USD(123)],
            ['1.2312', Money::USD(123)],
            [1, Money::USD(100)],
            [1.23, Money::USD(123)],
            [1.2312, Money::USD(123)],
        ];
    }
}