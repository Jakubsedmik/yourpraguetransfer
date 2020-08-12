<?php


class loginController extends frontendController {


	public function beforeHeadersAction() {
		$arr = $_GET;

		if(!(isset($arr['action']) && $arr['action'] == 'logOut')){
			if(uzivatelClass::getUserLoggedId() !== false){
				$idofuser = uzivatelClass::getUserLoggedId();
				wp_redirect(Tools::getFERoute("uzivatelClass", $idofuser));
			}
		}
	}

	public function action() {

	}

	public function logIn(){
		$result = Tools::postChecker($this->requestData, array(
			"email" => array(
				"type"=> EMAIL,
				"required" => true
			),
			"password" => array(
				"type" => STRING255,
				"required" => true
			)
		), true);

		if($result){
			$email = $this->requestData['email'];
			$heslo = $this->requestData['password'];
			$uzivatel = assetsFactory::getAllEntity("uzivatelClass",array(new filterClass("email","=","'" . $email . "'")));
			if(count($uzivatel) == 1){
				$uzivatel = array_shift($uzivatel);
				if($uzivatel->db_stav == 1){
					$login_result = $uzivatel->verifyPassword($heslo);
					if($login_result){
						$uzivatel->logIn();
						/* TODO prozatímní redirect na přidání inzerátu, po spuštění musí být na profil */
						/*frontendError::addMessage(__("Přihlášení","realsys"), SUCCESS, __("Přihlášení proběhlo úspěšně, probíhá přesměrování na vytváření inzerátu","realsys"));
						Tools::jsRedirect(Tools::getFERoute("inzeratClass",false, "add"),1500);*/

						if(Tools::checkPresenceOfParam("create",$this->requestData)){
							frontendError::addMessage(__("Přihlášení","realsys"), SUCCESS, __("Přihlášení proběhlo úspěšně, probíhá přesměrování na vytváření inzerátu","realsys"));
							Tools::jsRedirect(Tools::getFERoute("inzeratClass",$uzivatel->getId(), "add"),1500,__("Přesměrování na vytváření inzerátu","realsys"));
						}elseif(Tools::checkPresenceOfParam("watchdog", $this->requestData)){
							$watchdogid = $this->requestData['watchdog'];
							frontendError::addMessage(__("Přihlášení","realsys"), SUCCESS, __("Přihlášení proběhlo úspěšně, probíhá přesměrování na výpis vašeho hlídacího psa.","realsys"));
							Tools::jsRedirect(Tools::getFERoute("hlidacipesClass", $watchdogid),1500, __("Přesměrování na výpis hlídacího psa","realsys"));
						}else{
							frontendError::addMessage(__("Přihlášení","realsys"), SUCCESS, __("Přihlášení proběhlo úspěšně, probíhá přesměrování na Váš profil.","realsys"));
							Tools::jsRedirect(Tools::getFERoute("uzivatelClass",$uzivatel->getId()),1500, __("Přesměrování na Váš profil","realsys"));
						}
					}else{
						frontendError::addMessage(__("Uživatel","realsys"),ERROR, __("Špatné heslo","realsys"));
					}
				}else{
					frontendError::addMessage(__("Uživatel","realsys"), ERROR, __("Uživatel není ověřen, prosím nejdříve ověřte uživatele pomocí emailové adresy.","realsys"));
				}
			}else{
				frontendError::addMessage(__("Uživatel","realsys"),ERROR, __("Tento uživatel neexistuje","realsys"));
			}
		}else{
			$this->setView("error");
		}
	}

