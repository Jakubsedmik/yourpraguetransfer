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
                            $objednavka->sendConfirmationEmail();
                            $_this->setView("continue");
                            Tools::jsRedirect(Tools::getFERoute("objednavkaClass",$id, "detail"),1000);
                        }
                    );

                    if($response === false){
                        $this->setView("error");
                        frontendError::addMessage(__("Chyba","yourpraguetransfer"),ERROR, __("Došlo k chybě při vytváření objednávky","yourpraguetransfer"));
                        return true;
                    }

                }else{
                    frontendError::addMessage(__("Pole","yourpraguetransfer"),ERROR, __("Pokoušíte se o něco špatného. Ceny nesedí!","yourpraguetransfer"));
                    $this->setView("error");
                    return false;
                }
            }else{
                frontendError::addMessage(__("Kalkulace","yourpraguetransfer"),ERROR, __("Došlo k chybě při kalkulaci ceny","yourpraguetransfer"));
                $this->setView("error");
                return false;
            }
        }else{
	        frontendError::addMessage(__("Pole","yourpraguetransfer"),ERROR, __("Některá pole nebyla vyplněna","yourpraguetransfer"));

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
                $this->requestData['cena'] = Tools::convertCurrency($objednavka->db_cena, $objednavka->db_mena);
                $this->requestData['platba'] = $objednavka->db_typ_platby == 1 ? __("Online platební kartou","yourpraguetransfer") : __("Osobně","yourpraguetransfer");
                $this->requestData['cas_tam'] = Tools::formatTime($objednavka->db_cas);

                $this->requestData['objednavka_id'] = $id;

                if($objednavka->db_stav == 1){
                    $this->requestData['zaplaceno'] = true;
                }else {
                    $this->requestData['zaplaceno'] = false;
                }

                if($objednavka->db_cas_zpet != 0){
                    $this->requestData['cas_zpet'] = Tools::formatTime($objednavka->db_cas_zpet);
                }
            }

        }else{
            frontendError::addMessage("ID", ERROR, "Chybějící ID");
        }
        $this->setView("objednavka");
        $this->performView();

    }

}