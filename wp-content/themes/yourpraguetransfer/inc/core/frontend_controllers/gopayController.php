<?php
use GoPay\Definition\Language;
use GoPay\Definition\Payment\Currency;
use GoPay\Definition\Payment\PaymentInstrument;
use GoPay\Definition\Payment\BankSwiftCode;
use GoPay\Definition\Payment\Recurrence;

class gopayController extends frontendController {

	protected $gopay;
	protected $recurrentPayment;
	protected $preauthorizedPayment;

	public function __construct( $actionName ) {
		$this->gopay = GoPay\payments(array(
			'goid' => '8060638179',
			'clientId' => '1564608375',
			'clientSecret' => 'nvp5U83f',
			'isProductionMode' => false,
			'language' => Language::CZECH
		));

		// recurrent payment must have field ''
		$this->recurrentPayment = array(
			'recurrence' => array(
				'recurrence_cycle' => Recurrence::DAILY,
				'recurrence_period' => "7",
				'recurrence_date_to' => '2015-12-31'
			)
		);

		// pre-authorized payment must have field 'preauthorization'
		$this->preauthorizedPayment = array(
			'preauthorization' => true
		);


		parent::__construct( $actionName );
	}

	public function beforeHeadersAction() {

	}

	public function action() {



		$result = Tools::postChecker($this->requestData, array(
			"id" => array(
				'required' => true,
				'type' => NUMBER
			)
		), true);

		if($result){
			$id = $this->requestData['id'];
            $objednavka = assetsFactory::getEntity("objednavkaClass",$id);

            if($objednavka){
                if($objednavka->db_stav == 0){

                    $contact = array(
                        'first_name' => $objednavka->db_jmeno,
                        'last_name' => $objednavka->db_prijmeni,
                        'email' => $objednavka->db_email,
                        'phone_number' => $objednavka->db_telefon,
                    );

                    $this->simpleOrderPayment($objednavka, $contact,"Platba za převoz vozu");
                    frontendError::addMessage(__("Platba", "yourpraguetransfer"), SUCCESS, __("Platební brána připravena. Pokračujte do platební brány", "yourpraguetransfer"));
                    return true;
                }else{
                    $this->setView("error");
                    frontendError::addMessage(__("Objednávka", "yourpraguetransfer"), ERROR, __("Tato objednávka již byla zaplacena", "yourpraguetransfer"));
                    return false;
                }
            }else{
                $this->setView("error");
                frontendError::addMessage(__("Objednávka", "yourpraguetransfer"), ERROR, __("Objednávka neexistuje", "yourpraguetransfer"));
                return false;
            }

		}else{
			$this->setView("error");
			frontendError::addMessage(__("Povinná pole","yourpraguetransfer"),ERROR, __("Některá povinná pole nebyla vyplněna","yourpraguetransfer"));
			return false;
		}

	}

	public function confirmPayment(){

		$result = Tools::postChecker($this->requestData, array(
			"id" => array(
				'required' => true,
				'type' => NUMBER
			),
			'orderid' => array(
				'required' => true,
				'type' => NUMBER
			)
		), true);


        if($result){
            $gopay_id = $this->requestData['id'];

            $payment_result = $this->verifyPayment($gopay_id);
            if($payment_result){

                $order_number = $payment_result->json["order_number"];
                $objednavka = assetsFactory::getEntity("objednavkaClass", $order_number);


                if($objednavka){
                    $objednavka->db_hash = $gopay_id;
                    $objednavka->db_stav = 1;

                    frontendError::addMessage(__("Úspěch","realsys"), SUCCESS, __("Objednávka byla úspěšně zaplacena.","yourpraguetransfer"));

                    $this->sendPaymentConfirmation($objednavka);
                    $this->requestData['objednavka'] = $objednavka;
                    $this->setView("confirmPayment");
                    return true;

                }else{
                    frontendError::addMessage(__("Objednávka","realsys"),ERROR, __("Zadná objednávka v systému neexistuje a nemůže být zaplacena.","yourpraguetransfer"));
                    $this->setView("error");
                    return false;
                }

            }else{
                frontendError::addMessage(__("Objednávka","realsys"),ERROR, __("Objednávka nebyla úspěšně zaplacena. Opakujte proces nebo kontaktujte administrátora","yourpraguetransfer"));
                $this->setView("errorPayment");
                return false;
            }
        }else{
            frontendError::addMessage(__("Povinná pole","realsys"),ERROR, __("Některá povinná pole nebyla vyplněna","yourpraguetransfer"));
            $this->setView("error");
            return false;
        }

	}

	protected function verifyPayment($gopay_id){
        $status = $this->gopay->getStatus($gopay_id);
        return (is_object($status) && $status->json["state"]=="PAID") ? $status : false;
    }

	protected function simpleOrderPayment($order, $contact, $description){

		$items = array(
			array('name' => $description, 'amount' => $order->db_cena * 100)
		);
		$return_url = GOPAY_STANDARD_CALLBACK . "&orderid=" . $order->getId();
		return $this->simplePayment($order->db_cena, $items, $order->getId(),$contact, $return_url ,"Platba za kredity v systému");
	}

	protected function simplePayment($ammount, $items, $order_number, $contact, $return_url, $order_description){

		$currency = Currency::CZECH_CROWNS;
		$lang = Language::CZECH;

		$gopay = $this->gopay;
		$response = $gopay->createPayment(array(
			'payer' => array(
				'default_payment_instrument' => PaymentInstrument::PAYMENT_CARD,
				'allowed_payment_instruments' => array(PaymentInstrument::BANK_ACCOUNT, PaymentInstrument::PAYMENT_CARD, PaymentInstrument::PREMIUM_SMS),
				'default_swift' => BankSwiftCode::FIO_BANKA,
				'allowed_swifts' => array(BankSwiftCode::FIO_BANKA, BankSwiftCode::MBANK),
				'contact' => $contact,
			),
			'amount' => $ammount * 100,
			'currency' => $currency,
			'order_number' => $order_number,
			'order_description' => $order_description,
			'items' => $items,
			'callback' => array(
				'return_url' => $return_url
			),
			'lang' => $lang, // if lang is not specified, then default lang is used
		));


		if ($response->hasSucceed()) {
			$templateParameters = array(
				'gatewayUrl' => $response->json['gw_url'],
				'embedJs' => $gopay->urlToEmbedJs()
			);

			$this->requestData['gopayParameters'] = $templateParameters;
			return $response->json['gw_url'];

		} else {
			// errors format: https://doc.gopay.com/en/?shell#http-result-codes
			echo "oops, API returned {$response->statusCode}: {$response}";
		}
	}

	public function sendPaymentConfirmation($objednavka){

        Tools::sendMail(
            $objednavka->db_email,
            "Potvrzení o platbě",
            "confirmPayment",
            array(
                "logo_link" => FRONTEND_IMAGES_PATH . "page-logo.png",
                "cena" => Tools::convertCurrency(intval($objednavka->db_cena), intval($objednavka->db_mena))
            )
        );
    }
}