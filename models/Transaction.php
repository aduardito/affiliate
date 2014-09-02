<?php

/* 
 * Create a class to keep the data of every transaction
 */

class Transaction
{
    
    /**
     * @const indicate the type of the merchant
     */
    const MERCHANT_IN = 1;
    const MERCHANT_OUT = 2;
    
    /**
     * display the message of the type of the merchant
     * to help the team member to read it
     * @var array 
     */
    public static $merchant_message = array(
        self::MERCHANT_IN  => 'Merchant IN',
        self::MERCHANT_OUT => 'Merchant OUT',
    );
    
    /**
     * keep the merchant
     * @var string  
     */
    private $merchant;
    
    /**
     * keep the date of the transaction
     * @var string 
     */
    private $date;
    
    /**
     * keep the amount of the transaction
     * @var string 
     */
    private $amount;
    
    /**
     * Keep the error 
     * @var string 
     */
    private $error;
    
    /**
     * 
     * @param string $merchant
     * @param string $date
     * @param string $amount
     */
    public function __construct( $merchant, $date, $amount ) 
    {
        $this->merchant = isset(self::$merchant_message[$merchant]) ? self::$merchant_message[$merchant] : $merchant;
        $this->date = $date;
        $this->error = null;
        $this->convertAmountToPound( $amount );
    }
    
    /**
     * Set the amount of money into variable. 
     * In case there is any error while converting to pounds 
     * it will be keep into error variable
     * @param string $amount
     */
    private function convertAmountToPound( $amount )
    {
        $currencyConverter = new CurrencyConverter();
        $amount_in_pounds = $currencyConverter->convertToPounds($amount);
        
        if ( $amount_in_pounds === false )
        {
            $this->amount = $amount_in_pounds;
            $this->error = 'There is an error with the amount. ' . $amount;
        }
        else
        {
            $this->amount = $amount_in_pounds;
        }
        
        
    }
    
    /**
     * get merchant value
     * @return string
     */
    public function getMerchant()
    {
        return $this->merchant;
    }
    
    /**
     * get date value
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }
    
    /**
     * get amount value
     * @return string with the value formated
     */
    public function getAmount()
    {
        if ( $this->amount === false )
        {
            return 'Error';
        }
        else
        {
            //return round($this->amount, 2);
            return number_format((float)$this->amount, 2, '.', '');
        }
        
    }
    
    /**
     * get the error that has been produced
     * @return string
     */
    public function getError()
    {
        if ( $this->error === null )
        {
            return 'No error';
        }
        else
        {
            return $this->error;
        }
        
    }
    
    
}