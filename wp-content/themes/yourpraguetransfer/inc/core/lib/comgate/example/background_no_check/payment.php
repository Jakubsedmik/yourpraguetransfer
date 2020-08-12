<?php

require_once dirname(__FILE__).'/common.php';

try {

    // prepare payment parameters
    $refId = $paymentsDatabase->createNextRefId();
    $price = 12.34;
    $currency = 'CZK';

    // create new payment transaction
    $paymentsProtocol->createTransaction(
        'CZ',               // country
        $price,             // price
        $currency,          // currency
        'Payment test',     // label
        $refId,             // refId
        NULL,               // payerId
        'STANDARD',         // vatPL
        'PHYSICAL',         // category
        $_POST['method']    // method
    );
    $transId = $paymentsProtocol->getTransactionId();

    // save transaction data
    $paymentsDatabase->saveTransaction(
        $transId,       // transId
        $refId,         // refId
        $price,         // price
        $currency,      // currency
        'PENDING'       // status
    );

    // redirect to agmo payments system
    header('location: '.$paymentsProtocol->getRedirectUrl());

}
catch (Exception $e) {
    header('Content-Type: text/plain; charset=UTF-8');
    echo "ERROR\n\n";
    echo $e->getMessage();
}
