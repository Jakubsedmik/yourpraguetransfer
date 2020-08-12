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
			'goid' => '8292273517',
			'clientId' => '1466427842',
			'clientSecret' => 'Ebysb4Yw',
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
			if(uzivatelClass::getUserLoggedId() !== false){
				$objednavka = assetsFactory::getEntity("objednavkaClass",$id);
				$uzivatel = assetsFactory::getEntity("uzivatelClass", uzivatelClass::getUserLoggedId());

				if($objednavka && $uzivatel){
					if($objednavka->db_stav == 0){
						$this->simpleOrderPayment($objednavka, $uzivatel);
						frontendError::addMessage(__("Platba", "realsys"), SUCCESS, __("Platební brána připravena. Pokračujte do platební brány", "realsys"));
						return true;
					}else{
						$this->setView("error");
						frontendError::addMessage(__("Objednávka", "realsys"), ERROR, __("Tato objednávka již byla zaplacena", "realsys"));
						return false;
					}

				}else{
					$this->setView("error");
					frontendError::addMessage(__("Objednávka a uživatel", "realsys"), ERROR, __("Objednávka nebo uživatel neexistuje", "realsys"));
					return false;
				}
			}else{
				$this->setView("error");
				frontendError::addMessage(__("Autorizace", "realsys"), ERROR, __("Uživatel není přihlášen. Neleze provést platbu", "realsys"));
				return false;
			}
		}else{
			$this->setView("error");
			frontendError::addMessage(__("Povinná pole","realsys"),ERROR, __("Některá povinná pole nebyla vyplněna","realsys"));
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



		if(uzivatelClass::getUserLoggedId() != false){
			if($result){
				$gopay_id = $this->requestData['id'];
				$status = $this->gopay->getStatus($gopay_id);
				if(is_object($status) && $status->json["state"]=="PAID"){
					$order_number = $status->json["order_number"];

					$objednavka = assetsFactory::getEntity("objednavkaClass", $order_number);
					$uzivatel = assetsFactory::getEntity("uzivatelClass", uzivatelClass::getUserLoggedId());

					if($objednavka && $uzivatel){
						$objednavka->db_hash = $gopay_id;
						$objednavka->db_stav = 1;

						$fakturoid = new fakturoidClass();
						$fakturoid->createInvoiceForOrder($objednavka,true, true);

						frontendError::addMessage(__("Úspěch","realsys"), SUCCESS, __("Objednávka byla úspěšně zaplacena.","realsys"));
						$this->requestData['uzivatel'] = $uzivatel;
						$this->requestData['objednavka'] = $objednavka;
						$this->setView("confirmPayment");
						return true;

					}else{
						frontendError::addMessage(__("Objednávka","realsys"),ERROR, __("Zadná objednávka v systému neexistuje a nemůže být zaplacena.","realsys"));
						$this->setView("error");
						return false;
					}

				}else{
					frontendError::addMessage(__("Objednávka","realsys"),ERROR, __("Objednávka nebyla úspěšně zaplacena. Opakujte proces nebo kontaktujte administrátora","realsys"));
					$this->requestData['orderid'] = $this->requestData['orderid'];
					$this->setView("errorPayment");
					return false;
				}
			}else{
				frontendError::addMessage(__("Povinná pole","realsys"),ERROR, __("Některá povinná pole nebyla vyplněna","realsys"));
				$this->setView("error");
				return false;
			}
		}else{
			frontendError::addMessage(__("Autorizace", "realsys"), ERROR, __("Uživatel není přihlášen. Nelze potvrdit platbu", "realsys"));
			$this->setView("error");
			return false;
		}

	}

	public function quickOrder(){

		$result = Tools::postChecker($this->requestData, array(
			'serviceid' => array(
				'required' => true,
				'type' => NUMBER
			),
			'redirect' => array(
				'required' => true,
				'type' => URL
			),
			'db_email' => array(
				'required' => true,
				'type' => EMAIL
			)
		), true);

		if($result){
			global $cenik_sluzeb;

			$serviceid = $this->requestData['serviceid'];
			$callbackurl = $this->requestData['redirect'];
			$email = $this->requestData['db_email'];
			$response = uzivatelClass::isUserAnonymous($email);

			if(isset($cenik_sluzeb[$serviceid])){

				$sluzba = $cenik_sluzeb[$serviceid];
				$uzivatel = false;

				if($response->status == 0){
					$result = false;
					$result = Tools::postChecker($this->requestData, array(
						'db_jmeno' => array(
							'required' => true,
							'type' => STRING255
						),
						'db_prijmeni' => array(
							'required' => true,
							'type' => STRING255
						)
					), true);

					if($result){

						$uzivatel = assetsFactory::createEntity("uzivatelClass",array(
							'db_jmeno' => $this->requestData['db_jmeno'],
							'db_prijmeni' => $this->requestData['db_prijmeni'],
							'db_email' => $this->requestData['db_email'],
							'db_telefon' => '777 888 999',
							'db_anonymous' => true
						));

						if(!$uzivatel){
							frontendError::addMessage("Uživatel",ERROR, "Anonymního uživatele se bohužel nepodařilo vytvořit");
							return false;
						}

					}else{
						frontendError::addMessage("Jméno a příjmení", ERROR, "Chybějící pole jméno a příjmení");
						return false;
					}

				}elseif ($response->status == 1){

					$uzivatel = assetsFactory::getAllEntity("uzivatelClass",array(new filterClass("email","=","'" . $email . "'")));

					if(is_array($uzivatel) && count($uzivatel) > 0){
						$uzivatel = array_shift($uzivatel);
					}else{
						frontendError::addMessage("Uživatel", ERROR, "Anonymního uživatele se bohužel nepodařilo nalézt");
						return false;
					}

				}elseif ($response->status == 2){
					frontendError::addMessage("Email", ERROR, "Uživatel s tímto emailem je v systému řádně registrovaný. Nelze provést anonymní objednávku.");
					return false;
				}


				if(is_object($uzivatel)){
					$uzivatel_id = $uzivatel->getId();
				}else{
					$uzivatel_id = 1;
				}

				$anonymni_objednavka = assetsFactory::createEntity("objednavkaClass",array(
					"db_cena" => $sluzba['price'] * ALONE_CREDIT_PRICE,
					"db_mnozstvi" => $sluzba['price'],
					"db_stav" => 0,
					"db_uzivatel_id" => $uzivatel_id
				));


				Tools::jsRedirect($this->quickPayment($anonymni_objednavka, $callbackurl,$serviceid, $uzivatel),0);
				$this->setView("quickOrder");
				return true;

			}else{
				frontendError::addMessage(__("Služba", "realsys"), ERROR, __("Zadaná služba v systému neexistuje","realsys"));
				$this->setView("error");
				return false;
			}
		}else{
			frontendError::addMessage(__("Povinná pole","realsys"),ERROR, __("Některá povinná pole nebyla vyplněna","realsys"));
			$this->setView("error");
			return false;
		}

	}

	public function confirmQuickPayment(){
		$result = Tools::postChecker($this->requestData, array(
			"callbackurl" => array(
				'required' => true,
				'type' => NUMBER
			),
			'orderid' => array(
				'required' => true,
				'type' => NUMBER
			),
			"id" => array(
				"required" => true,
				"type" => NUMBER
			),
			"serviceid" => array(
				"required" => true,
				"type" => NUMBER
			)
		), true);


		if($result){
			$gopay_id = $this->requestData['id'];
			$status = $this->gopay->getStatus($gopay_id);

			if(is_object($status) && $status->json["state"]=="PAID"){
				$order_number = $status->json["order_number"];

				$objednavka = assetsFactory::getEntity("objednavkaClass", $order_number);

				if($objednavka){
					$objednavka->db_hash = $gopay_id;
					$objednavka->db_stav = 1;

					$fakturoid = new fakturoidClass();
					$fakturoid->createInvoiceForOrder($objednavka,true, true);

					frontendError::addMessage(__("Úspěch","realsys"), SUCCESS, __("Objednávka byla úspěšně zaplacena.","realsys"));

					global $cenik_sluzeb;
					$serviceid = $this->requestData['serviceid'];
					$sluzba = $cenik_sluzeb[$serviceid];
					if(!isset($service['requireEntity'])){

						$transakce = assetsFactory::createEntity("transakceClass", array(
							"id_odesilatel" => $objednavka->db_uzivatel_id,
							"id_prijemce" => -1,
							"mnozstvi" => $sluzba['price'],
							"nazev_sluzby" => $sluzba['name'],
							'accept' => 0
						));


						$redirect = $this->requestData['callbackurl'] . "?transactionid=" .  $transakce->getId();

						$_SESSION['transactionid'] = $transakce->getId();
						Tools::jsRedirect($redirect,0);
						$this->requestData['objednavka'] = $objednavka;
						$this->setView("confirmSimplePayment");
						return true;

					}else{
						$this->setView("error");
						frontendError::addMessage( __("Objednávka", "realsys"), ERROR, __("Zjednodušená objednávka nefunguje s komplexními službami","realsys"));
						return false;
					}
				}else{
					frontendError::addMessage(__("Objednávka","realsys"),ERROR, __("Zadná objednávka v systému neexistuje a nemůže být zaplacena.","realsys"));
					$this->setView("error");
					return false;
				}
			}else{
				frontendError::addMessage(__("Objednávka","realsys"),ERROR, __("Objednávka nebyla úspěšně zaplacena. Opakujte proces nebo kontaktujte administrátora","realsys"));
				$this->requestData['orderid'] = $this->requestData['orderid'];
				$this->setView("errorPayment");
				return false;
			}
		}else{
			frontendError::addMessage(__("Povinná pole","realsys"),ERROR, __("Některá povinná pole nebyla vyplněna","realsys"));
			$this->setView("error");
			return false;
		}

	}

	protected function simpleOrderPayment($order, $user){
		$contact = array(
			'first_name' => $user->db_jmeno,
			'last_name' => $user->db_prijmeni,
			'email' => $user->db_email,
			'phone_number' => $user->db_telefon,
		);

		$items = array(
			array('name' => 'Objednávka kreditů', 'amount' => $order->db_cena * 100)
		);
		$return_url = GOPAY_STANDARD_CALLBACK . "&orderid=" . $order->getId();
		return $this->simplePayment($order->db_cena, $items, $order->getId(),$contact, $return_url ,"Platba za kredity v systému");
	}

	protected function quickPayment($order, $callbackurl, $serviceid, $user){

		$contact = array(
			'first_name' => $user->db_jmeno,
			'last_name' => $user->db_prijmeni,
			'email' => $user->db_email
		);

		$items = array(
			array('name' => 'Objednávka kreditů', 'amount' => $order->db_cena * 100)
		);

		$return_url = GOPAY_QUICK_CALLBACK . "&orderid=" . $order->getId() . "&callbackurl=" . $callbackurl . "&serviceid=" . $serviceid;
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
}