<?php


class stavController extends controller {

	public function action() {
		$this->performView();
	}


	public function edit(){


		if(Tools::checkPresenceOfParam("id",$this->requestData)){
			$id = $this->requestData['id'];
			$stav = assetsFactory::getEntity('ciselnikClass', $id);
			if($stav!== false){
				$this->viewData['stav'] = $stav;
			}

			if(Tools::checkPresenceOfParam("ulozit", $this->requestData)){
				$request_data = $this->requestData;

				$response = Tools::formProcessor(
					array('db_id','db_domain','db_property','db_value','db_translation'),
					$request_data,
					'ciselnikClass',
					'edit'
				);
			}

		}else{
			frontendError::addMessage("ID", ERROR, "Chybějící ID");
		}
		$this->setView("upravStav");
		$this->performView();
	}


	public function create(){

		if(Tools::checkPresenceOfParam("vytvorit", $this->requestData)){
			$request_data = $this->requestData;
			$response = Tools::formProcessor(
				array('db_id','db_domain','db_property','db_value','db_translation'),
				$request_data,
				'ciselnikClass',
				'create'
			);

			if($response === true){
				$this->requestData = array();
			}
		}

		$this->setView("vytvoritStav");
		$this->performView();
	}

}