<?php


class inzeratDetailController extends frontendController{

	public function beforeHeadersAction() {
		if(Tools::checkPresenceOfParam("transactionid",$_GET)){
			$transactionid = $_GET['transactionid'];
			$transaction = assetsFactory::getEntity("transakceClass",$transactionid);
			if($transaction){
				if($transaction->db_accept ==1){
					$url = parse_url(Tools::getCurrentUrl());
					unset($url['query']);
					$url = Tools::build_url($url);
					wp_redirect($url);
				}
			}
		}
	}

	public function action() {

		$is_ok = Tools::postChecker($this->requestData, array(
			"inzerat_id" => array(
				"type"=> "int",
				"required" => true
			)
		),true);

		if($is_ok){

			$id = $this->requestData['inzerat_id'];
			$inzerat = assetsFactory::getEntity("inzeratClass", $id);
			if($inzerat){

				if($inzerat->db_stav_inzeratu == 0 || $inzerat->db_stav_inzeratu == 2){
					if(uzivatelClass::getUserLoggedId() !== false){
						$uzivatel = assetsFactory::getEntity("uzivatelClass", uzivatelClass::getUserLoggedId());
						$this->requestData['aktivni'] = false;
						frontendError::addMessage(__("Inzerát","realsys"),WARNING, __("Pozor tento inzerát je neaktivní. Buď čeká na schválení administrátorem a nebo jste ho deaktivovali. Tento inzerát vidíte pouze vy.","realsys"));
						if($uzivatel && $uzivatel->getId() != $inzerat->db_uzivatel_id){
							frontendError::addMessage(__("Inzerát","realsys"), ERROR, __("Inzerát není aktivní.","realsys"));
							$this->setView("error");
							return false;
						}
					}else{
						frontendError::addMessage(__("Inzerát","realys"), ERROR, __("Inzerát není aktivní.","realsys"));
						$this->setView("error");
						return false;
					}
				}

				$inzerat->writeDials();
				$inzerat->loadRelatedObjects();
				$this->workData['inzerat'] = $inzerat;
				$this->performView();
			}else{
				trigger_error("Tento inzerát neexistuje.");
				frontendError::addMessage(__("Inzerát","realsys"), ERROR, __("Zadaný inzerát neexistuje.","realsys"));
				$this->setView("error");
			}


		}else{
			frontendError::addMessage(__("Povinná pole","realsys"), ERROR, __("Některá pole nebyla vyplněna","realsys"));
			trigger_error("Došlo k chybě ve validaci parametrů :: action|inzeratDetailController");
			$this->setView("error");
		}
		$this->performView();

	}
}