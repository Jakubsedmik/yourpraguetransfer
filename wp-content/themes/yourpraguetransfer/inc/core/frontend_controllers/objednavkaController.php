<?php


class objednavkaController extends frontendController {

	public function beforeHeadersAction() {

	}

	public function action() {
		if(uzivatelClass::getUserLoggedId() == false){
			frontendError::addMessage(__("Autorizace","realsys"), ERROR, __("Uživatel není přihlášený. Pro nákup kreditů se nejprve přihlašte","realsys"));
			$this->setView("error");
			return false;
		}

		$result = Tools::postChecker($this->requestData, array(
			'serviceOrder' => array(
				'required' => false,
				'type' => NUMBER
			)
		), true) && Tools::checkPresenceOfParam("serviceOrder",$this->requestData);

		if($result){
			global $cenik_sluzeb;
			$idservice = $this->requestData['serviceOrder'];
			if(isset($cenik_sluzeb[$idservice])){
				$service = $cenik_sluzeb[$idservice];
				$customService = array(
					'ammount' => $service['price'],
					'price' => $service['price'] * ALONE_CREDIT_PRICE,
					'name' => $service['name'],
					'message' => __('Nákupem kreditů nebude služba aktivována, po nákupu kreditů prosím službu opět stejným postupem aktivujte za již nakoupené kredity',"realsys")
				);
				$this->workData['customService'] = $customService;
			}
		}
	}

	public function processPayment(){
		if(uzivatelClass::getUserLoggedId() !== false) {
			$result = Tools::postChecker( $this->requestData, array(
				"payment" => array(
					"type"     => STRING63,
					"required" => true
				),
				"credits" => array(
					"type"     => NUMBER,
					"required" => true
				),
				"serviceOrder" => array(
					"type" => NUMBER,
					"required" => false
				)
			), true );

			if ( $result ) {
				$payment = $this->requestData['payment'];
				$credits = $this->requestData['credits'];
				if($payment == "visa"){
					global $cenik;

					$serviceOrder = false;
					if(Tools::checkPresenceOfParam("serviceOrder",$this->requestData)){
						global $cenik_sluzeb;
						$serviceId = $this->requestData['serviceOrder'];

						if(isset($cenik_sluzeb[$serviceId])){
							$service = $cenik_sluzeb[$serviceId];
							if($credits == $service['price']){
								$serviceOrder = $service;
							}
						}else{
							frontendError::addMessage(__("Služba","realsys"), ERROR, __("Tato služba v systému neexistuje.","realsys"));
							$this->setView("error");
							return false;
						}
					}


					if(Tools::checkPresenceOfParam($credits, $cenik) || $serviceOrder!= false){
						if($serviceOrder!= false){
							$finalPrice = $credits * ALONE_CREDIT_PRICE;
						}else{
							$finalPrice = $cenik[$credits];
						}

						$objednavka = assetsFactory::createEntity("objednavkaClass",array(
							"db_mnozstvi" => $credits,
							"db_cena" => $finalPrice,
							"db_uzivatel_id" => uzivatelClass::getUserLoggedId(),
							"db_stav" => 0
						));


						if($objednavka){
							Tools::jsRedirect(Tools::getFERoute("gopay",$objednavka->getId(),"payment"), 1500, __("Potvrzení","realsys"), __("Potvrzujeme objednávku - přesměrováváme Vás na platební bránu","realsys"));
							frontendError::addMessage(__("Objednávka","realsys"), SUCCESS, __("Potvrzujeme Vaši objednávku, přesměrováváme Vás na platební bránu","realsys"));
							return true;
						}else{
							frontendError::addMessage(__("Objednávka","realsys"), ERROR, __("Objednávku se nepodařilo vytvořit - kontaktujte administrátora","realsys"));
							$this->setView("error");
							return false;
						}

					}else{
						frontendError::addMessage(__("Množství kreditů","realsys"), ERROR, __("Toto množství kreditů neprodáváme","realsys"));
						$this->setView("error");
						return false;
					}
				}else{
					frontendError::addMessage(__("Platební metoda","realsys"), ERROR, __("Tuto platební metodu systém nepodporuje","realsys"));
					$this->setView("error");
					return false;
				}
			}else{
				frontendError::addMessage(__("Povinná pole","realsys"), ERROR, __("Některá pole nebyla vyplněna","realsys"));
				$this->setView("error");
				return false;
			}
		}else{
			frontendError::addMessage(__("Autorizace","realsys"), ERROR, __("Uživatel není přihlášený. Pro nákup kreditů se nejprve přihlašte","realsys"));
			$this->setView("error");
			return false;
		}
	}
}