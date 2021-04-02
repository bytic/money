<?php

namespace ByTIC\Money\Tests\Models;

use ByTIC\Money\Money;
use ByTIC\Money\Tests\AbstractTest;
use ByTIC\Money\Tests\Fixtures\Users\User;

/**
 * Class MoneyCastTest
 * @package ByTIC\Money\Tests\Models
 */
class MoneyCastTest extends AbstractTest
{
    public function testCastsMoneyWhenRetrievingCastedValues()
    {
        $user = new User([
            'money' => 1234.56,
            'wage' => 50000,
            'debits' => null,
            'currency' => 'AUD',
        ]);

        static::assertInstanceOf(Money::class, $user->money);
        static::assertInstanceOf(Money::class, $user->wage);
        static::assertNull($user->debits);

        static::assertSame('123456', $user->money->getAmount());
        static::assertSame('1234.56', $user->getAttribute('money'));
        static::assertSame('USD', $user->money->getCurrency()->getCode());

        static::assertSame('5000000', $user->wage->getAmount());
        static::assertSame('50000.00', $user->getAttribute('wage'));
        static::assertSame('EUR', $user->wage->getCurrency()->getCode());

        $user->debits = 199;

        static::assertSame('199', $user->debits->getAmount());
        static::assertSame('199', $user->getAttribute('debits'));
        static::assertSame('AUD', $user->debits->getCurrency()->getCode());
    }
}