<?php


class hlidacipesClass extends zakladniKamenClass {

	protected $db_uzivatel_id;
	protected $db_jmeno_psa;
	protected $db_posledni_inzeraty;
	protected $db_nastaveni_filtru;
	protected $db_nove_inzeraty_pocet;
	protected $db_posledni_zobrazeni;
	protected $db_premium;

	protected $posledni_inzeraty_objects;
	protected $soucasne_inzeraty_objects;
	protected $nove_inzeraty_objects;


	public function __construct( $id ) {
		$this->posledni_inzeraty_objects = array();
		$this->soucasne_inzeraty_objects = array();
		$this->nove_inzeraty_objects = array();
		$this->db_posledni_zobrazeni = time();
		$this->db_nove_inzeraty_pocet = 0;
		parent::__construct( $id );
	}

	public function nacistPosledniInzeraty(){
		if(is_array($this->db_posledni_inzeraty) && count($this->db_posledni_inzeraty) > 0){
			foreach ($this->db_posledni_inzeraty as $key => $value){
				$this->posledni_inzeraty_objects[$value] = assetsFactory::getEntity("inzeratClass",$value);
			}
		}else{
			$this->posledni_inzeraty_objects = array();
		}
	}

	public function nacistNoveInzeraty(){
		$this->soucasne_inzeraty_objects = assetsFactory::getAllEntity("inzeratClass", $this->dejNastaveniFiltru());
		return $this->soucasne_inzeraty_objects;
	}

	public function dejRozdilInzeratu(){
		$nove = array_udiff($this->soucasne_inzeraty_objects,$this->posledni_inzeraty_objects, function ($a, $b){
			if($a->getId() > $b->getId()){
				return 1;
			}elseif ($a->getId() < $b->getId()){
				return -1;
			}
			return 0;
		});

		$this->db_nove_inzeraty_pocet = count($nove);
		$this->nove_inzeraty_objects = $nove;

		return $nove;
	}

	public function zadejNovyZakladInzeratu(){
		$novy_zaklad = array_uintersect($this->posledni_inzeraty_objects, $this->soucasne_inzeraty_objects, function ($a, $b){
			if($a->getId() > $b->getId()){
				return 1;
			}elseif ($a->getId() < $b->getId()){
				return -1;
			}
			return 0;
		});
		$this->posledni_inzeraty_objects = $novy_zaklad;
		$this->transformujPosledniInzertyNaIdcka();
	}

	public function dejNastaveniFiltru(){
		return $this->db_nastaveni_filtru;
	}

	public function zkontrolujInzeraty(){
		$this->nacistNoveInzeraty();
		$this->nacistPosledniInzeraty();
		$this->dejRozdilInzeratu();
		$this->zadejNovyZakladInzeratu();
		$this->aktualizovat();
	}

	public function cron_zkontrolujInzeraty($mail = false){
		$this->zkontrolujInzeraty();
		if(count($this->nove_inzeraty_objects) > 0){
			$this->db_nove_inzeraty_pocet = count($this->nove_inzeraty_objects);
			if($mail){
				$this->mailInfo();
			}
		}
	}

	public function mailInfo(){

		$uzivatel = $this->getSubobject('uzivatel');

		Tools::sendMail(
			$uzivatel->db_email,
			"Hlídací pes",
			"watchdogInfo",
			array("pocetNovychInzeratu" => $this->db_nove_inzeraty_pocet, "link" => home_url())
		);
	}

	public function obnovInzeraty(){
		foreach ($this->nove_inzeraty_objects as $key => $value){
			$this->posledni_inzeraty_objects[] = $value;
		}
		$this->transformujPosledniInzertyNaIdcka();
		$this->db_nove_inzeraty_pocet = 0;
		$this->db_posledni_zobrazeni = time();
		$this->aktualizovat();
	}

	function transformujPosledniInzertyNaIdcka(){
		$posledni_inzeraty_save = array();
		foreach ($this->posledni_inzeraty_objects as $key => $value){
			$posledni_inzeraty_save[] = $value->getId();
		}
		$this->db_posledni_inzeraty = $posledni_inzeraty_save;
		return $posledni_inzeraty_save;
	}


	public function nastavFiltr($filtr_arr){
		/*if(is_array($filtr_arr)){

			$filtr_arr = array_filter($filtr_arr, function ($value, $key){
				return (get_class($value) == 'filterClass');
			},ARRAY_FILTER_USE_BOTH);

			$this->db_nastaveni_filtru = $filtr_arr;
		}*/
		$filters_to_save = array();
		if(is_array($filtr_arr)){
			foreach ($filtr_arr as $key => $value){
				$name = $value['name'];
				$new_key = str_replace("db_","",$name);
				$filters_to_save[] = new filterClass($new_key, $value["operator"], "'" . $value['value'] . "'");
			}
		}
		$this->db_nastaveni_filtru = $filters_to_save;
		$this->aktualizovat();

		return false;
	}

	public function zobrazInzeraty(){
		$this->zkontrolujInzeraty();
		return $this->zakladniVypis();
	}


	protected function zakladniVypis() {
		$html = "";
		if($this->db_nove_inzeraty_pocet > 0){
			$html .= "<h2>Nové inzeráty</h2>";
			$html .= $this->vypisNoveInzeraty();
		}
		if(count($this->posledni_inzeraty_objects) > 0){
			$html .= "<h2>Staré inzeráty</h2>";
			$html .= $this->vypisStareInzeraty();
		}
		return $html;
	}

	public function vypisNoveInzeraty(){
		$html = "";
		$walker = new assetWalkerClass(
			"inzeratClass",
			"nem_item.php",
			1,
			6,
			'div',
			'row',
			true,
			'top',
			"DESC",
			$this->nove_inzeraty_objects

		);
		$html .= $walker->walk(false);
		return $html;
	}

	public function vypisStareInzeraty(){

		$html = "";
		$walker = new assetWalkerClass(
			"inzeratClass",
			"nem_item.php",
			1,
			6,
			'div',
			'row',
			true,
			'top',
			"DESC",
			$this->posledni_inzeraty_objects

		);
		$html .= $walker->walk(false);
		return $html;
	}

	protected function zakladniHtmlVypis() {

	}

	public function getTableName() {
		return "s7_hlidacipes";
	}

	public static function setupDog($data, $user){
		$jmeno_psa = $data['name'];
		$filters = $data['filters'];
		$type = $data['type'];


		$hlidacipes = assetsFactory::createEntity("hlidacipesClass",array(
			'jmeno_psa' => $jmeno_psa,
			'posledni_inzeraty' => array(),
			'nastaveni_filtru' => array(),
			'uzivatel_id' => $user->getId(),
			'premium' => $type
		));
		$hlidacipes->nastavFiltr($filters);
		$hlidacipes->cron_zkontrolujInzeraty();
		return $hlidacipes;
	}
}