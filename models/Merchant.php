<?php

class Merchant
{
    public $file = 'data.csv';
    
    public $transactionArray = array();
    
    public function __construct() 
    {
        $this->file = 'data.csv';
    }

    /**
     * get all transaction from the file
     * @return string
     */
    public function getTransactions()
    {
        
        $transactionArray = array();
        
        $working_file = fopen("data.csv", "r");

        if ($working_file) 
        {
            $line_number = 0;
            while (($line = fgets($working_file)) !== false) 
            {
                if ( $line_number == 0 )
                {
                    if (preg_match('/"merchant";"date";"value"/', $line))
                    {
                        continue;
                    }
                }
                
                $line_data = split(';', $line);
                if ( count($line_data) == 3 )
                {
                    $merchant = $this->cleanString($line_data[0]) ;
                    $date = $this->cleanString($line_data[1]);
                    $amount = $this->cleanString($line_data[2]);
                    
                    $transaction = new Transaction($merchant,$date,$amount);
                    
                    $transactionArray[] = $transaction;
                }
                $line_number ++;
            }
            
        } 
        else 
        {
            $transactionArray = 'There is an error with the file.';
        } 
        
        fclose($working_file);
        
        
        return $transactionArray;
       
        
        
    }
    
    private function cleanString($subject)
    {
        return str_replace('"', '', $subject);
    }
    
}