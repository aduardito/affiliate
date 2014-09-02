<?php

class MerchantTest extends PHPUnit_Framework_TestCase
{
    /**
     * If the file does not exit it will display a string
     */
    public function testFileNotExist()
    {
        $merchant = new Merchant();
        $merchant->file = 'noexist.csv';
        // return an string
        $this->assetEqual($merchant->getTransactions(), 'There is an error with the file.');
    }

    
    /**
     * If the file exist the function will return an array
     */
    public function testFileExist()
    {
        $merchant = new Merchant();
        $this->assetCount(11, $merchant->getTransactions());
    }
    
}