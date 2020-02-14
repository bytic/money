<?php

namespace ByTIC\Money\Tests\Fixtures\Currencies;

use Nip\Records\RecordManager;

/**
 * Class Currencies.
 *
 * @method Currency[] getAll()
 * @method Currency findByCode($code)
 */
class Currencies extends RecordManager
{
    use \ByTIC\Money\Models\Currencies\CurrenciesTrait;
}
