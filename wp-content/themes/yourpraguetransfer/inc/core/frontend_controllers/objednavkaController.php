<?php


class objednavkaController extends frontendController {

    public function beforeHeadersAction() {
        return true;
    }

    public function createNewOrder() {

	    if(
	        Tools::checkPresenceOfParam("submit", $this->requestData) &&
            Tools::checkPresenceOfParam("db_data_destination_from", $this->requestData) &&
            Tools::checkPresenceOfParam("db_data_destination_to", $this->requestData) &&
            Tools::checkPresenceOfParam("db_persons", $this->requestData) &&
            Tools::checkPresenceOfParam("db_selected_way_option", $this->requestData) &&
            Tools::checkPresenceOfParam("db_currency", $this->requestData) &&
            Tools::checkPresenceOfParam("db_car_id", $this->requestData) &&
            Tools::checkPresenceOfParam("db_final_price", $this->requestData)){


	        $car_id = $this->requestData['db_car_id'];
	        $destination_from = $this->requestData['db_data_destination_from'];
            $destination_to = $this->requestData['db_data_destination_to'];
            $persons = $this->requestData['db_persons'];
            $way_option = $this->requestData['db_selected_way_option'] === 'true' ? true : false;
            $currency = $this->requestData['db_currency'];
            $final_price = $this->requestData['db_final_price'];


            $distances = Tools::getDistanceDuration($destination_from, $destination_to);
            $duration = $distances->duration;
            $distance = $distances->distance;

            $response = vozidloClass::calculateComplexPrice($car_id, $destination_from, $destination_to, $persons, $way_option, $duration, $distance, $currency );

            if($response->status){
                echo $final_price . "<br>";
                echo $response->payload['final_price'];
                if($response->payload['final_price'] == $final_price){


                    $request_data = array(
                        'db_jmeno' => $this->requestData['db_name'],
                        'db_prijmeni' => $this->requestData['db_surename'],
                        'db_email' => $this->requestData['db_email'],
                        'db_telefon' => $this->requestData['db_telephone'],
                        'db_destinace_z' => $destination_from,
                        'db_destinace_do' => $destination_to,
                        'db_cas' => strtotime($this->requestData['db_time_date']),
                        'db_cas_zpet' => strtotime($this->requestData['db_time_date_two_way']),
                        'db_pocet_osob' => $this->requestData['db_persons'],
                        'db_znameni' => $this->requestData['db_pickupsign'],
                        'db_poznamka' => $this->requestData['db_note'],
                        'db_detska_sedacka' => $this->requestData['db_kid_seat'],
                        'db_velka_zavazadla' => $this->requestData['db_large_baggage'],
                        'db_typ_platby' => $this->requestData['db_payment'],
                        'db_mena' => $this->requestData['db_currency'],
                        'db_cena' => $this->requestData['db_final_price'],
                        'db_vozidlo_id' => $this->requestData['db_car_id'],
                        'db_stav' => 0,
                        'db_hash' => "",
                    );

                    $_this = $this;

                    $response = Tools::formProcessor(
                        array(
                            'db_jmeno',
                            'db_prijmeni',
                            'db_email',
                            'db_telefon',
                            'db_destinace_z',
                            'db_destinace_do',
                            'db_cas',
                            'db_cas_zpet',
                            'db_pocet_osob',
                            'db_znameni',
                            'db_poznamka',
                            'db_detska_sedacka',
                            'db_velka_zavazadla',
                            'db_typ_platby',
                            'db_mena',
                            'db_cena',
                            'db_vozidlo_id',
                            'db_stav',
                            'db_hash'
                        ),
                        $request_data,
                        'objednavkaClass',
                        'create',
                        null,
                        function($objednavka, $source) use ($_this){
                            $id = $objednavka->getId();
                            $_this->setView("continue");
                            Tools::jsRedirect(Tools::getFERoute("objednavkaClass",$id, "detail"),1000);
                        }
                    );

                    if($response === false){
                        $this->setView("error");
                        frontendError::addMessage("Chyba",ERROR, "Došlo k chybě při vytváření objednávky");
                        return true;
                    }

                }else{
                    frontendError::addMessage("Pole",ERROR, "Pokoušíte se o něco špatného. Ceny nesedí!");
                    $this->setView("error");
                    return false;
                }
            }else{
                frontendError::addMessage("Kalkulace",ERROR, "Došlo k chybě při kalkulaci ceny");
                $this->setView("error");
                return false;
            }
        }else{
	        frontendError::addMessage("Pole",ERROR, "Některá pole nebyla vyplněna");
            $this->setView("error");
            return false;
        }
	}

	public function action(){

        if(Tools::checkPresenceOfParam("objednavka_id",$this->requestData)){
            $id = $this->requestData['objednavka_id'];
            $objednavka = assetsFactory::getEntity('objednavkaClass', $id);

            if($objednavka !== false){
                $this->requestData = array();
                $this->requestData['z'] = $objednavka->db_destinace_z;
                $this->requestData['do'] = $objednavka->db_destinace_do;
                $this->requestData['osob'] = $objednavka->db_pocet_osob;
                $this->requestData['cena'] = $objednavka->db_cena;
                $this->requestData['platba'] = $objednavka->db_typ_platby == 1 ? "Online platební kartou" : "Osobně";
                $this->requestData['cas_tam'] = date(DATE_FORMAT,  $objednavka->db_cas);
                if($objednavka->db_cas_zpet == 0){
                    $this->requestData['cas_zpet'] = date(DATE_FORMAT,  $objednavka->db_cas_zpet);
                }
            }

        }else{
            frontendError::addMessage("ID", ERROR, "Chybějící ID");
        }
        $this->setView("objednavka");
        $this->performView();

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