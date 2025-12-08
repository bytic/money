<?php

namespace ByTIC\Money\Currencies\Actions;

use Bytic\Actions\Action;
use Bytic\Actions\Behaviours\HasSubject\HasSubject;
use Money\Currencies\ISOCurrencies;
use Money\Currency;

/**
 * @method Currency getSubject()
 */
class CurrencyData extends Action
{
    use HasSubject;

    public function setSubject($subject)
    {
        $subject = InitCurrency::from($subject);
        $this->subject = $subject;
        return $this;
    }

    public function getName()
    {
        $data = $this->get();
        return $data['name'];
    }

    public function get()
    {
        $currency = $this->getSubject();
        $currencyData = $this->currencies()->getIterator()[$currency->getCode()];
        return $currencyData;
    }


    /**
     * @return ISOCurrencies
     */
    public function currencies()
    {
        static $currencies;
        if ($currencies === null) {
            $currencies = new ISOCurrencies();
        }
        return $currencies;
    }
}