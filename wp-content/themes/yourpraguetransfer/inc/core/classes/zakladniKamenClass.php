<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of zkladniKamenClass
 *
 * @author Uzivatel
 */
abstract class zakladniKamenClass implements manipulationInterface, JsonSerializable {
    
    // db vars, vždy mají prefix db_
    protected $db_id;
    protected $db_datum_zalozeni;
    protected $db_datum_upravy;
    
    
    // runtime vars, jsou určeny pouze k běhu applikace a nikam se neeukládají
    private $tableName;
    private $empty;
    private $ignoreInterface;
    private $valid;
    
    private $maskProperties; // vlastnosti které mají být maskovány
    private $maskTable; // tabulka ze k teré mají být dohledávány a ukládány náhradní vlastnosti
    private $maskingContextColumn; // název sloupce v maskovacíTabulce podle, kterého má být maskováno
    private $maskingContextValue; // hodnota sloupce v maskovacíTabulce podle, které má být provedena maska
    private $maskingJoinColumn; // název sloupce přes který se má vyhledávat maska - vazba na ID

	private $subobjects; // proměnná sloužící k automatickému načítání struktur, které jsou k objektu přiřazené pomocí vazeb
	private $forceNotUpdate;
    
    /*
     * Konstruktor základního Kamene
     */
    public function __construct($id) {
        $this->db_id = $id;
        $this->db_datum_zalozeni = time();
        $this->db_datum_upravy = time();
        $this->tableName = $this->getTableName();
        $this->subobjects = array();
        
        $this->maskProperties = array();
        $this->maskTable = NULL;
        $this->maskingContextValue = NULL;
        $this->maskingContextColumn = NULL;
        $this->maskingJoinColumn = NULL;
        $this->ignoreInterface = false;
        $this->valid = true;
        $this->forceNotUpdate = false;
        
        if( $id > -1 ){
            $this->empty = true;
        }else {
            $this->empty = false;
        }
        
    }

    /*
     * Metoda pro smazání objektu, smazaný objekt má všechny VARs nastaveny na NULL a empty na true
     * Pokud dojde ke smazání vrací true, pokud ne vrací false a vyhodí chybu
     */
    public function smazat() {
       if($this->maskTable){
           trigger_error("Maskovaný produkt nelze odstranit :: smazat");
           return false;
       }
       global $wpdb;
       $result = $wpdb->delete(
               $this->tableName,
               array(
                   "id" => $this->db_id
                       )
               );
       
       if($result !== false){
           $properties = get_object_vars($this);
           foreach ($properties as $key => $value) {
               $this->$key = null;
           }
           $this->empty = true;
           return true;
       }else {
           trigger_error("Něco se pokazilo při odstraňování objektu :: smazat");
           return false;
       }
    }

    /*
     * Metoda pro změnu objektu
     * změní data v databázi tzn že data a objekt budou zrcadlo
     * Vrací buď true v případě úspěchu nebo false a chybu v případě neúspěchu
     */
    public function aktualizovat() {
        global $wpdb;
        $this->db_datum_upravy = time();
        $db_properties = $this->vratDbPromenne();

        if(!$this->valid){
        	trigger_error("Některé z položek třídy jsou nevalidní, tudíž nelze uložit");
        	return false;
        }

        $result = $wpdb->update(
            $this->tableName,
            $db_properties,
            array( "id" => $this->db_id)
        );
        if(!$this->ulozDoMasky()){
            //trigger_error("Při změně masky nastala chyba :: aktualizovat");
            return false;
        }
        if($result > 0 ){
            return true;
        }elseif ($result === 0) {
            return true;
        }else {
            trigger_error("Něco se pokazilo při změně objektu :: aktualizovat");
            return false;
        }
        
    }
    
    
    /*
     * Pokud má instance id = -1 je počítáno, že objekt bude zakládán, instance všechny své db proměnné
     * vloží do databáze a nastaví si odpovídající ID
     * Pokud vše vyjde vrací true, pokud se něco pokrací vrací false a vyhazuje chybu
     */
    public function vytvorit(){
        if($this->maskTable){
            trigger_error("Maskovaný produkt nelze vytvořit :: vytvorit");
            return false;
        }
        
        global $wpdb;
        $db_properties = $this->vratDbPromenne();

	    if(!$this->valid){
		    trigger_error("Došlo k chybám ve validaci vstupních promměných");
	    	return false;
	    }
                
        unset($db_properties["id"]);
        
        if($this->db_id==-1 && count($db_properties) > 0){
            $isOk = $wpdb->insert(
                    $this->tableName,
                    $db_properties
            );
            $this->db_id = $wpdb->insert_id;
            $this->empty = false;
            if($isOk){
                return true;
            }else {

                trigger_error("Nepodařilo se vložit objekt :: vytvorit");
            }
        }else {
            trigger_error("Objekt není určen k založení :: vytvorit");
            return false;
        }
    }
    