	public function googleRegistration(){
		// first check the token
		// 1. if token is ok create user and log him
		// if token is not ok show error page

		$result = Tools::postChecker(
			$this->requestData,
			array(
				"jmeno" => array(
					"type" => STRING63,
					"required" => true),
				"prijmeni" => array(
					"type" => STRING63,
					"required" => true
				),
				"email" => array(
					"type" => EMAIL,
					"required" => true
				),
				"telefon" => array(
					"type" => TEL,
					"required" => true
				),
				"token" => array(
					"type" => STRING,
					"required" => true
				),
				"gid" => array(
					"type" => STRING,
					"required" => true
				),
				"image" => array(
					"type" => URL,
					"required" => true
				)
			),
			true
		);

		if($result){

			$verificationArray = array(
				"email" => $this->requestData['email'],
				"given_name" => $this->requestData['jmeno'],
				"family_name" => $this->requestData['prijmeni'],
				"picture" => $this->requestData['image'],
				"sub" => $this->requestData['gid']
			);
			$payload = Tools::googleTokenVerification($this->requestData['token'], $verificationArray);

			if($payload){

				$email = $this->requestData['email'];
				$gid = $this->requestData['gid'];
				$user_exists = assetsFactory::getAllEntity(
					"uzivatelClass",
					array(
						new filterClass("email", "=", "'" . $email . "'"),
						new filterClass("gmid", "=", "'" . $gid . "'")
					),
					false,
					false,
					true
				);

				if(count($user_exists) > 0){
					frontendError::addMessage(__("Uživatel","realsys"), ERROR, __("Uživatel s touto emailovou adresou již existuje","realsys"));
					$this->setView("error");
					return true;
				}

				$creationArr = array(
					"db_jmeno" => $this->requestData["jmeno"],
					"db_prijmeni" => $this->requestData["prijmeni"],
					"db_email" => $this->requestData["email"],
					"db_telefon" => $this->requestData["telefon"],
					"db_gmid" => $this->requestData["gid"],
					"db_avatar" => $this->requestData["image"],
					"db_stav" => 1
				);


				$uzivatel = assetsFactory::createEntity("uzivatelClass", $creationArr);

				if($uzivatel){
					frontendError::addMessage(__("Registrace","realsys"),SUCCESS, __("Registrace proběhla úspěšně. Budete přesměrováni","realsys"));
					$uzivatel->logIn();
					Tools::jsRedirect(Tools::getFERoute("uzivatelClass",$uzivatel->getId()),1500);
					/* TODO prozatímní redirect na přidání inzerátu, po spuštění musí být na profil */
					//Tools::jsRedirect(Tools::getFERoute("inzeratClass",false, "add"),1500);
				}else{
					frontendError::addMessage(__("Registrace","realsys"), ERROR, __("Nastala chyba při vytváření uživatele. Kontaktujte prosím podporu","realsys"));
				}
			}else{
				frontendError::addMessage(__("Registrace","realsys"),ERROR,__("Snažíte se o něco špatného. Budete reportováni.","realsys"));
				$this->setView("error");
			}

		}else{
			frontendError::addMessage(__("Google","realsys"),ERROR, __("Došlo k chybě v registraci. Některá pole převzatá od systému Google nesplňují požadavky systému. Prosím proveďte manuální registraci","realsys"));
		}
	}

	public function logOut(){
		if(isset($_SESSION['prihlaseny'])){
			$id = $_SESSION['prihlaseny'];
			unset($_SESSION['prihlaseny']);
			frontendError::addMessage(__("Odhlášení","realsys"), SUCCESS, __("Úspěšně jsme Vás odhlásili","realsys"));
			Tools::jsRedirect(home_url(), 1000, __("Probíhá přesměrování","realsys"), __("Po úspěšném odhlášení Vás přesměrováváme na <strong>úvodní stránku</strong>","realsys"));
			return true;
		}
	}


