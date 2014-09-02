<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



set_include_path('/var/www/html/affiliate/task/');



foreach (glob("models/*.php") as $filename)
{
    include $filename;
}

?>
<!DOCTYPE>
<html>
    
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
        <link rel="stylesheet" type="text/css" href="asset/styles.css" media="screen" />
    </head>
    <body>
    <?php

        $currency = new CurrencyWebservice();
        $currency->getExchangeRate();
    
        if ( $currency->updated )
        {
            ?>
        <div>
        <h3>Currency rates have been updated</h3>
        <div>Rates Euros to pounds:<?= CurrencyWebservice::$rates_euros_to_pounds ?></div>
        <div>Rates Dollars to pounds:<?= CurrencyWebservice::$rates_dollar_to_pounds ?></div>
        </div>
            <?php
        }
        else
        {
            echo '<h3>Currency rates have NOT been updated</h3>';
        }
        ?>
        
        <br />
        
        <?php
        $merchant = new Merchant();
        $transactionArray = $merchant->getTransactions();
        
        $transactionTable = new TransactionTable();
        echo $transactionTable->createView( $transactionArray );
    ?>
    </body>
</html>