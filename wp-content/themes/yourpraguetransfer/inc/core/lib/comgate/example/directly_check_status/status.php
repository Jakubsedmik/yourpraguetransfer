<?php

require_once dirname(__FILE__).'/common.php';

try {

    // get transaction status parameters and check them in my configuration
    $paymentsProtocol->checkTransactionStatus($_POST);

    // check transaction parameters in my database
    $paymentsDatabase->checkTransaction(
        'UNKNOWN', // transId
        $paymentsProtocol->getTransactionStatusRefId(),
        $paymentsProtocol->getTransactionStatusPrice(),
        $paymentsProtocol->getTransactionStatusCurrency()
    );

    // save new transaction status to my database
    $paymentsDatabase->saveTransaction(
        'UNKNOWN', // transId
        $paymentsProtocol->getTransactionStatusRefId(),
        $paymentsProtocol->getTransactionStatusPrice(),
        $paymentsProtocol->getTransactionStatusCurrency(),
        $paymentsProtocol->getTransactionStatus()
    );

    // return OK
    echo 'code=0&message=OK';

}
catch (Exception $e) {

    // return ERROR
    echo 'code=1&message='.urlencode($e->getMessage());

}
