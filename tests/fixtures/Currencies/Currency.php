<?php

namespace ByTIC\Money\Tests\Fixtures\Currencies;

use Nip\Records\Record;

/**
 * Class Currency.
 *
 * @property string $code
 * @property string $symbol
 */
class Currency extends Record
{
    use \ByTIC\Money\Models\Currencies\CurrencyTrait;
}