    /*
     * Funkce načte všechny DB proměnné z databáze do instance objektu,
     * objet je v tu chvíli obrazem databáze
     * v případě že nalezne záznam s id naplní objekt a vrací true
     * v případě že nenalezne záznam s id vrací false a vyhazuje chybu
     */
    public function nactiSe($wp_mysql_object = NULL){
        if($this->maskTable){
            trigger_error("Maskovaný produkt nelze načíst :: nactiSe");
            return false;
        }
        
        global $wpdb;
        if($this->empty === true){
            if($wp_mysql_object){
                $results = $wp_mysql_object;
            }else{
                $results = $wpdb->get_row("SELECT * FROM $this->tableName WHERE id=$this->db_id");
            }


            if($results != NULL){
                foreach ($results as $key => $value) {
                    $objectProperty = "db_" . $key;
                    
                    // pokud je proměnná serializovaná musíme ji deserializovat
	                //echo var_dump($value) . "<br>";
	                //echo var_dump(maybe_unserialize($value)) . "<br>";
                    $this->$objectProperty = maybe_unserialize($value);

                }
                return true;
            }else {

                trigger_error("Objekt s tímto ID nebyl v systému nalezen :: nactiSe");
                return false;
            }
        }
        return false;
    }
    
    
    
    /*
     * Funkce která vrací proměnné, které jsou určené k nahrávání do DB (mají prefix _db)
     */
    public function vratDbPromenne(){
        $all_properties = get_object_vars($this);
        $db_properties = array();
        foreach ($all_properties as $key => $value) {
            if(preg_match('/^db_.+$/m', $key)){
                $newkey = explode("db_", $key)[1];
                $newvalue = $value;
                if(is_array($newvalue)){
                    $newvalue = maybe_serialize($newvalue);
                }
                $db_properties[$newkey] = $newvalue; 
            }
        }


        if(!is_null($this->maskProperties)){
	        foreach ($this->maskProperties as $key => $value) {
	            if(isset($db_properties[$value])){
	                unset($db_properties[$value]);
	            }
	        }
        }
        return $db_properties;
    }


    /*
     * magic set
     */
    public function __set($name, $value) {
    	if(isset($value) && isset($name)){
	        if($this->valid) {
		        $this->valid = $this->checkValidity( $name, $value );
	        }
        	$this->$name = $value;
	        if(!$this->forceNotUpdate){

                return $this->aktualizovat();
	        }
        }
        
    }

    /*
     * Set který neukládá hned do databáze, hodí se např pro nastavení mnoha proměných a pak až následné dávkové uložení do DB
     */
    public function set_not_update($name, $value) {

        if(isset($value) && isset($name)){
        	if($this->valid){
	            $this->valid = $this->checkValidity($name, $value);
	        }
	        $this->$name = $value;
        }
        
    }
    
    /*
     * magic get
     */
    public function __get($name) {
        return $this->$name;
    }

    /*
     * Get pro subobjekty
     */
    public function getSubobject($name){

	    if(isset($this->subobjects[$name])){
		    return $this->subobjects[$name];
	    }else{
		    return $this->loadRelatedObjects($name . "Class");
	    }

    }
    
    /*
     * vrací ID
     */
    public function getId(){
        return $this->db_id;
    }
    

