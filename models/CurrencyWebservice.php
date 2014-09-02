<?php

/**
 * Dummy web service returning random exchange rates
 *
 */
class CurrencyWebservice
{

    public static $rates_dollar_to_pounds = 0;
    
    public static $rates_euros_to_pounds = 0;
    
    public $updated;
    
    /**
     * use externall api to set the current currency rates.
     * in case we can not fetch the currency rates we will use default values
     */
    public function getExchangeRate()
    {
        $url = "http://currency-api.appspot.com/api/EUR/GBP.json?key=4fa189eaef2b6fef16dbeae44650fc8d6bdaaf23";

        $result = file_get_contents($url);
        $result = json_decode($result);

        if ($result->success)
        {
            self::$rates_euros_to_pounds = $result->rate;
            $this->updated = true;
        }
        else
        {
            $this->updated = false;
            self::$rates_euros_to_pounds = 0.7;
        }
        
        $url = "http://currency-api.appspot.com/api/USD/GBP.json?key=4fa189eaef2b6fef16dbeae44650fc8d6bdaaf23";

        $result = file_get_contents($url);
        $result = json_decode($result);

        if ($result->success)
        {
            self::$rates_dollar_to_pounds = $result->rate;
            $this->updated = true;
        }
        else
        {
            $this->updated = false;
            self::$rates_dollar_to_pounds = 0.6;
        }
    }
}