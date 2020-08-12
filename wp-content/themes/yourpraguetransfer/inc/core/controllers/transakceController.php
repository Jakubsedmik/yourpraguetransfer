<?php


class transakceController extends controller {

	public function action() {
		$this->performView();
	}

	public function edit(){

		if(Tools::checkPresenceOfParam("id",$this->requestData)){
			$id = $this->requestData['id'];
			$transakce = assetsFactory::getEntity('transakceClass', $id);
			if($transakce !== false){
				$this->viewData['transakce'] = $transakce;
			}

			if(Tools::checkPresenceOfParam("ulozit", $this->requestData)){
				$request_data = $this->requestData;
				$response = Tools::formProcessor(
					array("db_id", "db_mnozstvi","db_nazev_sluzby","db_id_odesilatel", "db_id_prijemce", "db_accept", "db_datum_zalozeni"),
					$request_data,
					'transakceClass',
					'edit'
				);
			}

		}else{
			frontendError::addMessage("ID", ERROR, "Chybějící ID");
		}
		$this->setView("upravTransakci");
		$this->performView();
	}

	public function create(){

		if(Tools::checkPresenceOfParam("ulozit", $this->requestData)){
			$request_data = $this->requestData;
			$response = Tools::formProcessor(
				array("db_mnozstvi","db_nazev_sluzby","db_id_odesilatel", "db_id_prijemce", "db_accept"),
				$request_data,
				'transakceClass',
				'create'
			);

			if($response === true){
				$this->requestData = array();
			}
		}

		$this->setView("vytvoritTransakci");
		$this->performView();
	}
}