    /*
     * tato metoda by měla umět nastavit masku pro daný objekt, tím pádem některé zvolené
     * db proměnné se nevytahují z původní tabulky ale z masky, objekt pak i ukládá 
     * zvolené db proměnné do masky a ne do produktu, tím pádem se neovliní původní produkt
     * zbylé vlastnosti objekt ukládá na původní místa a tím ovlivnuje původní produkt
     * přijímá argumenty formou pole které specifikuje maskované db_proměnné a dále maskující
     * tabulku kde má tyto data hledat v závislosti na vlasním ID
     * maska přenačte právě zmíněné hodnoty
     */
    public function registrovatMasku($maskProperties, $maskTable, $maskingContextColumn, $maskingContextValue, $maskingJoinColumn){
        if(is_array($maskProperties) && is_string($maskTable) && is_string($maskingContextColumn) && isset($maskingContextValue) && isset($maskingJoinColumn)){
            $this->maskProperties = $maskProperties;
            $this->maskTable = $maskTable;
            $this->maskingContextColumn = $maskingContextColumn;
            $this->maskingContextValue = $maskingContextValue;
            $this->maskingJoinColumn = $maskingJoinColumn;
        }else {
            return false;
            trigger_error("Masku se nepodařilo zaregistrovat, špatné parametry :: registrovatMasku");
        }
        global $wpdb;
        $whatSelect = implode(",", $maskProperties);
        $result = $wpdb->get_row(
                "SELECT " . $whatSelect . 
                " FROM " . $maskTable . 
                " WHERE " . $maskingContextColumn . " = " . $maskingContextValue .
                " AND " . $maskingJoinColumn . " = " . $this->getId(), ARRAY_A);
        if($result == NULL){
            trigger_error("Pozor maska nemá v DB svůj odpovídající spoj na entitu :: registrovaMasku");
            return true;
        }
        foreach ($result as $key => $value){
            if($value != NULL){
                $localName = "db_". $key;
                $this->$localName = $value;
            }
        }
    }
    
    
    /*
     * Odstraní masku tzn, zvolené proměné již nejsou maskované a je upravován původní objekt
     */
    public function odstranitMasku(){
        $this->maskProperties = array();
        $this->maskTable = "";
        $this->maskingContextColumn = "";
        $this->maskingContextValue = "";
        $this->maskingJoinColumn = "";
    }
    
    /*
     * Maska slouží k zamaskování některých proměných
     * které se se přebírají z jiné, více specifické tabulky
     * Maskovací tabulka je proměná maskTable a specifikuje se metodou registrovatMasku
     * Maskovací tabulka se skládá z maskingContextColumn a MaskingJoinColum a dalších maskovaných properties
     * maskingContextColumn a maskingContextValue specifikuje vztah k nějaké konkrétní entitě a její konkrétní ID
     * maskigJoinColumn specifikuje že se jedná o konkrétní entitu
     * metoda ověří zda jde maska nastavená a pokud ano začne pracovat s maskProperties(maskované hodnoty)
     * Zjistí zda již nějaké maskování je, pokud ano tak ho aktualizuje
     * pokud ne tak vytvoří nový maskovací záznam
     */
    protected function ulozDoMasky(){
        if(is_string($this->maskTable) && $this->maskingContextValue && is_string($this->maskingJoinColumn) && is_string($this->maskingContextColumn) ){
            global $wpdb;
            $tosave = array();
            foreach ($this->maskProperties as $key => $value) {
                $localName = "db_". $value;
                if(isset($this->$localName)){
                    $tosave[$value] = $this->$localName;
                }
            }
            if(is_array($tosave) && count($tosave)>0){
                
                $result = $wpdb->get_row(
                        "SELECT * " .
                        " FROM " . $this->maskTable . 
                        " WHERE " . $this->maskingContextColumn . " = " . $this->maskingContextValue .
                        " AND " . $this->maskingJoinColumn . " = " . $this->getId(), ARRAY_A);
                if($result == NULL){
                    $tosave[$this->maskingContextColumn] = $this->maskingContextValue;
                    $tosave[$this->maskingJoinColumn] = $this->getId();
                    $result = $wpdb->insert(
                        $this->maskTable,
                        $tosave
                    );
                    
                    if($result!==false){
                        return true;
                    }
                    trigger_error("Nepodařilo se vytvořit maskovací záznam :: ulozDoMasky");
                    return false;
                    
                }else {
                    $result = $wpdb->update(
                        $this->maskTable,
                        $tosave,
                        array( $this->maskingContextColumn => $this->maskingContextValue, $this->maskingJoinColumn => $this->getId())
                    );
                    if($result === false){
                        return false;
                    }
                    
                    return true; 
                }
                

            }
            return true;
        }
        //trigger_error("Maska není správně nastavená :: ulozDoMasky");
        return false;

        
    }

    /*
     * vrací ošetřená data z entity
     */
    public function dejData($property){
        if(property_exists($this, $property)){
            return htmlentities($this->$property);
        }else {
            trigger_error("Pozor taková hodnota v rámci třídy neexistuje :: dejData");
        }
    }
    
    /*
     * vrací jakou tabulkou je entita maskována
     */
    public function dejMasku(){
        return $this->maskTable;
    }
    
     /*
     * vrací skrze jakou hodnotu je tento objekt maskován
     */
    public function dejContextId(){
        return $this->maskingContextValue;
    }
    
