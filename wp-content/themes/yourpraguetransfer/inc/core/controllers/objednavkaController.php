<?php


class objednavkaController extends controller {

	public function action() {
		$this->performView();
	}

	public function edit(){

		if(Tools::checkPresenceOfParam("id",$this->requestData)){
			$id = $this->requestData['id'];
			$objednavka = assetsFactory::getEntity('objednavkaClass', $id);
			if($objednavka !== false){
				$this->viewData['objednavka'] = $objednavka;
			}

			if(Tools::checkPresenceOfParam("ulozit", $this->requestData)){
				$request_data = $this->requestData;

				if(Tools::checkPresenceOfParam("db_cas", $request_data) && Tools::checkPresenceOfParam("db_cas_zpet", $request_data)){
                    $request_data['db_cas'] = strtotime($request_data['db_cas']);
                    $request_data['db_cas_zpet'] = strtotime($request_data['db_cas_zpet']);
                }

				$response = Tools::formProcessor(
					array(
					    "db_id", "db_cena", "db_jmeno", "db_prijmeni",
                        "db_email", "db_telefon", "db_destinace_z",
                        "db_destinace_do", "db_cas", "db_cas_zpet", "db_znameni",
                        "db_poznamka", "db_detska_sedacka", "db_velka_zavazadla", "db_typ_platby",
                        "db_mena", "db_cena", "db_vozidlo_id",
                        "db_pocet_osob", "db_stav","db_datum_zalozeni"),
					$request_data,
					'objednavkaClass',
					'edit',
					null,
					function($objednavka, $source){
					    return true;
                    }
				);
			}

		}else{
			frontendError::addMessage("ID", ERROR, "Chybějící ID");
		}
		$this->setView("upravObjednavku");
		$this->performView();
	}

	public function create(){

		if(Tools::checkPresenceOfParam("vytvorit", $this->requestData)){
			$request_data = $this->requestData;

            if(Tools::checkPresenceOfParam("db_cas", $request_data) && Tools::checkPresenceOfParam("db_cas_zpet", $request_data)){

                $request_data['db_cas'] = strtotime($request_data['db_cas']);
                $request_data['db_cas_zpet'] = strtotime($request_data['db_cas']);
            }

			$response = Tools::formProcessor(
                array(
                    "db_cena", "db_jmeno", "db_prijmeni",
                    "db_email", "db_telefon", "db_destinace_z",
                    "db_destinace_do", "db_cas", "db_cas_zpet", "db_znameni",
                    "db_poznamka", "db_detska_sedacka", "db_velka_zavazadla", "db_typ_platby",
                    "db_mena", "db_cena", "db_vozidlo_id",
                    "db_pocet_osob", "db_stav"),
				$request_data,
				'objednavkaClass',
				'create'
			);

			if($response === true){
				$this->requestData = array();
			}
		}

		$this->setView("vytvoritObjednavku");
		$this->performView();
	}
}