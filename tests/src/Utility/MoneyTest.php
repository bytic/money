<?php

namespace ByTIC\Money\Tests\Utility;

use ByTIC\Money\Money;
use ByTIC\Money\Tests\AbstractTest;
use ByTIC\Money\Utility\Money as UtilityMoney;

/**
 * Class MoneyTest
 * @package ByTIC\Money\Tests\Utility
 */
class MoneyTest extends AbstractTest
{
    /**
     * @dataProvider \ByTIC\Money\Tests\Traits\MoneyParserTraitTest::data_parseByDecimal
     */
    public function test_fromFloat($value, $money)
    {
        self::assertEquals(
            $money,
            UtilityMoney::fromFloat($value)
        );
    }

    public function test_create_noCurrency()
    {
        $money = Money::create(100);
        self::assertInstanceOf(Money::class, $money);
        self::assertSame($money->getAmount(), '100');
    }
}