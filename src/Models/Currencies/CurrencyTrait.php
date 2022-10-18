<?php
declare(strict_types=1);

namespace ByTIC\Money\Models\Currencies;

/**
 * Trait CurrencyTrait.
 *
 * @property string $code
 * @property string $symbol
 * @property string $position
 */
trait CurrencyTrait
{
    /**
     * @return string
     */
    public function getCode()
    {
        return $this->getAttributeFromArray('code');
    }

    /**
     * @param $amount
     *
     * @return string
     */
    public function moneyHTMLFormat($amount)
    {
        $amount = floatval($amount);
        $integerValue = floor($amount);
        $decimalValue = round(($amount - $integerValue) * 100);

        $intHTML = '<span class="money-int">'.number_format($integerValue).'</span>';

        $decimalValue = str_pad(strval($decimalValue), 2, '0', STR_PAD_LEFT);
        $decimalHTML = '<sup class="money-decimal">.'.$decimalValue.'</sup>';

        $return = $intHTML.$decimalHTML;

        $symbolHTML = '<span class="money-currency">'.$this->symbol.'</span>';
        if ($this->position == 'before') {
            $return = $symbolHTML.' '.$amount;
        } else {
            $return .= ' '.$symbolHTML;
        }

        return '<span class="price" content="'.number_format($amount,2,'.','').'">'.$return.'</span>';
    }
}
