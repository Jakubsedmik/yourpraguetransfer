<?php


class homeController extends controller {

	public function action() {

		/*$obrazek = assetsFactory::createEntity(
			"obrazekClass",
			array(
				"titulek" => "Obejvák",
				"popisek" => "pes obejvák",
				"url" => "https://test.cz/jpg.jpg",
				"kod" => "pes obejva garaz",
				"inzerat_id" => 5,
				"datum_vytvoreni" => time(),
				"front" => true
			)
		);*/
		//$items = assetsFactory::getAllEntity("obrazekClass");
		//globalUtils::writeDebug($items);

		//echo '<div class="app"><inzeraty api_url="/realsys/wp-admin/admin-ajax.php?action=getElements" base_url="/realsys/" model="obrazekClass" item_controller="" allowed_columns="[\'db_id\', \'db_prijmeni\']"></inzeraty></div>';
		//echo frontendError::getBackendErrors();

		/*assetsFactory::createEntity("inzeratClass",array(
			'titulek' => 'Prodej bytu 2+1',
			'popis' => "Testovací popisek pro byt.",
			'typ_nemovitosti' => 0,
			'typ_stavby' => 0,
			'typ_inzeratu' => 0,
			'pocet_mistnosti' => 5,
			'patro' => 2,
			'parkovaci_misto' => false,
			'garaz' => false,
			'balkon' => false,
			'stav_objektu' => 0,
			'stav_inzeratu' => 0,
			'podlahova_plocha' => 55,
			'pozemkova_plocha' => 120,
			'lat' => 55.68745,
			'lng' => 57.87457,
			'ulice' => 'Tyršovo Náměstí',
			'mesto' => 'Roztoky',
			'cp' => '427',
			'psc' => '25264',
			'uzivatel_id' => 0,
			'top' => 0,
			'datum_zalozeni' => time()
		));*/

		/*assetsFactory::createEntity('uzivatelClass',array(
			'jmeno' => 'Jakub',
			'prijmeni' => 'Sedmík',
			'email' => 'jjj@seznam.cz',
			'telefon' => '777888999',
			'fbid' => '554dasfa55',
			'gmid'=> '5as4g5dagsd',
			'avatar' => 'https://uf.cz',
			'popis' => 'Popis uživatele',
			'datum_zalozeni' => time()
		));*/

		/*$inzerat = assetsFactory::getEntity('inzeratClass',1);
		$inzerat->writeDials();*/

		//$inzerat->getSubobject('uzivatel');
		//$inzerat->loadRelatedObjects();

		/*$uzivatel = assetsFactory::getEntity('uzivatelClass', 1);
		$uzivatel->loadRelatedObjects();*/

		$this->performView();
	}
}