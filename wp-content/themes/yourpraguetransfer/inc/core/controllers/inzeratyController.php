<?php


class inzeratyController extends controller {

	public function action() {
		$this->performView();
	}

	public function edit() {

		if ( Tools::checkPresenceOfParam( "id", $this->requestData ) ) {
			$id      = $this->requestData['id'];
			$inzerat = assetsFactory::getEntity( 'inzeratClass', $id );
			if ( $inzerat !== false ) {
				$this->viewData['inzerat'] = $inzerat;
			}

			if ( Tools::checkPresenceOfParam( "ulozit", $this->requestData ) ) {
				$request_data = $this->requestData;

				$response = Tools::formProcessor(
					array(
						"db_id",
						"db_popis",
						"db_titulek",
						"db_typ_nemovitosti",
						"db_typ_stavby",
						"db_typ_inzeratu",
						"db_pocet_mistnosti",
						"db_patro",
						"db_parkovaci_misto",
						"db_stav_objektu",
						"db_vybavenost",
						"db_material",
						"db_penb",
						"db_typ_vlastnictvi",
						"db_terasa",
						"db_vytah",
						"db_mestska_cast",
						"db_stav_objektu",
						"db_podlahova_plocha",
						"db_pozemkova_plocha",
						"db_lat",
						"db_lng",
						"db_ulice",
						"db_mesto",
						"db_psc",
						"db_cp",
						"db_top",
						"db_garaz",
						"db_datum_zalozeni",
						"db_uzivatel_id",
						"db_balkon",
						"db_stav_inzeratu",
						"db_cena",
						"db_cena_poznamka",
						"db_celkem_podlazi",
						"db_uzitkova_plocha",
						"db_cena_najem",
						"db_poplatky",
						"db_kauce",
						"db_dalsi_vybaveni",
						"db_k_dispozici_od",
						"db_vhodny_pro"
					),
					$request_data,
					'inzeratClass',
					'edit'
				);
			}

		} else {
			frontendError::addMessage( "ID", ERROR, "Chybějící ID" );
		}
		$this->setView( "upravInzerat" );
		$this->performView();
	}


	public function create() {

		if ( Tools::checkPresenceOfParam( "vytvorit", $this->requestData ) ) {
			$request_data = $this->requestData;
			$id           = false;

			$response = Tools::formProcessor(
				array(
					"db_popis",
					"db_titulek",
					"db_typ_nemovitosti",
					"db_typ_stavby",
					"db_typ_inzeratu",
					"db_pocet_mistnosti",
					"db_patro",
					"db_parkovaci_misto",
					"db_stav_objektu",
					"db_podlahova_plocha",
					"db_pozemkova_plocha",
					"db_lat",
					"db_lng",
					"db_ulice",
					"db_mesto",
					"db_mestska_cast",
					"db_psc",
					"db_cp",
					"db_top",
					"db_garaz",
					"db_vytah",
					"db_terasa",
					"db_datum_zalozeni",
					"db_uzivatel_id",
					"db_balkon",
					'db_stav_inzeratu',
					"db_penb",
					"db_typ_vlastnictvi",
					"db_vybavenost",
					"db_material",
					'db_cena',
					'db_cena_poznamka',
					"db_celkem_podlazi",
					"db_uzitkova_plocha",
					"db_cena_najem",
					"db_poplatky",
					"db_kauce",
					"db_dalsi_vybaveni",
					"db_k_dispozici_od",
					"db_vhodny_pro"
				),
				$request_data,
				'inzeratClass',
				'create'
			);

			if ( $response === true ) {
				$this->requestData             = array();
				$this->requestData['continue'] = Tools::getRoute( "inzeratClass", "edit", Tools::$last_created->getId() ) . "#addImages";
			}
		}

		$this->setView( "vytvoritInzerat" );
		$this->performView();
	}
}