<?php
require_once __DIR__ . '/CSignature.php';
require_once __DIR__ . '/PaymentStatus.php';;


class GpWebPayment {
    
    protected $merchant_number;
    protected $operation;
    protected $order_number;
    protected $amount;
    protected $currency;
    protected $depositflag;
    protected $url;
    
    protected $payment_url;
    protected $sign;

    public function __construct($ordernum=NULL, $ammount=NULL, $currency="CZK", $callbackurl="https://asap-transport.cz/callback.php") {
        
        
        $this->order_number = $ordernum;
        $this->amount = $ammount*100;
        switch($currency){
            case "CZK" :
            $this->currency = 203;
            break;
            case "EUR" :
            $this->currency = 978;
            break;
            default:
            $this->currency = 203;
        }
        
        
        $this->operation = "CREATE_ORDER";
        $this->merchant_number = "9692558009";
        $this->depositflag = 1;
        $this->url = $callbackurl;
        $this->payment_url = "https://test.3dsecure.gpwebpay.com/pgw/order.do";
        $this->sign = new CSignature(__DIR__ . "/keys/privatni.key","Secretpass1.",__DIR__ . "/keys/verejny.pem");
    }
    
    public function pay($getLink = false){
        
        $request = $this->merchant_number . "|"
                . $this->operation . "|"
                . $this->order_number . "|"
                . $this->amount . "|"
                . $this->currency . "|"
                . $this->depositflag . "|"
                . $this->url;
        
        $digest = $this->sign->sign($request);
        
        $merchant_number = urlencode($this->merchant_number);
        $operation = urlencode($this->operation);
        $order_number = urlencode($this->order_number);
        $amount = urlencode($this->amount);
        $currency = urlencode($this->currency);
        $depositflag = urlencode($this->depositflag);
        $url = urlencode($this->url);
        $digest = urlencode($digest);
        
        $httpRequest = "?MERCHANTNUMBER={$merchant_number}"
                     . "&OPERATION={$operation}"
                     . "&ORDERNUMBER={$order_number}"
                     . "&AMOUNT={$amount}"
                     . "&CURRENCY={$currency}"
                     . "&DEPOSITFLAG={$depositflag}"
                     . "&URL={$url}"
                     . "&DIGEST={$digest}";
        
        $now = date("d_m_Y_H_i_s_u");
        $f = fopen(__DIR__ . "/signs/signature$now.sign", "w");
        fwrite($f, $digest);
        fclose($f);

        $f = fopen(__DIR__ . "/signs/httpRequest$now.log", "w");
        fwrite($f, $httpRequest);
        fclose($f);
        
        if($getLink){
            return $this->payment_url . $httpRequest;
        }else {
            header("Location:" . $this->payment_url . $httpRequest);
        }
    }
    
    public function verifyPayment(){
        parse_str($_SERVER['QUERY_STRING'], $getvars);
        
        if (!isset($getvars["ORDERNUMBER"])) {
            $getvars = $_REQUEST; 
        }

        $signHash = "CREATE_ORDER";
        $prCode = $getvars["PRCODE"];
        $srCode = $getvars["SRCODE"];
        $orderNumber = $getvars["ORDERNUMBER"];
        
        if (isset($getvars["RESULTTEXT"])) {
            $resultText = $getvars["RESULTTEXT"]; 
        } else {
            $resultText = '';
        }
        
        $signHash .= "|" .$orderNumber;
        $signHash .= "|" . $prCode;
        $signHash .= "|" . $srCode;
        $signHash .= "|" . $resultText;
        
        $digest = $getvars["DIGEST"];
        $digest1 = $getvars["DIGEST1"];
        
        if (strpos($digest, ' ') !== false || (strpos($digest1, ' ') !== false)) {
            $digest = str_replace(' ', '+', $digest);
            $digest1 = str_replace(' ', '+', $digest1);
        }
        
        $digok = $this->sign->verify($signHash, $digest);
        $digok = $digok && $this->sign->verify( $signHash . '|' . $this->merchant_number, $digest1);  
        
        if($digok){
            $this->order_number = $orderNumber;
        }
        $paymentstatus = new PaymentStatus($prCode, $srCode, $digok);
        return $paymentstatus;
        
    }

    public function getOrderNum(){
        return $this->order_number;
    }
    
}
