<?php


class objednavkaClass extends zakladniKamenClass {


	// db vars

	protected $db_jmeno;
    protected $db_prijmeni;
    protected $db_email;
    protected $db_telefon;
    protected $db_destinace_z;
    protected $db_destinace_do;
    protected $db_cas;
    protected $db_cas_zpet;
    protected $db_pocet_osob;
    protected $db_znameni;
    protected $db_poznamka;
    protected $db_detska_sedacka;
    protected $db_velka_zavazadla;
    protected $db_typ_platby;
    protected $db_mena;
	protected $db_cena;
    protected $db_vozidlo_id;

	protected $db_stav;
	protected $db_hash;


	protected function zakladniVypis() {

	}

	protected function zakladniHtmlVypis() {

	}

	public function getTableName() {
		return "s7_objednavka";
	}

	public function sendConfirmationEmail(){

	    Tools::sendMail(
	        $this->db_email,
            "Potvrzení",
            "confirmOrder",
            array(
                "payment_link" => Tools::getFERoute("gopay",$this->getId(), "payment"),
                "logo_link" => FRONTEND_IMAGES_PATH . "page-logo.png",
                "cena" => Tools::convertCurrency(intval($this->db_cena), intval($this->db_mena)),
                "zpet" => ($this->db_cas_zpet != 0 ? true : false),
                "cesta_tam" => $this->db_destinace_z,
                "cesta_zpet" => $this->db_destinace_do,
                "pocet_osob" => $this->db_pocet_osob,
                "platba" => $this->db_typ_platby
            )
        );
    }

    public function getInterfaceTypes() {
        return array(
            "db_id" => "number",
            "db_jmeno" => "string",
            "db_prijmeni" => "string",
            "db_email" => "string",
            "db_cena" => "price",
            "db_mena" => "number",
            "db_destinace_z" => "string",
            "db_destinace_do" => "string",
            "db_pocet_osob" => "number",
            "db_stav" => "number",
        );
    }
}