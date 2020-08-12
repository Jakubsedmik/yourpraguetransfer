<?php


class uzivatelClass extends zakladniKamenClass {

	// db vars
	protected $db_jmeno;
	protected $db_prijmeni;
	protected $db_email;
	protected $db_telefon;
	protected $db_anonymous;

	protected $db_fbid;
	protected $db_gmid;


	protected $db_avatar;
	protected $db_popis;
	protected $db_stav;

	protected $db_heslo;
	protected $db_hash;


	protected function zakladniVypis() {

	}

	protected function zakladniHtmlVypis() {

	}

	public function getTableName() {
		return "s7_uzivatel";
	}

	public function getInterfaceTypes() {
		return array(
			"db_id" => "number",
			"db_jmeno" => "string",
			"db_prijmeni" => "string",
			"db_email" => "string",
			"db_telefon" => "string"

		);
	}

	public function getFullName(){
		return $this->db_jmeno . " " . $this->db_prijmeni;
	}


	/*
	 * Funkce pro obecnou funkci uživatele, heslo se musí hashovat
	 */

	public function storePassword($value) {
		$this->db_heslo = password_hash($value, PASSWORD_BCRYPT);
		$this->aktualizovat();
		return $this->db_heslo;
	}

	public function populateClass($arrOfParams){
		if(isset($arrOfParams['db_heslo'])){
			$arrOfParams['db_heslo'] = password_hash($arrOfParams['db_heslo'], PASSWORD_BCRYPT);
		}
		parent::populateClass($arrOfParams);
	}

	public function verifyPassword($password){
		return password_verify($password, $this->db_heslo);
	}

	public function isUserLoggedIn(){
		return (isset($_SESSION['prihlaseny']) && $_SESSION['prihlaseny'] == $this->db_id);
	}

	public function logOut(){
		if(isset($_SESSION['prihlaseny']) && $_SESSION['prihlaseny'] == $this->db_id){
			unset($_SESSION['prihlaseny']);
			return true;
		}else{
			return false;
		}
	}

	public function logIn(){
		$_SESSION['prihlaseny'] = $this->getId();
	}

	public static function getUserLoggedId(){
		if(isset($_SESSION['prihlaseny'])){
			return $_SESSION['prihlaseny'];
		}else{
			return false;
		}
	}

	public static function getUserLoggedObject(){
		if(self::getUserLoggedId()){
			$uzivatel = assetsFactory::getEntity("uzivatelClass", self::getUserLoggedId());
			return $uzivatel;
		}
		return false;
	}

	public function set_not_update( $name, $value ) {
		if($name == "db_heslo"){
			$this->storePassword($value);
		}else{
			parent::set_not_update( $name, $value );
		}
	}

	public function __set( $name, $value ) {
		if($name == "db_heslo"){
			$this->storePassword($value);
		}else{
			return parent::__set( $name, $value );
		}
	}

	public function getUserExpenses(){
		$transakce = $this->loadRelatedObjects("transakceClass");
		$_this = $this;
		$expenses = array_filter($transakce, function ($value, $index) use ($_this){
			return $value->db_id_odesilatel == $_this->getId() && $value->db_accept == 1;
		}, ARRAY_FILTER_USE_BOTH);

		return $expenses;
	}

	public function getUserBillance(){
		$orders = $this->loadRelatedObjects("objednavkaClass");
		$orders = array_filter($orders, function ($value, $index){
			return $value->db_stav == 1;
		},ARRAY_FILTER_USE_BOTH);

		$expenses = $this->getUserExpenses();

		$totalKredit = 0;
		foreach ($orders as $key => $value){
			$totalKredit += $value->db_mnozstvi;
		}

		foreach ($expenses as $key => $value){
			$totalKredit -= $value->db_mnozstvi;
		}

		return $totalKredit;
	}

	public function profileQuality(){
		$points = 0;
		$total = 5;

		if(strlen(trim($this->getFullName())) > 0){
			$points++;
		}

		if(strlen(trim($this->db_email)) > 0){
			$points++;
		}

		if(strlen(trim($this->db_telefon)) > 0){
			$points++;
		}

		if(strlen(trim($this->db_avatar)) > 0){
			$points++;
		}

		if(strlen(trim($this->db_popis)) > 0){
			$points++;
		}

		return round(($points / $total) * 100,0) . " %";
	}

	public static function isUserAnonymous($email){

		$user_exists = assetsFactory::getAllEntity("uzivatelClass",array(new filterClass("email", "=", "'" . $email . "'")));
		$response = new stdClass();

		if($user_exists && is_array($user_exists) && count($user_exists) > 0){

			$user_exists = array_shift($user_exists);
			if($user_exists->db_anonymous == 1){
				$response->status = 1;
				$response->message = "Zadaný uživatel je v systému jako anonymní";
				return $response;
			}

			$response->status = 2;
			$response->message = "Zadaný uživatel je v systému řádně registrovaný";
			return $response;

		}else{
			$response->status = 0;
			$response->message = "Zadaný uživatel v systému zcela nefiguruje";
			return $response;
		}
	}


}