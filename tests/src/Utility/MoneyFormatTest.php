<?php

namespace ByTIC\Money\Tests\Utility;

use ByTIC\Money\Tests\AbstractTest;
use ByTIC\Money\Utility\MoneyFormat;

/**
 * Class MoneyFormatTest
 * @package ByTIC\Money\Tests
 */
class MoneyFormatTest extends AbstractTest
{
    public function test_html()
    {
        $output = MoneyFormat::html(1234);
        self::assertSame(
            '<span class="price" content="12.34"><span class="money-int">12</span><sup class="money-decimal">.34</sup><span class="money-currency">RON</span></span>',
            $output
        );
    }
}