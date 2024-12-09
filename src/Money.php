<?php

namespace ByTIC\Money;

use Money\Currency;

/**
 * Class Money
 * @package ByTIC\Money
 */
class Money
{
    use Traits\CurrenciesTrait;
    use Traits\HasMoneyTrait;
    use Traits\HasStaticFunctions;
    use Traits\LocaleTrait;
    use Traits\MoneyFactory {
        Traits\MoneyFactory::__callStatic as factoryCallStatic;
    }
    use Traits\MoneyFormatterTrait;
    use Traits\MoneyParserTrait;

    public const DEFAULT_CURRENCY = 'USD';

    /**
     * Money.
     *
     * @param int|string      $amount
     * @param \Money\Currency $currency
     */
    public function __construct($amount, Currency $currency)
    {
        $this->money = new \Money\Money($amount, $currency);
    }

    /**
     * __call.
     *
     * @param string $method
     * @param array  $arguments
     *
     * @return \ByTIC\Money\Money|\ByTIC\Money\Money[]|mixed
     */
    public function __call($method, array $arguments)
    {
//        if (static::hasMacro($method)) {
//            return $this->macroCall($method, $arguments);
//        }

        if (!method_exists($this->money, $method)) {
            return $this;
        }

        $result = call_user_func_array([$this->money, $method], static::getArguments($arguments));

        $methods = [
            'add', 'subtract',
            'multiply', 'divide', 'mod',
            'absolute', 'negative',
            'allocate', 'allocateTo',
        ];

        if (!in_array($method, $methods)) {
            return $result;
        }

        return static::convertResult($result);
    }


    /**
     * __toString.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->render();
    }

    /**
     * __callStatic.
     *
     * @param string $method
     * @param array $arguments
     *
     * @return \ByTIC\Money\Money
     */
    public static function __callStatic(string $method, array $arguments): Money
    {
        if (in_array($method, ['min', 'max', 'avg', 'sum'])) {
            $result = call_user_func_array([\Money\Money::class, $method], static::getArguments($arguments));

            return static::convert($result);
        }

        return static::factoryCallStatic($method, $arguments);
    }

    /**
     * Convert.
     *
     * @param \Money\Money $instance
     *
     * @return \ByTIC\Money\Money
     */
    public static function convert(\Money\Money $instance): Money
    {
        return static::fromMoney($instance);
    }
    
    /**
     * Get the evaluated contents of the object.
     *
     * @return string
     */
    public function render()
    {
        return $this->format();
    }

    /**
     * Get arguments.
     *
     * @param array $arguments
     *
     * @return array
     */
    private static function getArguments(array $arguments = [])
    {
        $args = [];

        foreach ($arguments as $argument) {
            $args[] = $argument instanceof static ? $argument->getMoney() : $argument;
        }

        return $args;
    }

    /**
     * Convert result.
     *
     * @param mixed $result
     *
     * @return \ByTIC\Money\Money|\ByTIC\Money\Money[]
     */
    private static function convertResult($result)
    {
        if (!is_array($result)) {
            return static::convert($result);
        }

        $results = [];

        foreach ($result as $item) {
            $results[] = static::convert($item);
        }

        return $results;
    }
}