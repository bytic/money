<?php

namespace ByTIC\Money\Tests\Traits;

use ByTIC\Money\Money;
use ByTIC\Money\Tests\AbstractTest;

/**
 * Class MoneyParserTraitTest
 * @package ByTIC\Money\Tests\Traits
 */
class HasTransformersTraitTest extends AbstractTest
{

    /**
     * @dataProvider \ByTIC\Money\Tests\Traits\HasTransformersTraitTest::data_toCents
     */
    public function test_toCents($value, Money $money)
    {
        self::assertEquals(
            $value,
            $money->toCents()
        );
    }

    public static function data_toCents(): array
    {
        return [
            [100, Money::USD(100)],
            [123, Money::USD(123)],
        ];
    }
}