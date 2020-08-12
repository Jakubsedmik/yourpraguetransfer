<?php


class pridatInzeratController extends frontendController {

	public function beforeHeadersAction() {
		if(uzivatelClass::getUserLoggedId() == false){
			wp_redirect(home_url() . "/login/?create=1");
		}
	}

	public function action() {

	}

	public function createInzerat(){

		$result = Tools::postChecker($this->requestData, array(
			'db_inzerat_obrazky' => array(
				'required' => true,
				'type' => PHPARRAY
			),
			'db_obrazek_front' => array(
				'required' => true,
				'type' => NUMBER
			),
			'uzivatelid' => array(
				'required' => true,
				'type' => FOREIGN_KEY
			)
		), true);

		if($result){
			if(uzivatelClass::getUserLoggedId() == $this->requestData['uzivatelid']){
				$uzivatel_id = $this->requestData['uzivatelid'];
				$uzivatel = assetsFactory::getEntity("uzivatelClass", $uzivatel_id);
				$this->requestData['db_typ_nemovitosti'] = 5;
				$this->requestData['db_stav_inzeratu'] = 2;
				$this->requestData['db_top'] = 0;

				$obrazky = $this->requestData['db_inzerat_obrazky'];
				$obrazek_front = $this->requestData['db_obrazek_front'];

				if($uzivatel){

					$this->requestData['db_uzivatel_id'] = $uzivatel->getId();

					$adresa = $this->requestData['db_ulice'] . ' ' . $this->requestData['db_cp'] . ' ,' . $this->requestData['db_mesto'] . ', ' . $this->requestData['db_psc'];
					$geocoded = Tools::geocodeAdress($adresa);
					if($geocoded){
						$lat = $geocoded->lat;
						$lng = $geocoded->lng;
						$this->requestData['db_lat'] = $lat;
						$this->requestData['db_lng'] = $lng;
					}else{
						frontendError::addMessage(__("Geokódování", "realsys"), ERROR, __("Zadaná adresa se nepodařila geokódovat. Inzerát nebyl vytvořen", "realsys"));
						$this->setView("error");
						return false;
					}

					$_this = $this;



					$response = Tools::formProcessor(array(
						"db_typ_inzeratu", "db_pocet_mistnosti", "db_ulice", "db_cp", "db_mesto", "db_psc", "db_titulek", "db_popis",
						"db_mestska_cast", "db_cena", "db_cena_poznamka", "db_cena_najem", "db_poplatky", "db_kauce", "db_typ_stavby",
						"db_stav_objektu", "db_vybavenost", "db_podlahova_plocha", "db_uzitkova_plocha", "db_pozemkova_plocha", "db_terasa",
						"db_vytah", "db_penb", "db_typ_vlastnictvi", "db_patro", "db_celkem_podlazi", "db_parkovaci_misto", "db_garaz", "db_balkon", "db_typ_nemovitosti",
						"db_stav_inzeratu", "db_material", "db_lat", "db_lng", "db_top", "db_uzivatel_id", "db_vhodny_pro", "db_k_dispozici_od", "db_dalsi_vybaveni"
					),
						$this->requestData,
						"inzeratClass",
						"create",
						NULL,
						function($entity, $source) use ($obrazky, $obrazek_front, $_this){
							$_this->requestData['inzerat'] = $entity;
							$inzerat_id = $entity->getId();
							foreach ($obrazky as $key => $value){
								$obrazek = assetsFactory::getEntity("obrazekClass", $value);
								if($obrazek){
									$obrazek->db_inzerat_id = $inzerat_id;
									if($obrazek->getId() == $obrazek_front){
										$obrazek->db_front = 1;
									}
								}else{
									frontendError::addMessage(__("Obrázky", "realsys"), ERROR, __("Některé obrázky nebyly nalezeny", "realsys"));
								}
							}
						});



					if($response){
						$this->setView("inzeratCreated");
						return true;
					}else{
						$this->setView("error");
						return false;
					}

				}else{
					frontendError::addMessage(__("Uživatel", "realsys"), ERROR, __("Uživatel neexistuje", "realsys"));
					$this->setView("error");
					return false;
				}
			}else{
				frontendError::addMessage(__("Uživatel", "realsys"), ERROR, __("Uživatel není přihlášen nebo nemáte dostatečná oprávnění", "realsys"));
				$this->setView("error");
				return false;
			}
		}else{
			frontendError::addMessage(__("Pole", "realsys"), ERROR, __("Některá pole nebyla vyplněna", "realsys"));
			$this->setView("error");
			return false;
		}
	}
}