	public function registerUser(){


		$request_data = $this->requestData;

		if(!invisibleRecaptchaClass::verifyRecaptchaOnController($this)){return false;}


		$result = Tools::postChecker(
			$this->requestData,
			array(
				"db_email" => array(
					"type" => STRING,
					"required" => true
				),
				"db_telefon" => array(
					"type" => TEL,
					"required" => true
				),
				"db_prijmeni" => array(
					"type" => STRING,
					"required" => true
				)
			),
			true
		);

		if($result) {
			$hash_to_send = hash("md5",$this->requestData['db_email'] . $this->requestData['db_telefon'] . $this->requestData['db_prijmeni'] . "salting");
			$request_data['db_hash'] = $hash_to_send;
			$request_data['db_stav'] = 0;

			$email = $this->requestData['db_email'];

			$uzivatel_existuje = assetsFactory::getAllEntity(
				"uzivatelClass",
				array(
					new filterClass(
						"email",
						"=",
						"'" . $email . "'"
					)
				)
			);

			if(count($uzivatel_existuje) > 0){
				frontendError::addMessage(__("Uživatel","realsys"), ERROR, __("Uživatel s touto emailovou adresou již existuje","realsys"));
				return false;
			}

			$link = home_url() . "/login/?action=confirmUserCreation&hash=" . $hash_to_send . "&email=" . $email;

			Tools::sendMail(
				$email,
				__("Potvrzení emailové adresy","realsys"),
				"confirmEmail",
				array(
					"link" => $link
				)
			);

			$response = Tools::formProcessor(
				array("db_jmeno", "db_prijmeni","db_email",
					"db_telefon", "db_heslo", "db_stav", "db_hash"),
				$request_data,
				'uzivatelClass',
				'create'
			);

			if($response === true){
				$this->requestData = array();
				$this->setView("registerRequestConfirmation");
			}

		}
	}

	public function confirmUserCreation(){

		$result = Tools::postChecker(
			$this->requestData,
			array(
				"email" => array(
					"type" => EMAIL,
					"required" => true
				),
				"hash" => array(
					"type" => STRING,
					"required" => true
				)
			),
			true
		);


		if($result){
			$email = $this->requestData['email'];
			$hash = $this->requestData['hash'];

			$uzivatel = assetsFactory::getAllEntity(
				"uzivatelClass",
				array(
					new filterClass(
						"email",
						"=",
						"'" . $email . "'"
					)
				)
			);


			if(is_array($uzivatel) && count($uzivatel) == 1){
				$uzivatel = array_shift($uzivatel);

				if(strlen($uzivatel->db_hash)==0){

					frontendError::addMessage(__("Ověření","realsys"), ERROR, __("Tento uživatel byl již ověřen.","realsys"));
					$this->setView("error");
					return false;
				}

				if($hash === $uzivatel->db_hash){

					$uzivatel->db_stav = 1;
					$uzivatel->db_hash = "";
					$this->setView("userConfirmed");
					Tools::sendMail(
						$uzivatel->db_email,
						__("Vítejte","realsys"),
						"welcomeInSystem"
					);

					/* TODO prozatímní redirect na přidání inzerátu, po spuštění musí být na profil */
					/*frontendError::addMessage(__("Ověření","realsys"),SUCCESS, __("Uživatel byl ověřen.","realsys"));
					Tools::jsRedirect(Tools::getFERoute("inzeratClass",false, "add"),1500);*/

					frontendError::addMessage(__("Ověření","realsys"),SUCCESS, __("Uživatel byl ověřen.","realsys"));
					Tools::jsRedirect(Tools::getFERoute("uzivatelClass",$uzivatel->getId()));
					return true;

				}else{
					$this->setView("error");
					frontendError::addMessage(__("Ověření","realsys"),ERROR, __("Došlo k chybě! Snažíte se o něco špatného. Budete reportováni.","realsys"));
					return false;
				}
			}else{
				$this->setView("error");
				frontendError::addMessage(__("Ověření","realsys"),ERROR, __("Zadaný uživatel v systému buď nefiguruje nebo je duplikátem.","realsys"));
				return false;
			}

		}else{
			$this->setView("error");
			return false;
		}

	}

	public function requestResetPassword(){
		$this->setView("requestResetPassword");
	}

