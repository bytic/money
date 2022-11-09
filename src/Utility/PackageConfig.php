<?php
declare(strict_types=1);

namespace ByTIC\Money\Utility;

use ByTIC\Money\MoneyServiceProvider;
use Exception;
use Nip\Utility\Traits\SingletonTrait;

/**
 *
 */
class PackageConfig extends \ByTIC\PackageBase\Utility\PackageConfig
{
    use SingletonTrait;

    protected $name = MoneyServiceProvider::NAME;

    public static function configPath(): string
    {
        return __DIR__ . '/../../config/money.php';
    }

    /**
     * @return string|null
     * @throws Exception
     */
    public static function defaultCurrency($default = null): ?string
    {
        return (string)static::instance()->get('defaultCurrency', $default);
    }
}
