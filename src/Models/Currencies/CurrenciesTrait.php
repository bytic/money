<?php

namespace ByTIC\Money\Models\Currencies;

/**
 * Class Currencies
 *
 * @method Currency[] getAll()
 * @method Currency findByCode($code)
 */
trait CurrenciesTrait
{
    /**
     * @param $from
     * @param $to
     * @param $amount
     * @return float|int
     */
    public function convert($from, $to, $amount)
    {
        $rates['eur'] = '1';
        $rates['bgn'] = '0.5113';
        $rates['ron'] = '0.2260';

        return $amount * $rates[$from] / $rates[$to];
    }

    /**
     * @param $code
     * @return \Currency
     */
    public function getByCode($code)
    {
        return $this->findOne($code);
    }
}
