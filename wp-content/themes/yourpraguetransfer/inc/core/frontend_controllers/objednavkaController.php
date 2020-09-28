<?php


class objednavkaController extends frontendController {

    public function beforeHeadersAction() {
        return true;
    }

    public function action() {

	    if(
	        Tools::checkPresenceOfParam("submit", $this->requestData) &&
            Tools::checkPresenceOfParam("db_data_destination_from", $this->requestData) &&
            Tools::checkPresenceOfParam("db_data_destination_to", $this->requestData) &&
            Tools::checkPresenceOfParam("db_persons", $this->requestData) &&
            Tools::checkPresenceOfParam("db_selected_way_option", $this->requestData) &&
            Tools::checkPresenceOfParam("db_currency", $this->requestData) &&
            Tools::checkPresenceOfParam("db_car_id", $this->requestData)){


	        $car_id = $this->requestData['db_car_id'];
	        $destination_from = $this->requestData['db_data_destination_from'];
            $destination_to = $this->requestData['db_data_destination_to'];
            $persons = $this->requestData['db_persons'];
            $way_option = $this->requestData['db_selected_way_option'];
            $currency = $this->requestData['db_currency'];


            $distances = Tools::getDistanceDuration($destination_from, $destination_to);
            $duration = $distances->duration;
            $distance = $distances->distance;

            $response = vozidloClass::calculateComplexPrice($car_id, $destination_from, $destination_to, $persons, $way_option, $duration, $distance, $currency );
            globalUtils::writeDebug($response);


        }else{
	        frontendError::addMessage("Pole",ERROR, "Některá pole nebyla vyplněna");
            $this->setView("error");
            return false;
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