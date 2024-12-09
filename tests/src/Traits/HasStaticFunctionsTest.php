<?php

namespace ByTIC\Money\Tests\Traits;

use ByTIC\Money\Money;
use ByTIC\Money\Tests\AbstractTest;

/**
 *
 */
class HasStaticFunctionsTest extends AbstractTest
{
    public function test_max()
    {
        $amount1 = Money::parse(10,'USD');
        $amount2 = Money::parse(20,'USD');

        $max = Money::max($amount1, $amount2);
        self::assertInstanceOf(Money::class, $max);
        self::assertEquals($amount2,$max);
    }
}