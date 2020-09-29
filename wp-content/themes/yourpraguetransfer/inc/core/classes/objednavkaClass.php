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
}