    /*
     * nastaví entitě že má ve svém JSON outputu ignorovat nastavení políček v configuration.php 
     */
    public function ignoreInterface(){
        $this->ignoreInterface = true;
    }


    /*
     * serializuje data z objektu
     * filtruje db_properties které by se měli v rámci entity dodat v JSON formátu
     * následně je předá ke spracování do json_encode 
     * je možné také zablokovat speciální předávání na základně configuration.php
     * pomocí ignoreInterface proměnné
     */
    public function jsonSerialize() {
        $all_properties = get_object_vars($this);
        $db_properties = array();
        
        foreach ($all_properties as $key => $value) {
            if(preg_match('/^db_.+$/m', $key)){
                $newkey = $key;
                $newvalue = $value;
                $db_properties[$newkey] = $newvalue; 
            }
        }


        /*if(!$this->ignoreInterface){
            global $INTERFACE_DATA;
            if(isset($INTERFACE_DATA[get_class($this)])){

                $output = array();
                $interfaceData = $INTERFACE_DATA[get_class($this)];
                foreach ($interfaceData as $key => $value){
                    if(isset($db_properties[$key])){
                        $output[$value] = $db_properties[$key];
                    }else {
                        $output[$key] = $value;
                    }
                }
                return $output;
            }    
        }*/



        $interface = $this->getInterfaceTypes();
        $json_properties = array();

	    if($this->ignoreInterface){
			$json_properties = $all_properties;
	    }else{
	        foreach ($interface as $key => $val){
		        if(isset($db_properties[$key])){
			        $json_properties[$key] = array(
				        "value" => $db_properties[$key],
				        "type" => $val
			        );
		        }elseif(is_null($db_properties[$key])){
			        $json_properties[$key] = array(
				        "value" => '(hodnota nedostupná)',
				        "type" => $val
			        );
		        }
	        }
	    }


        
        return $json_properties;
        
    }


    public function populateClass($arrayOfParams){
        foreach ($arrayOfParams as $key => $value) {
        	if(strstr($key, "db_")==false){
                $new_key = "db_" . $key;
	        }else{
        		$new_key = $key;
	        }
            if(property_exists(get_class($this), $new_key)){
	            if($this->valid){
		            $this->valid = $this->checkValidity($new_key, $value);
	            }
                $this->$new_key = $value;
            }else{
                trigger_error("Zadaná vlastnost " . $new_key . " v třídě " . __CLASS__ . " neexistuje : populateClass");
            }
        }
    }

    private function checkValidity($key, $value){
		global $field_rules;
		$format = array();
		if(isset($field_rules[get_class($this)]) && isset($field_rules[get_class($this)][$key])){
			$format = $field_rules[get_class($this)][$key];
			$type = $format['type'];
			$required = $format['required'];
			$field_checker = new typeClass($key, $value, $required, $type);
			return $field_checker->getStatus();
		}else{
			trigger_error("checkValidity:: Formát není specifikovaný. Neověřuji : " . $key);
			return true;
		}

    }

    // metoda sloužící pro fulltext search, prohledá celý objekt (datové proměné a pokud nalezne shodu vrátí true)
    public function findMe($value){
    	$db_properties = $this->vratDbPromenne();
    	foreach ($db_properties as $key => $val){
    		if(strpos($val, $value)!== false){
    			return true;
		    }
	    }
    	return false;
    }

	/*
	 * Metoda vrací pole, která specifikují typy jednotlivých sloupečků a jak se mají zobrazit např v ajax datatable
	 * pořadí jednotlivých polí určuje pořadí i na samotném datatable. Metoda tyto data přebírá z konfigurace nicméně
	 * každá třída si ji může přepsat a vyspecifikovat
	 * array(
	 *  db_id => array(
	 *          "type" => INT,
	 *          "value" => 5
	 *      )
	 * )
	 */
	public function getInterfaceTypes(){
		global $field_rules;
		$classname = get_class($this);
		if(isset($field_rules[$classname])){
			$class_field_rules = $field_rules[$classname];
			if(is_array($class_field_rules)){
				$interface = array();
				foreach ($class_field_rules as $key => $val){
					if(property_exists($this, $key)){
						$interface[$key] = $val["type"];
					}
				}
				return $interface;
			}else{
				trigger_error("getInterfaceTypes:: Špatný formát specifikovaného interfacu");
				return array();
			}
		}else{
			trigger_error("getInterfaceTypes:: objekt nemá v konfiguraci specifikovaný interface");
			return array();
		}
	}


