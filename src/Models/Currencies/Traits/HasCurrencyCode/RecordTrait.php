<?php

namespace ByTIC\Money\Models\Currencies\Traits\HasCurrencyCode;

use ByTIC\Money\Models\Currencies\CurrencyTrait;
use Nip\Records\Record;

/**
 * Class RecordTrait.
 *
 * @property string $amount
 * @property string $currency_code
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
     * @return CurrencyTrait|Record
     */
    public function getCurrency()
    {
        if ($this->_currency === null) {
            $this->initCurrency();
        }

        return $this->_currency;
    }

    /**
     * @param CurrencyTrait|Record $c
     */
    public function setCurrency(Record $c)
    {
        $this->_currency = $c;
        $this->setCurrencyCode($c->code);
    }

    public function initCurrency()
    {
        $this->_currency = currencyManager()->getByCode($this->getCurrencyCode());
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
     *
     * @return $this
     */
    public function setCurrencyCode($code)
    {
        $c = currencyManager()->getByCode($code);
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
