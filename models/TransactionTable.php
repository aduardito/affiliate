<?php

/**
 * Source of transactions, can read data.csv directly for simplicty sake, 
 * should behave like a database (read only)
 *
 */
class TransactionTable
{
    /**
     * create transaction table view to display
     * @param type $transactionArray
     * @return string
     */
    public function createView( $transactionArray )
    {
        $table = '';
        if ( is_array($transactionArray) )
        {
            $headers = $this->createHeaders();
            
            $content = $this->fillDataTable( $transactionArray );
            
            $table = '<table><thead>' .$headers . '</thead><tbody>' . $content . '</tbody></table>';
        }
        else
        {
            $table = '<h2>'. $transactionArray . '</h2>';
        }
        
        
        return $table;
    }
    
    /**
     * create header of the table to display
     * @return string
     */
    private function createHeaders()
    {
        $headers = '<tr>';
        $headers .= '<th>Merchant</th>';
        $headers .= '<th>Date</th>';
        $headers .= '<th>Amount in Pounds</th>';
        $headers .= '<th>Error</th>';
        $headers .= '</tr>';
        return $headers;
    }
    
    /**
     * fill table with data
     * @param array $transactionArray
     */
    private function fillDataTable( $transactionArray )
    {
        $content = '';
        if ( count($transactionArray) > 0 )
        {
            foreach ($transactionArray as $transaction)
            {
                $content .= $this->transactionRow( $transaction );
            }
        }
        else
        {
            $content = 'There aren\'t transactions';
        }
        
        return $content;
        
    }
    
    /**
     * CREATE transaction data row to display in table
     * @param array $transaction
     * @return string
     */
    private function transactionRow( $transaction )
    {
        if ($transaction instanceof Transaction)
        {
            return '<tr>'
                . '<td class="merchant">'. $transaction->getMerchant() . '</td>'
                . '<td class="date">'. $transaction->getDate() . '</td>'
                . '<td class="amount">'. $transaction->getAmount() . '</td>'
                . '<td class="error">'. $transaction->getError() . '</td>'
                . '</tr>';
        }
        else
        {
            return '<tr>'
                . '<td>'. 'Incorrect Data' . '</td>'
                . '</tr>';
        }
    }
    
}