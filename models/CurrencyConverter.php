<?php

/**
 * Uses CurrencyWebservice
 *
 */
class CurrencyConverter
{
    /**
     * convert amount from euros or dollars to pounds
     * @param type $amount
     */
    public function convertToPounds($amount)
    {
        if ( $this->validateAmount($amount) )
        {
            $amountMoney = $this->prepareAmount( $amount );
            if ( $this->is_euros($amount) )
            {
                return (float) $amountMoney * CurrencyWebservice::$rates_euros_to_pounds;
            }
            elseif ( $this->is_dollars($amount) )
            {
                return  (float) $amountMoney * (float) CurrencyWebservice::$rates_dollar_to_pounds;
            }
            elseif ( $this->is_pounds($amount) )
            {
                return  $amountMoney;
            }
            
        }
        return false;
            
    }
    
    private function prepareAmount( $amount )
    {
        return str_replace(array("$","€","£"), "", $amount);
    }
    
    /**
     * Check if the amount has the correct format €11 €11.1
     * @param type $amount
     * @return boolean
     */
    private function validateAmount($amount)
    {
        return preg_match('/^(£|€|\$)?[0-9]+(\.?[0-9]+)?$/', $amount);
    }
    
    /**
     * The amount is pounds
     * @param string $amount
     * @return boolean
     */
    private function is_pounds($amount)
    {
        if (preg_match('/^£{1}\d/', $amount))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    
    /**
     * The amount is dollars
     * @param string $amount
     * @return boolean
     */
    private function is_dollars($amount)
    {
        if (preg_match('/^\${1}\d/', $amount))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    /**
     * The amount is euros
     * @param string $amount
     * @return boolean
     */
    private function is_euros($amount)
    {
        if (preg_match('/^€{1}\d/', $amount))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}