<?php


class uzivatelDetailController extends frontendController {

	public function beforeHeadersAction() {

	}

	public function action() {

		$is_ok = Tools::postChecker($this->requestData, array(
			"uzivatel_id" => array(
				"type"=> "int",
				"required" => true
			)
		),true);

		if($is_ok){

			$id = $this->requestData['uzivatel_id'];
			$uzivatel = assetsFactory::getEntity("uzivatelClass", $id);

			if($uzivatel){

				$uzivatel->writeDials();
				$uzivatel->loadRelatedObjects();
				$this->workData['uzivatel'] = $uzivatel;
				if($uzivatel->isUserLoggedIn()){

					$this->setView("uzivatelDetailPrivate");
				}
				$this->performView();

			}else{

				trigger_error("Tento uživatel neexistuje");
				frontendError::addMessage(__("Uživatel","realsys"), ERROR, __("Zadaný uživatel neexistuje", "realsys"));
				$this->setView("error");
			}


		}else{
			trigger_error("Došlo k chybě ve validaci parametrů :: action|uzivatelDetailController");
			frontendError::addMessage(__("Povinná pole","realsys"), ERROR, __("Některá pole nebyla vyplněna","realsys"));
			$this->setView("error");
		}

		$this->performView();

	}

	public function sendMessage(){
		global $wp_query;

		if(!invisibleRecaptchaClass::verifyRecaptchaOnController($this)){return false;}

		$result = Tools::postChecker($this->requestData, array(
			"db_jmeno" => array(
				"type" => STRING255,
				"required" => true
			),
			"db_prijmeni" => array(
				"type" => STRING255,
				"required" => true
			),
			"db_email_nocheck" => array(
				"type" => EMAIL,
				"required" => true
			),
			"db_telefon" => array(
				"type" => TEL,
				"required" => true
			),
			"db_zprava" => array(
				"type" => STRING,
				"required" => true
			),
			"uzivatel_id" => array(
				"type" => NUMBER,
				"required" => true
			)
		),true);

		if($result){

			$jmeno = $this->requestData['db_jmeno'];
			$prijmeni = $this->requestData['db_prijmeni'];
			$email = $this->requestData['db_email_nocheck'];
			$telefon = $this->requestData['db_telefon'];
			$zprava = $this->requestData['db_zprava'];
			$uzivatel_id = $this->requestData['uzivatel_id'];

			$uzivatel = assetsFactory::getEntity("uzivatelClass",$uzivatel_id);
			if($uzivatel){
				$delivering_email = $uzivatel->db_email;

				$data = array(
					'jmeno' => $jmeno,
					'prijmeni' => $prijmeni,
					'email' => $email,
					'telefon' => $telefon,
					'zprava' => $zprava
				);

				$result = Tools::sendMail($delivering_email, __("Zpráva z kontaktního formuláře","realsys"), "message", $data);
				if($result){
					$routeBack = Tools::getFERoute("uzivatelClass",$uzivatel_id);
					$this->requestData['link'] = $routeBack;
					$this->setView("messageSent");
				}else{
					frontendError::addMessage(__("Email","realsys"), ERROR, __("Email se nepodařilo odeslat. Kontaktujte prosím administrátora.","realsys"));
					$this->setView("error");
					return false;
				}
			}else{
				frontendError::addMessage(__("Uživatel","realsys"), ERROR, __("Uživatel, kterému má být doručena zpráva, nebyl nalezen","realsys"));
				$this->setView("error");
				return false;
			}
		}else{
			frontendError::addMessage(__("Povinná pole","realsys"), ERROR, __("Některá pole nebyla vyplněna","realsys"));
			$this->setView("error");
			return false;
		}

	}

	public function editUser(){

		$is_ok = Tools::postChecker($this->requestData, array(
			"uzivatel_id" => array(
				"type"=> "int",
				"required" => true
			)
		),true);

		if($is_ok){

			$id = $this->requestData['uzivatel_id'];
			$uzivatel = assetsFactory::getEntity("uzivatelClass", $id);

			if($uzivatel && $uzivatel->isUserLoggedIn()){

				$uzivatel->writeDials();
				$this->workData['uzivatel'] = $uzivatel;
				$this->setView("uzivatelDetailPrivateEdit");
				$this->performView();

			}else{
				trigger_error("Tento uživatel neexistuje nebo nemáte oprávnění");
				frontendError::addMessage(__("Uživatel","realsys"), ERROR, __("Zadaný uživatel neexistuje nebo nemáte oprávnění","realsys"));
				$this->setView("notFound");
			}

		}else{
			trigger_error("Došlo k chybě ve validaci parametrů :: action|uzivatelDetailController");
			frontendError::addMessage(__("Povinná pole","realsys"), ERROR, __("Některá pole nebyla vyplněna","realsys"));
			$this->setView("error");
		}

		$this->performView();
	}


