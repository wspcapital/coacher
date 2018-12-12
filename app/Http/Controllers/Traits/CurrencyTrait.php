<?php
/**
 * Created by PhpStorm.
 * User: silivanov
 * Date: 16.01.17
 * Time: 17:17
 */
namespace App\Http\Controllers\Traits;

trait CurrencyTrait
{
    /**
     * Current currency number of decimal points.
     *
     * @var integer
     */
    private $currencyDecimals = 2;

    /**
     * Is show current currency decimal points in format methods.
     *
     * @var integer
     */
    private $currencyShowDecimals = true;

    /**
     * Current currency separator for the decimal point.
     *
     * @var string
     */
    private $currencyDecimalPoint = '.';

    /**
     * Current currency thousands separator.
     *
     * @var string
     */
    private $currencyThousandsSeparator = ',';

    /**
     * Current currency symbol.
     *
     * @var string
     */
    private $currencySymbol = '$';

    /**
     * Current currency symbol position (left or right).
     *
     * @var string
     */
    private $currencySymbolPosition = 'left';

    /**
     * Current currency symbol getter.
     *
     * @return string
     */
    public function getCurrencySymbol()
    {
        return $this->currencySymbol;
    }

    /**
     * Current currency symbol setter.
     *
     * @param  string  $symbol
     * @return string
     */
    public function setCurrencySymbol($symbol)
    {
        $this->currencySymbol = $symbol;
    }

    public function currencyWithSymbol($currency)
    {
        return $this->currencySymbolPosition == 'right' ?
            $currency . $this->currencySymbol :
            $this->currencySymbol . $currency;
    }

    /**
     * Convert money string (e.g. "125.60") or number to integer value in cents.
     *
     * @param  mixed  $currency  String or number of divisional money value.
     * @return int
     */
    public function currencyToInt($currency)
    {
        return (int)round((float)$currency * pow(10, $this->currencyDecimals));
    }

    /**
     * Convert integer money value in cents to friendly readable format.
     *
     * @param  mixed   $integer     String or number of integer money value in cents.
     * @param  boolean $withSymbol  Is add currency symbol to value
     * @return string
     */
    public function currencyIntFormat($integer, $withSymbol = false)
    {
        $value = number_format(
            (int)$integer / pow(10, $this->currencyDecimals),
            $this->currencyShowDecimals ? $this->currencyDecimals : 0,
            $this->currencyDecimalPoint,
            $this->currencyThousandsSeparator
        );
        return $withSymbol ? $this->currencyWithSymbol($value) : $value;
    }

    /**
     * Convert money string (e.g. "125.60") or number to friendly readable format.
     *
     * @param  mixed   $currency    String or number of divisional money value.
     * @param  boolean $withSymbol  Is add currency symbol to value
     * @return string
     */
    public function currencyFormat($currency, $withSymbol = false)
    {
        $value = number_format(
            (float)$currency,
            $this->currencyShowDecimals ? $this->currencyDecimals : 0,
            $this->currencyDecimalPoint,
            $this->currencyThousandsSeparator
        );
        return $withSymbol ? $this->currencyWithSymbol($value) : $value;
    }

    /**
     * Convert integer money value in cents to divisional value in dollars.
     *
     * @param  mixed   $integer     String or number of integer money value in cents.
     * @param  boolean $withSymbol  Is add currency symbol to value
     * @return float
     */
    public function currencyIntToFloat($integer, $withSymbol = false)
    {
        $value = ((int)$integer / pow(10, $this->currencyDecimals));
        return $withSymbol ? $this->currencyWithSymbol($value) : $value;
    }

    /**
     * Convert integer money value in cents to string of divisional value in dollars zerofill after the decimal point.
     *
     * @param  mixed   $integer     String or number of integer money value in cents.
     * @param  boolean $withSymbol  Is add currency symbol to value
     * @return string
     */
    public function currencyIntToFloatFormat($integer, $withSymbol = false)
    {
        $value = number_format(
            (int)$integer / pow(10, $this->currencyDecimals),
            $this->currencyShowDecimals ? $this->currencyDecimals : 0,
            '.',
            ''
        );
        return $withSymbol ? $this->currencyWithSymbol($value) : $value;
    }
}
