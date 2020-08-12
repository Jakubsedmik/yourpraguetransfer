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
				$response = Tools::formProcessor(
					array("db_id", "db_cena", "db_mnozstvi", "db_uzivatel_id", "db_datum_zalozeni", "db_stav"),
					$request_data,
					'objednavkaClass',
					'edit',
					null,
					function($objednavka, $source){
						// nutnost aktualizovat ve fakturoidu, neaktualizujeme na metodu aktualizovat protože ta by se odpálila i na další dílčí edity objednávky
						if($objednavka->db_stav == 1) {
							$fakturoid = new fakturoidClass();
							$fakturoid->regenerateInvoiceFromOrder( $objednavka );
						}
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
			$response = Tools::formProcessor(
				array("db_cena", "db_mnozstvi", "db_uzivatel_id", "db_stav"),
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