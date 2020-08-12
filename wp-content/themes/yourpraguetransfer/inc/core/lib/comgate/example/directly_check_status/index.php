<?php

require_once dirname(__FILE__).'/common.php';

try {

    // prepare payment parameters
    $refId = $paymentsDatabase->createNextRefId();
    $price = 12.34;
    $currency = 'CZK';

    // save transaction data
    $paymentsDatabase->saveTransaction(
        'UNKNOWN',      // id
        $refId,         // refId
        $price,         // price
        $currency,      // currency
        'PENDING'       // status
    );

}
catch (Exception $e) {
    header('Content-Type: text/plain; charset=UTF-8');
    echo "ERROR\n\n";
    echo $e->getMessage();
    exit;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang='cs' xml:lang='cs' xmlns='http://www.w3.org/1999/xhtml'>
<head>
    <meta http-equiv='content-type' content='text/html; charset=utf-8' />
    <title>Payments protocol simple</title>
</head>
<body>

<h1>Payments protocol simple</h1>

<form id="form" action="<?php echo $config['paymentsUrl']; ?>" method="post">
    <p>Amount: <b><?php echo $price.' '.$currency; ?></b></p>
    <input type="hidden" name="merchant" value="<?php echo $config['merchant']; ?>" />
    <input type="hidden" name="test" value="<?php echo ($config['test'] ? 'true' : 'false'); ?>" />
    <input type="hidden" name="country" value="CZ" />
    <input type="hidden" name="price" value="<?php echo round($price * 100); ?>" />
    <input type="hidden" name="curr" value="<?php echo $currency; ?>" />
    <input type="hidden" name="label" value="Payment test" />
    <input type="hidden" name="refId" value="<?php echo $refId; ?>" />
    <input type="hidden" name="vatPL" value="STANDARD" />
    <input type="hidden" name="cat" value="PHYSICAL" />
    <p>Method:
        <select name="method">
            <option value="ALL" selected="selected">ALL</option>
            <option value="BANK_ALL">BANK_ALL</option>
            <option value="BANK_CZ_AB">BANK_CZ_AB</option>
            <option value="BANK_CZ_CS">BANK_CZ_CS</option>
            <option value="BANK_CZ_CS_P">BANK_CZ_CS_P</option>
            <option value="BANK_CZ_CSOB">BANK_CZ_CSOB</option>
            <option value="BANK_CZ_CSOB_P">BANK_CZ_CSOB_P</option>
            <option value="BANK_CZ_CTB">BANK_CZ_CTB</option>
            <option value="BANK_CZ_EB">BANK_CZ_EB</option>
            <option value="BANK_CZ_FB">BANK_CZ_FB</option>
            <option value="BANK_CZ_FB_2">BANK_CZ_FB_2</option>
            <option value="BANK_CZ_GE">BANK_CZ_GE</option>
            <option value="BANK_CZ_GE_2">BANK_CZ_GE_2</option>
            <option value="BANK_CZ_KB">BANK_CZ_KB</option>
            <option value="BANK_CZ_KB_2">BANK_CZ_KB_2</option>
            <option value="BANK_CZ_MB">BANK_CZ_MB</option>
            <option value="BANK_CZ_MB_P">BANK_CZ_MB_P</option>
            <option value="BANK_CZ_OTHER">BANK_CZ_OTHER</option>
            <option value="BANK_CZ_PS">BANK_CZ_PS</option>
            <option value="BANK_CZ_PS_P">BANK_CZ_PS_P</option>
            <option value="BANK_CZ_RB">BANK_CZ_RB</option>
            <option value="BANK_CZ_RB_2">BANK_CZ_RB_2</option>
            <option value="BANK_CZ_UC">BANK_CZ_UC</option>
            <option value="BANK_CZ_VB">BANK_CZ_VB</option>
            <option value="BANK_CZ_VB_2">BANK_CZ_VB_2</option>
            <option value="BANK_CZ_ZB">BANK_CZ_ZB</option>
            <option value="PAYSEC_CZ">BANK_CZ_ZB</option>
            <option value="CARD_ALL">CARD_ALL</option>
            <option value="CARD_CZ_CS">CARD_CZ_CS</option>
            <option value="CARD_CZ_CSOB">CARD_CZ_CSOB</option>
            <option value="MPAY_CZ">MPAY_CZ</option>
            <option value="MPAY_PL">MPAY_PL</option>
            <option value="MPAY_SK">MPAY_SK</option>
            <option value="SMS_CZ">SMS_CZ</option>
        </select>
    </p>
    <input type="submit" name="submit" value="Pay">
</form>
</body>
</html>