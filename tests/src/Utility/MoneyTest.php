<?php

namespace ByTIC\Money\Tests;

use ByTIC\Money\Utility\Money;

/**
 * Class MoneyTest
 * @package ByTIC\Money\Tests
 */
class MoneyTest extends AbstractTest
{
    public function test_create_noCurrency()
    {
        $money = Money::create(100);
        self::assertInstanceOf(\Money\Money::class, $money);
        self::assertSame($money->getAmount(), '100');
    }
}