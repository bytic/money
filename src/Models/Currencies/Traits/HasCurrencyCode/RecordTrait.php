<?php

namespace ByTIC\Money\Models\Currencies\Traits\HasCurrencyCode;

/**
 * Class RecordTrait
 *
 * @property string $currency_code
 *
 * @package ByTIC\Money\Models\Currencies\Traits\HasCurrencyCode
 */
trait RecordTrait
{

    protected $_currency = null;

    /**
     * @return string
     */
    public function printCurrencyAmount()
    {
        return $this->getCurrency()->moneyHTMLFormat($this->getCurrencyAmount());
    }

    /**
     * @return \Currency
     */
    public function getCurrency()
    {
        if ($this->_currency === null) {
            $this->initCurrency();
        }
        return $this->_currency;
    }

    /**
     * @param \Currency $c
     */
    public function setCurrency(\Currency $c)
    {
        $this->_currency = $c;
        $this->setCurrencyCode($c->code);
    }

    public function initCurrency()
    {
        $this->_currency = \Currencies::instance()->getByCode($this->getCurrencyCode());
    }

    /**
     * @return mixed
     */
    public function getCurrencyAmount()
    {
        return $this->amount;
    }

    /**
     * @param $code
     * @return $this
     */
    public function setCurrencyCode($code)
    {
        $c = \Currencies::instance()->getByCode($code);
        if ($c) {
            $this->currency_code = $code;
            $this->_currency = $c;
        }
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCurrencyCode()
    {
        return $this->currency_code;
    }
}