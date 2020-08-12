<?php


class transakceClass extends zakladniKamenClass {

	protected $db_nazev_sluzby;
	protected $db_id_odesilatel;
	protected $db_id_prijemce;
	protected $db_mnozstvi;
	protected $db_accept;


	protected function zakladniVypis() {

	}

	protected function zakladniHtmlVypis() {

	}

	public function getTableName() {
		return "s7_transakce";
	}

	public static function getUserTransactions($user){

	}

	public function isConfirmed(){
		return $this->db_accept;
	}

	public function isRequestedByCurrentUser(){
		$userid = uzivatelClass::getUserLoggedId();
		return $userid == $this->db_id_odesilatel;
	}

	public function getInterfaceTypes() {
		return array(
			"db_id" => "number",
			"db_nazev_sluzby" => "string",
			"db_mnozstvi" => "number",
			"db_accept" => "boolean"
		);

	}

}