	// vrací zdali existují nějaké vztahy k danému objektu a o jaké se jedná
	protected function getRelations(){
		global $relationships;
		$classname = get_class($this);
		if(isset($relationships[$classname])){
			$relation = $relationships[$classname];
			return $relation;
		}
		return false;
	}

	// metoda která se pokusí na základě konfigurace vztahů natáhnout do objektu přidružené objekty, natahuje jak vztah 1:N tak vztah N:1
	public function loadRelatedObjects($objectName=false){
		$relations = $this->getRelations();
		if($objectName){
			if(is_array($relations)){
				$relations = array_filter($relations, function($obj,$key) use ($objectName){
					if(!$objectName){return true;}
					if($obj['class'] == $objectName){ return true;}
					return false;
				},ARRAY_FILTER_USE_BOTH);
			}
			if(is_array($relations) && count($relations)==1){
				$index = array_keys($relations);
				$index = array_shift($index);
				$key = $this->$index;

				$relation = array_shift($relations);
				$subObjKey = str_replace("class", "", $relation['class']);

				$children = assetsFactory::getEntity($relation['class'],$key);
				$this->subobjects[$subObjKey] = $children;
				return $children;
			}else {
				global $relationships;
				if(isset($relationships[$objectName])){
					$relations = array_filter($relationships, function($obj,$key) use ($objectName){
						if($key == $objectName){ return true;}
						return false;
					},ARRAY_FILTER_USE_BOTH);


					if(count($relations)==1){
						$relation = array_shift($relations);
						$key = array_keys($relation);
						$key = array_shift($key);
						$key = str_replace("db_","",$key);

						$filter = new filterClass($key,"=",$this->getId());
						$children = assetsFactory::getAllEntity($objectName, array($filter));

						$subObjKey = str_replace("class", "", $objectName);
						$this->subobjects[$subObjKey] = $children;
						return $children;
					}else{
						trigger_error("loadRelatedObjects:: pro zadaný název objektu nexistuje žádné pravidlo nebo jich existuje více");
					}
				}
			}
			return false;
		}

		if(is_array($relations)){
			foreach ($relations as $index => $value){
				if(property_exists($this, $index)){
					if(class_exists($value['class'])){
						$subObjKey = str_replace("class", "", $value['class']);
						$key = $this->$index;
						$this->subobjects[$subObjKey] = assetsFactory::getEntity($value['class'],$key);
					}
				}
			}
		}

		global $relationships;
		foreach ($relationships as $index => $value){
			$classname = get_class($this);
			$relations = array_filter($value, function($obj,$key) use ($classname){
				if($obj['class'] == $classname){ return true;}
				return false;
			},ARRAY_FILTER_USE_BOTH);

			if(count($relations)==1){

				$key = array_keys($relations);
				$key = array_shift($key);
				$key = str_replace("db_","",$key);

				$filter = new filterClass($key,"=",$this->getId());
				$children = assetsFactory::getAllEntity($index, array($filter));

				$subObjKey = str_replace("class", "", $index);
				$this->subobjects[$subObjKey] = $children;
			}
		}
		return true;
	}

	// metoda která překládá různé stav do hodnot přebraných z číselníků
	public function writeDials(){
		global $dials, $localDials;
		$classname = get_class($this);
		if(isset($dials[$classname])){
			$dials_new = $dials[$classname];

			foreach ($dials_new as $propname){
				if(property_exists($this,$propname)){
					$prop_name = str_replace("db_", "",$propname);
					$value = $this->$propname;
					if(!is_null($value)){
						$translation = assetsFactory::getDial($classname, $prop_name, $value);
						if($translation !== false){
							$this->set_not_update($propname, $translation->db_translation);
						}
					}
				}else{
					trigger_error("V konfiguraci je chyba, atribut číselníku objekt nemá");
				}
			}
		}elseif(isset($localDials[$classname])){
			$prop_names = $localDials[$classname];
			foreach ($prop_names as $key => $val){
				if(property_exists($this, $key)){
					$prop_value = $this->$key;
					if(isset($val[$prop_value])){
						$this->set_not_update($key, $val[$prop_value]);
					}
				}else{
					trigger_error("V konfiguraci je chyba, atribut číselníku objekt nemá");
				}
			}
		}
	}

	public function setForceNotUpdate(){
		$this->set_not_update("forceNotUpdate",true);
	}


	// predpis implementaci
    protected abstract function zakladniVypis();
    protected abstract function zakladniHtmlVypis();
    public abstract function getTableName();

}
