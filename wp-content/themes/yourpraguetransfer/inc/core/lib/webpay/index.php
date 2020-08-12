<?php
require_once './GpWebPayment.php';


    /** 
     * vytvořit funkci která pracuje s parametry 
     * 1. na základě parametrů v post sestaví bránu
     * 2. zašle platební request
     * 3. čeká na zpětné volání z platební brány
     * 4. zpracuje zpětné volání
     * 5. customizovat tak aby v parametrech mohl příjít ještě návratová URL
     * 6. na základě výsledku platby vrací odpovídající PaymentStatus
     * 7. posílá systému ke zpracování
     * 8. systém na začátku sestavuje ORDER u sebe v DB
     * 9. po dokončení platby systém ORDER dokončuje a uzavírá jako zaplacený
     * **/

    $payment = new GpWebPayment("8", "50", "CZK","http://asap-transport.cz/webpay/index.php?callback=1");
    if(isset($_GET['callback'])){
        /* GPWEBPAY získání odpovědi */
        $result = $payment->verifyPayment();
        echo $result->errorText();
    }else {
        /* GPWEBPAY VYVOLANI BRANY */
        $payment->pay();
    }
?>