	public function resetPasswordFinish(){

		if(uzivatelClass::getUserLoggedId() == false){

			$result = Tools::postChecker(
				$this->requestData,
				array(
					'email' => array(
						"required" => true,
						"type" => EMAIL
					),
					"hash" => array(
						"required" => true,
						"type" => STRING255
					)
				),
				true
			);

			if($result){
				$email = $this->requestData['email'];
				$hash = $this->requestData['hash'];

				$uzivatel = assetsFactory::getAllEntity(
					"uzivatelClass",
					array(
						new filterClass(
							"email",
							"=",
							"'" . $email . "'"
						)
					)
				);


				if(is_array($uzivatel) && count($uzivatel) == 1){
					$uzivatel = array_shift($uzivatel);


					if($hash === $uzivatel->db_hash){

						if(Tools::checkPresenceOfParam("db_heslo", $this->requestData)){

							$heslo = $this->requestData['db_heslo'];
							$uzivatel->storePassword($heslo);
							$uzivatel->db_hash = "";

							$this->setView("resetPasswordFinish");
							frontendError::addMessage(__("Uživatel","realsys"),SUCCESS, __("Heslo bylo změněno","realsys"));
							Tools::jsRedirect(Tools::getFERoute("uzivatelClass",false, "login"),1500);
							return true;

						}else{
							$this->setView("resetPasswordFinish");
							return true;
						}
					}else{
						frontendError::addMessage(__("Hash","realsys"),ERROR, __("Nesprávný hash, snažíte se o něco špatného, budete reportováni","realsys"));
						$this->setView("error");
						return false;
					}
				}else{

					frontendError::addMessage(__("Uživatel","realsys"),ERROR, __("Zadaný uživatel v systému neexistuje.","realsys"));
					$this->setView("error");
					return false;
				}
			}else{
				frontendError::addMessage(__("Povinná pole","realsys"),ERROR, __("Některá pole nebyla vyplněna","realsys"));
				$this->setView("error");
				return false;
			}
		}else{

			frontendError::addMessage(__("Uživatel","realsys"),ERROR, __("Pokud jste přihlášený nemůžete žádat o reset hesla","realsys"));
			$this->setView("error");
			return false;
		}
	}

	public function resetPassword(){

		if(uzivatelClass::getUserLoggedId() == false){


			$result = Tools::postChecker(
				$this->requestData,
				array(
					'db_email_nocheck' => array(
						"required" => true,
						"type" => EMAIL
					)
				),
				true
			);

			if($result){

				$email = $this->requestData['db_email_nocheck'];
				$filter_arr = array(
					new filterClass("email","=","'" . $email . "'")
				);

				$uzivatel = assetsFactory::getAllEntity("uzivatelClass", $filter_arr);


				if(is_array($uzivatel) && count($uzivatel) == 1){
					$uzivatel = array_shift($uzivatel);
					if($uzivatel->db_stav == 1){

						$hash_to_send = hash("md5",$uzivatel->db_email . $uzivatel->db_telefon . $uzivatel->db_prijmeni . "salting");
						$uzivatel->db_hash = $hash_to_send;

						$link = home_url() . "/login/?action=resetPasswordFinish&hash=" . $hash_to_send . "&email=" . $email;

						$data = array(
							'link' => $link,
							'jmeno' => $uzivatel->db_jmeno,
							'prijmeni' => $uzivatel->db_prijmeni,
							'email' => $uzivatel->db_email
						);

						Tools::sendMail( $email, "Resetování hesla", "resetPassword", $data );
						$this->setView("resetPassword");

					}else{
						frontendError::addMessage(__("Uživatel","realsys"),ERROR, __("Zadaný uživatel není v systému potvrzený","realsys"));
						$this->setView("requestResetPassword");
						return false;
					}
				}else{
					frontendError::addMessage(__("Uživatel","realsys"),ERROR, __("Zadaný uživatel v systému neexistuje","realsys"));
					$this->setView("requestResetPassword");
					return false;
				}

			}else{
				frontendError::addMessage(__("Reset hesla","realsys"),ERROR, __("Nebyla zadaná emailová adresa.","realsys"));
				$this->setView("requestResetPassword");
				return false;
			}
		}else{
			frontendError::addMessage(__("Uživatel","realsys"),ERROR, __("Pokud jste přihlášený nemůžete žádat o reset hesla","realsys"));
			$this->setView("requestResetPassword");
			return false;
		}
	}
}