	public function changePassword(){
		$is_ok = Tools::postChecker($this->requestData, array(
			"uzivatel_id" => array(
				"type"=> NUMBER,
				"required" => true
			),
			"db_heslo" => array(
				"type" => STRING,
				"required" => true
			)
		),true);

		if($is_ok){

			$id = $this->requestData['uzivatel_id'];
			$uzivatel = assetsFactory::getEntity("uzivatelClass", $id);

			if($uzivatel && $uzivatel->isUserLoggedIn()){

				$new_password = $this->requestData['db_heslo'];
				$uzivatel->storePassword($new_password);
				$this->workData['uzivatel'] = $uzivatel;

				frontendError::addMessage(__("Heslo","realsys"),SUCCESS, __("Heslo bylo úspěšně změněno","realsys"));
				$this->setView("uzivatelDetailPrivate");

			}else{
				trigger_error("Tento uživatel neexistuje nebo nemáte oprávnění");
				frontendError::addMessage(__("Uživatel","realsys"), ERROR, __("Zadaný uživatel neexistuje nebo nemáte oprávnění","realsys"));
				$this->setView("notFound");
			}

		}else{
			trigger_error("Došlo k chybě ve validaci parametrů :: action|uzivatelDetailController");
			frontendError::addMessage(__("Povinná pole","realsys"), ERROR, __("Některá pole nebyla vyplněna","realsys"));
			$this->setView("error");
		}

		$this->performView();
	}

	public function changeUserDetails(){
		$is_ok = Tools::postChecker($this->requestData, array(
			"uzivatel_id" => array(
				"type"=> NUMBER,
				"required" => true
			)
		),true);

		if($is_ok){

			$id = $this->requestData['uzivatel_id'];
			unset($this->requestData['uzivatel_id']);
			$this->requestData['db_id'] = $id;

			$uzivatel = assetsFactory::getEntity("uzivatelClass", $id);

			if($uzivatel && $uzivatel->isUserLoggedIn()){

				$email = $this->requestData['db_email_nocheck'];
				$users = assetsFactory::getAllEntity(
					"uzivatelClass",
					array(
						new filterClass("email","=","'" . $email . "'")
					)
				);
				if(count($users) == 1 ){
					$first_user = array_shift($users);
					if($first_user->getId() != $uzivatel->getId()){
						frontendError::addMessage(__("Uživatel","realsys"),ERROR,__("Uživatel s tímto emailem v systému již existuje","realsys"));
						$this->setView("error");
						$this->performView();
						return false;
					}else{
						unset($this->requestData['db_email_nocheck']);
						$this->requestData['db_email'] = $email;
					}
				}elseif (count($users) > 1){
					frontendError::addMessage(__("Uživatel","realsys"),ERROR,__("Uživatelé s tímto emailem v systému již existují","realsys"));
					$this->setView("error");
					$this->performView();
					return false;
				}else{
					unset($this->requestData['db_email_nocheck']);
					$this->requestData['db_email'] = $email;
				}


				$response = Tools::formProcessor(
					array(
						'db_jmeno', 'db_prijmeni','db_popis','db_email','db_telefon', 'db_id'
					),
					$this->requestData,
					"uzivatelClass",
					"edit"
				);

				if($response){
					$this->setView("uzivatelDetailPrivate");
					$this->workData['uzivatel'] = $uzivatel;
				}else{
					$this->setView("error");
				}


			}else{
				trigger_error("Tento uživatel neexistuje nebo nemáte oprávnění");
				frontendError::addMessage(__("Uživatel","realsys"), ERROR, __("Zadaný uživatel neexistuje nebo nemáte oprávnění","realsys"));
				$this->setView("notFound");
			}

		}else{
			trigger_error("Došlo k chybě ve validaci parametrů :: action|uzivatelDetailController");
			frontendError::addMessage(__("Povinná pole","realsys"), ERROR, __("Některá pole nebyla vyplněna","realsys"));
			$this->setView("error");
		}

		$this->performView();
	}

	public function logOut(){

		$is_ok = Tools::postChecker($this->requestData, array(
			"uzivatel_id" => array(
				"type"=> "int",
				"required" => true
			)
		),true);

		if($is_ok){

			$id = $this->requestData['uzivatel_id'];
			$uzivatel = assetsFactory::getEntity("uzivatelClass", $id);

			if($uzivatel && $uzivatel->isUserLoggedIn()){

				$uzivatel->writeDials();
				$this->workData['uzivatel'] = $uzivatel;

				$this->setView("uzivatelDetailPrivate");
				$this->performView();
				Tools::jsRedirect(home_url(), "500",__("Úspěch","realsys"),__("Byl jste úspěšně odhlášení, probíhá přesměrování","realsys"));
				$uzivatel->logOut();

			}else{
				trigger_error("Tento uživatel neexistuje nebo nemáte oprávnění");
				frontendError::addMessage(__("Uživatel","realsys"), ERROR, __("Zadaný uživatel neexistuje nebo nemáte oprávnění","realsys"));
				$this->setView("notFound");
			}

		}else{
			trigger_error("Došlo k chybě ve validaci parametrů :: action|uzivatelDetailController");
			frontendError::addMessage(__("Povinná pole","realsys"), ERROR, __("Některá pole nebyla vyplněna","realsys"));
			$this->setView("error");
		}

		$this->performView();

	}
}