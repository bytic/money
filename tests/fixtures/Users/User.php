<?php

namespace ByTIC\Money\Tests\Fixtures\Users;

use ByTIC\Money\Models\MoneyCast;
use ByTIC\Money\Money;
use Nip\Records\Record;

/**
 * Class User.
 *
 * @property string|Money $money
 * @property string|Money $wage
 * @property string|Money $debits
 * @property string|Money $currency
 */
class User extends Record
{
    protected $casts = [
        'money' => MoneyCast::class,
        'wage' => MoneyCast::class . ':EUR',
        'debits' => MoneyCast::class . ':currency,integer',
    ];
}
