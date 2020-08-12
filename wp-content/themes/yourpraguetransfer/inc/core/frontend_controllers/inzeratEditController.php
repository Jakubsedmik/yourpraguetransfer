<?php


class inzeratEditController extends frontendController {

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
			if(uzivatelClass::getUserLoggedId() != false){
				$id_inzerat = $this->requestData['id'];
				$uzivatel = assetsFactory::getEntity("uzivatelClass", uzivatelClass::getUserLoggedId());
				$inzerat = assetsFactory::getEntity("inzeratClass",$id_inzerat);
				if($uzivatel && $inzerat){
					if($inzerat->db_uzivatel_id == $uzivatel->getId()){
						$this->requestData['inzerat'] = $inzerat;
						$this->requestData['uzivatel'] = $uzivatel;
						return true;
					}else{
						frontendError::addMessage(__("Vlastnictví inzerátu","realys"), ERROR, __("Nejste vlastníkem daného inzerátu","realsys"));
						$this->setView("error");
						return false;
					}
				}else{
					frontendError::addMessage(__("Inzerát / uživatel","realsys"), ERROR, __("Inzerát nebo uživatel nebyli nalezeni","realsys"));
					$this->setView("error");
					return false;
				}
			}else{
				frontendError::addMessage(__("Přihlášení","realsys"), ERROR, __("Nejste přihlášení do systému","realsys"));
				$this->setView("error");
				return false;
			}
		}else{
			frontendError::addMessage(__("Povinná pole","realsys"), ERROR, __("Některá pole nebyla vyplněna","realsys"));
			$this->setView("error");
			return false;
		}

	}

	public function saveInzerat(){

		$result = Tools::postChecker($this->requestData, array(
			"id" => array(
				'required' => true,
				'type' => NUMBER
			)
		), true);

		if($result){

			if(uzivatelClass::getUserLoggedId() != false){

				$id_inzerat = $this->requestData['id'];
				$uzivatel = assetsFactory::getEntity("uzivatelClass", uzivatelClass::getUserLoggedId());
				$inzerat = assetsFactory::getEntity("inzeratClass",$id_inzerat);
				if($uzivatel && $inzerat){
					if($inzerat->db_uzivatel_id == $uzivatel->getId()){
						$this->requestData['inzerat'] = $inzerat;
						$this->requestData['uzivatel'] = $uzivatel;
						unset($this->requestData['id']);
						$this->requestData['db_id'] = $id_inzerat;


						$response = Tools::formProcessor(
							array(
								"db_id",
								"db_popis",
								"db_titulek",
								"db_typ_stavby",
								"db_typ_inzeratu",
								"db_pocet_mistnosti",
								"db_typ_vlastnictvi",
								"db_mestska_cast",
								"db_podlahova_plocha",
								"db_pozemkova_plocha",
								"db_ulice",
								"db_mesto",
								"db_psc",
								"db_cp",
								"db_cena",
								"db_cena_najem",
								"db_kauce",
								"db_poplatky"
							),
							$this->requestData,
							'inzeratClass',
							'edit',
							NULL,
							"",
							"",
							true
						);

						if($response){
							$adresa = $this->requestData['db_ulice'] . ' ' . $this->requestData['db_cp'] . ' ,' . $this->requestData['db_mesto'] . ', ' . $this->requestData['db_psc'];
							$geocoded = Tools::geocodeAdress($adresa);
							if($geocoded){
								$lat = $geocoded->lat;
								$lng = $geocoded->lng;
								$inzerat->db_lat = $lat;
								$inzerat->db_lng = $lng;
							}else{
								frontendError::addMessage(__("Geocoding","realsys"), ERROR, __("Geokódování adresy se nepodařilo, byli zachovány staré souřadnice","realsys"));
							}
						}

					}else{
						frontendError::addMessage(__("Vlastnictví inzerátu","realsys"), ERROR, __("Nejste vlastníkem daného inzerátu","realsys"));
						$this->setView("error");
						return false;
					}
				}else{
					frontendError::addMessage(__("Inzerát / uživatel","realsys"), ERROR, __("Inzerát nebo uživatel nebyli nalezeni","realsys"));
					$this->setView("error");
					return false;
				}
			}else{
				frontendError::addMessage(__("Autorizace","realsys"), ERROR, __("Nejste přihlášení do systému","realsys"));
				$this->setView("error");
				return false;
			}
		}else{
			frontendError::addMessage(__("Povinná pole","realsys"), ERROR, __("Některá pole nebyla vyplněna","realsys"));
			$this->setView("error");
			return false;
		}


	}
}