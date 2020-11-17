<?php

namespace ByTIC\Money\Formatter;

use InvalidArgumentException;
use Money\Currencies\ISOCurrencies;
use Money\MoneyFormatter;
use Nip\Cache\Stores\Repository;
use Nip\Utility\Traits\SingletonTrait;

/**
 * Class Manager
 * @package ByTIC\Money\Formatter
 */
class Manager
{
    use SingletonTrait;

    protected $formatters = [];

    /**
     * @param $name
     * @return MoneyFormatter
     */
    public function get($name)
    {
        if (!isset($this->formatters[$name])) {
            $this->formatters[$name] = $this->resolve($name);
        }
        return $this->formatters[$name];
    }

    /**
     * @param $name
     * @return Repository
     */
    protected function resolve($name)
    {
        return $this->create($name, []);
    }

    /**
     * @param $name
     * @param array $config
     * @return mixed
     */
    protected function create($name, $config = [])
    {
        $driverMethod = 'create' . ucfirst($name) . 'Formatter';
        if (method_exists($this, $driverMethod)) {
            return $this->{$driverMethod}($config);
        } else {
            throw new InvalidArgumentException("Driver [{$name}] is not supported.");
        }
    }

    /**
     * @param array $config
     * @return HtmlFormatter
     */
    protected function createHtmlFormatter($config = [])
    {
        $formatter = new HtmlFormatter(new ISOCurrencies());
        return $formatter;
    }
}
