<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of assetsFactory
 *
 * @author Uzivatel
 */
class assetsFactory {

    // runtime zásobník
    public static $entites = array();

    public static function getEntity($className, $id, $wp_mysql_object=NULL){

        // overi zda jiz entita nebyla pouzita
        if(isset(self::$entites[$className][$id])){
            return self::$entites[$className][$id];
        }

        // pokud entita nebyla pouzita pokusi se ji natahnout z DB a vrátit
        if(class_exists($className)){
            $entita = new $className($id);

            if(is_subclass_of($entita, "zakladniKamenClass")){
                if($entita->nactiSe($wp_mysql_object)){
                    self::$entites[$className][$id] = $entita;
                    return $entita;
                }
                // pokud nactiSe vrati false nedoslo k nacteni vracim false
                return false;
            }else{
                trigger_error("Tato třída neimplementuje zakladniKamenClass: getEntity");
            }
        }else{
            trigger_error("Uvedená třída neexistuje: getEntity");
        }
        return false;
    }



    public static function getAllEntity($className, $filter=NULL, $offset=false, $countpage=false, $filterOR=FALSE, $orderby="ORDER BY id DESC"){
        global $wpdb;
	    $tableName = "";
	    if(class_exists($className)){
	    	$pom = new $className(-1);
	    	$tableName = $pom->getTableName();
	    	unset($pom);
	    	if(strlen($tableName)==0){
	    		trigger_error("getAllEntity:: tato třída nemá správně vyplněný tableName ve funkci getTableName");
	    		return false;
		    }
	    }else{
	    	trigger_error("getAllEntity:: tato třída v systému neexistuje");
	    	return false;
	    }

        $table = $tableName;
        $finalFilter = "";
        if($filter && count($filter) > 0){
			$finalFilter = self::processFilter($filter, $filterOR);
        }
        $limit = "";
        if($offset!==false && Tools::fieldChecker($offset, "number") && $countpage!==false && Tools::fieldChecker($countpage, "number")){
            $limit = 'LIMIT ' . $countpage . ' OFFSET ' . $offset;
        }
        $query = "SELECT * FROM " . $table . " " . $finalFilter . " " . $orderby . " " . $limit;
        //echo $query . "\n";
        $results = $wpdb->get_results($query);
        $pole = array();
        foreach ($results as $key => $value) {
            $pole[$value->id] = self::getEntity($className, $value->id, $value);
        }
        return $pole;

    }

	public static function getAllEntityCount($className, $filter = NULL, $filterOR=FALSE){
		global $wpdb;
		$tableName = "";
		if(class_exists($className)){
			$pom = new $className(-1);
			$tableName = $pom->getTableName();
			unset($pom);
			if(strlen($tableName)==0){
				trigger_error("getAllEntity:: tato třída nemá správně vyplněný tableName ve funkci getTableName");
				return false;
			}
		}else{
			trigger_error("getAllEntity:: tato třída v systému neexistuje");
			return false;
		}

		$table = $tableName;
		$finalFilter = "";
		if($filter && count($filter) > 0){
			$finalFilter = self::processFilter($filter, $filterOR);
		}

		$result = $wpdb->get_var("SELECT count(id) FROM " . $table . " " . $finalFilter . " ");

		return $result;
	}

	private static function processFilter($filter,$filterOR){
		$index = 1;
		$finalFilter = " WHERE ";
		foreach ($filter as $key => $value){
			if($value instanceof filterClass){
				$finalFilter .= $value->createCondition();
			}
			if($index != count($filter)){
				if($filterOR){
					$finalFilter .= ' OR ';
				}else{
					$finalFilter .= ' AND ';
				}
			}
			$index++;
		}

		return $finalFilter;
	}

    public static function createEntity($className, $arrayOfParams){

        // založí entitu
        $entity = new $className(-1);

        // populuje celou entitu podle parametrů
        $entity->populateClass($arrayOfParams);

        // entitu vytvoří
        $entity->vytvorit();

        //entitu uloží do zásobníku
        self::$entites[$className][$entity->getId()] = $entity;

        // vrátí entitu pro zpracování
        return $entity;
    }

    public static function removeEntity($className, $entity_or_id){

        // v případě že parametr je objekt
        if(is_object($entity_or_id) && $entity_or_id instanceof $className){
            // overi zda je surovina v zásobníku a pokud ano pokusí se jí smazat z DB a ze zásobníku
            $id = $entity_or_id->getId();
            if(isset(self::$entites[$className][$id])){
                $entity_or_id->smazat();
                unset(self::$entites[$className][$id]);
                return true;
            }else {
                return $entity_or_id->smazat();
            }
        }

        // v případě že parametr je ID
        if(is_numeric($entity_or_id)){
            // overi zda je surovina v zásobníku a pokud ano pokusí se jí smazat z DB a ze zásobníku
            $id = $entity_or_id;
            if(isset(self::$entites[$className][$id])){
                self::$entites[$className][$id]->smazat();
                unset(self::$entites[$className][$id]);
                return true;
            }

            // pokud surovina v zásobníku není tak jí načte a smaže
            $entity = new $className($id);
            if($entity->nactiSe()){
                return $entity->smazat();
            }
        }

        // pokud nactiSe vrati false nedoslo k nacteni vracim false
        return false;
    }


    public static function getDial($classname, $propname, $value){
    	$domainFilter = new filterClass('domain', '=',"'" . $classname . "'");
    	$propFilter = new filterClass('property', '=',"'" . $propname . "'");
    	$valueFilter = new filterClass('value', '=', $value);
    	$filters = array($domainFilter, $propFilter, $valueFilter);
    	$translation = self::getAllEntity("ciselnikClass",$filters);
    	if(is_array($translation) && count($translation)==1){
    		return array_shift($translation);
	    }else{
    		//trigger_error("getDial:: neočekávaný výsledek z DB");
    		return false;
	    }
	}

	public static function getAllDials($classname, $propname){
		$domainFilter = new filterClass('domain', '=',"'" . $classname . "'");
		$propFilter = new filterClass('property', '=',"'" . $propname . "'");
		$filters = array($domainFilter, $propFilter);
		$translation = self::getAllEntity("ciselnikClass",$filters);
		if(is_array($translation) && count($translation)>0){
			return $translation;
		}else{
			return array();
		}
	}










    
}
