<?php


class obrazekController extends controller {

	public function action() {
		$this->performView();
	}


	public function edit(){

		if(Tools::checkPresenceOfParam("id",$this->requestData)){
			$id = $this->requestData['id'];
			$obrazek = assetsFactory::getEntity('obrazekClass', $id);
			if($obrazek !== false){
				$this->viewData['obrazek'] = $obrazek;
			}

			if(Tools::checkPresenceOfParam("ulozit", $this->requestData)){
				$request_data = $this->requestData;
				$response = Tools::formProcessor(
					array("db_id", "db_titulek", "db_popisek", "db_kod", "db_front", "db_datum_zalozeni", "db_url", "db_inzerat_id","db_kod","db_url"),
					$request_data,
					'obrazekClass',
					'edit'
				);
			}

		}else{
			frontendError::addMessage("ID", ERROR, "Chybějící ID");
		}
		$this->setView("upravObrazek");
		$this->performView();
	}

	public function regenerateImages(){
		if(Tools::checkPresenceOfParam("id", $this->requestData)){
			$id = $this->requestData['id'];
			$obrazek = assetsFactory::getEntity("obrazekClass",$id);
			$obrazky = array($obrazek);
			Tools::regenerateImages($obrazky);
		}else{
			$obrazky = assetsFactory::getAllEntity("obrazekClass");
			Tools::regenerateImages($obrazky);
		}
		$this->performView();
	}

	public function cleanImages(){
		Tools::cleanUnassociatedImages();
		$this->performView();
	}
}