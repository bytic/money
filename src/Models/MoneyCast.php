<?php

namespace ByTIC\Money\Models;

use ByTIC\DataObjects\BaseDto;
use ByTIC\DataObjects\Casts\CastsAttributes;
use ByTIC\Money\Money;
use InvalidArgumentException;
use Money\Currency;

/**
 * Class MoneyCast
 * @package ByTIC\Money\Models
 */
class MoneyCast implements CastsAttributes
{

    /**
     * The currency code or the model attribute holding the currency code.
     *
     * @var string|null
     */
    protected $currency;

    /**
     * Set if the storing is done as decimal or integer
     *
     * @var string|null
     */
    protected $parser = 'decimal';

    /**
     * Instantiate the class.
     *
     * @param string|null $currency
     */
    public function __construct(string $currency = null, string $parser = 'decimal')
    {
        $this->currency = $currency;

        if (!in_array($parser, ['decimal', 'integer'])) {
            throw new InvalidArgumentException(
                sprintf('Invalid value provided for parser in %s::$%s', get_class($model), $parser)
            );
        }
        $this->parser = $parser;
    }

    /**
     * Transform the attribute from the underlying model values.
     *
     * @param BaseDto $model
     * @param string $key
     * @param mixed $value
     * @param array $attributes
     *
     * @return Money|null
     */
    public function get($model, string $key, $value, array $attributes)
    {
        if ($value === null) {
            return null;
        }
        return $this->transformToMoney($value, $attributes);
    }

    /**
     * Transform the attribute to its underlying model values.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param string $key
     * @param mixed $value
     * @param array $attributes
     *
     * @return array
     * @throws \InvalidArgumentException
     *
     */
    public function set($model, string $key, $value, array $attributes)
    {
        if ($value === null) {
            return [$key => $value];
        }

        try {
            $money = $this->transformToMoney($value, $attributes);
        } catch (InvalidArgumentException $e) {
            throw new InvalidArgumentException(
                sprintf('Invalid data provided for %s::$%s', get_class($model), $key)
            );
        }

        $amount = $this->parser == 'decimal' ? $money->formatByDecimal(Money::getCurrencies()) : $money->getAmount();

        if (array_key_exists($this->currency, $attributes)) {
            return [$key => $amount, $this->currency => $money->getCurrency()->getCode()];
        }

        return [$key => $amount];
    }

    /**
     * @param $value
     * @param $attributes
     * @return Money
     */
    protected function transformToMoney($value, $attributes): Money
    {
        if ($this->parser == 'decimal') {
            return Money::parseByDecimal(
                $value,
                $this->getCurrency($attributes),
                Money::getCurrencies()
            );
        }

        return Money::parse(
            $value,
            $this->getCurrency($attributes)
        );
    }

    /**
     * Retrieve the money.
     *
     * @param array $attributes
     *
     * @return \Money\Currency
     */
    protected function getCurrency(array $attributes)
    {
        $defaultCode = Money::currencyDefault();

        if ($this->currency === null) {
            return new Currency($defaultCode);
        }

        $currency = new Currency($this->currency);
        $currencies = Money::getCurrencies();

        if ($currencies->contains($currency)) {
            return $currency;
        }

        $code = $attributes[$this->currency] ?? $defaultCode;

        return new Currency($code);
    }
}