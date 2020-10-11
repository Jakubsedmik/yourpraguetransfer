<?php

$api_actions = array(
	'removeElement' => array(
		'callback' => 'removeElement',
		'private' => true
	),
	'getElements' => array(
		'callback' => 'getElements',
		'private' => true
	),
	'upload' => array(
		'callback' => 'uploadFile',
		'private' => true
	),
	'getEntityObrazky' => array(
		'callback' => 'getEntityObrazky',
		'private' => true
	),
	'setParam' => array(
		'callback' => 'setObrazkyParam',
		'private' => true
	),
	'removePic' => array(
		'callback' => 'removeObrazek',
		'private' => true
	),
    'getCarOffers' => array(
        'callback' => 'getCarOffers',
        'private' => false
    ),
    "checkCarPrice" => array(
        'callback' => 'checkCarPrice',
        'private' => false
    )
);



// registering apis
foreach ($api_actions as $key => $value){
	if(is_array($value)){
		if(function_exists($value['callback'])){
			if($value['private']){
				add_action("wp_ajax_" . $key, $value['callback']);
			}else{
				add_action("wp_ajax_" . $key, $value['callback']);
				add_action("wp_ajax_nopriv_" . $key, $value['callback']);
			}
		}else{
			trigger_error("Api.php :: zadaný callback neexistuje: " . $value['callback']);
		}
	}else{
		if(function_exists($value)){
			add_action("wp_ajax_" . $key, $value);
			add_action("wp_ajax_nopriv_" . $key, $value);
		}else{
			trigger_error("Api.php :: zadaný callback neexistuje");
		}
	}
}






// API FUNCTIONS DECLARATIONS


function removeElement (){

	// now shut down error reporting for a while
	error_reporting(0);
	ini_set('display_errors', 'Off');

	$response = new stdClass();
	if(Tools::checkPresenceOfParam("model", $_GET) && Tools::checkPresenceOfParam("id", $_GET)){
		$model = $_GET['model'];
		$id = $_GET['id'];
		$result = assetsFactory::removeEntity($model, $id);

		if($result){
			$response->status = 1;
			$response->message = __("Objekt byl odebrán","yourpraguetransfer");
		}else{
			$response->status = 0;
			$response->message = __("Nepodařilo se odebrat","yourpraguetransfer");
		}
	}else{
		$response->status = 0;
		$response->message = __("Chybějící vstupní data","yourpraguetransfer");
	}


	wp_send_json($response);
	die();
}


function uploadFile(){

	$response = Tools::uploadImage();
	if(Tools::checkPresenceOfParam("onlyupload",$_POST)){
		wp_send_json($response);
		die();
		return true;
	}

	if(is_object($response)){
		$universal_name = $response->universal_name;
		$default_url = $response->default_url;

		if(Tools::checkPresenceOfParam("id",$_POST)){
			$obrazek = assetsFactory::createEntity("obrazekClass", array(
				'url' => $default_url,
				'kod' => $universal_name,
				'entity_id' => $_POST['id'],
                'entity_class' => $_POST['entity_class']
			));
		}else{
			$obrazek = assetsFactory::createEntity("obrazekClass", array(
				'url' => $default_url,
				'kod' => $universal_name
			));
		}

		$response->db_id = $obrazek->getId();
	}
	wp_send_json($response);
	die();
}

function getElements (){
	global $dictionary;
	$allrequest = array_merge($_POST, $_GET);
	$result = Tools::postChecker(
		$allrequest,
		array(
			"model" => array(
				"type" => STRING,
				"required" => true
			),
			"page" => array(
				"type" => NUMBER,
				"required" => true
			),
			"countPage" => array(
				"type" => NUMBER,
				"required" =>true
			),
			"search" => array(
				"type" => STRING,
				"required" => false
			)
		)
	);

	if(is_array($result) && count($result) > 0){
		$response = new stdClass();
		$response->status = 0;
		$response->message = __("Některé parametry nebyli vyplněny","yourpraguetransfer");
		$response->description = $result;
		wp_send_json($response);
		die();
	}elseif (!is_array($result)){
		$response = new stdClass();
		$response->status = 0;
		$response->message = __("Nastala interní chyba","yourpraguetransfer");
		wp_send_json($response);
		die();
	}

	$model = $allrequest['model'];
	$page = $allrequest['page'];
	$count_page = $allrequest['countPage'];

	// todo mělo by to umět akceptovat i filtery
	$filters = array();
	foreach ($allrequest as $key => $value){
		if(property_exists($model, $key)){
			$new_key = str_replace("db_","", $key);
			$filters[$new_key] = $value;
		}
	}

	$dbFilters = array();
	$is_or = false;
	foreach ($filters as $key => $value){
	    if(strpos($value,"|") !== false){
	        $multipleFilter = explode("|",$value);
	        $is_or = true;
	        foreach ($multipleFilter as $filterIndex => $filterValue){
                $dbFilters[] = new filterClass($key, "=", $filterValue);
            }
        }else{
            $dbFilters[] = new filterClass($key, "=", $value);
        }
	}



	if(class_exists($model)){

		$page = $page-1;
		$offset = $count_page * $page;

		if(Tools::checkPresenceOfParam("search", $allrequest)){
			$search = $allrequest['search'];
			$items = assetsFactory::getAllEntity($model, $dbFilters,false, false, $is_or);

			$items = array_filter($items, function($obj, $index) use ($search){
				return $obj->findMe($search);
			},ARRAY_FILTER_USE_BOTH);
			$count = count($items);

			$items = array_slice($items, $offset, $count_page);

		}else{

			$items = assetsFactory::getAllEntity($model, $dbFilters, $offset, $count_page, $is_or);
			$count = assetsFactory::getAllEntityCount($model, $dbFilters, $is_or);

		}

		$newItems = array();
		foreach ($items as $val){
			$val->writeDials();
			$newItems[] = $val;
		}

		$response = new stdClass();
		$response->radky = $newItems;
		$response->prekladHlavicek = $dictionary;
		$response->totalRecords = $count;
		$response->status = 1;
		$response->message = __("Výsledky byli vráceny","yourpraguetransfer");
		wp_send_json($response);
		die();


	}else{
		$response = new stdClass();
		$response->status = 0;
		$response->message = __("Tento model v systému neexistuje","yourpraguetransfer");
		wp_send_json($response);
		die();
	}


}

function getEntityObrazky(){
	$response = new stdClass();
	if(Tools::checkPresenceOfParam("id", $_GET)){
		$id = $_GET['id'];
		$filter = array();
		$filter[] = new filterClass("entity_id","=", $id);
		$obrazky = assetsFactory::getAllEntity("obrazekClass",$filter);
		$response->status = 1;
		$response->obrazky = $obrazky;
	}else{
		$response->status = 0;
	}

	wp_send_json($response);
	die();
}

function setObrazkyParam(){
	$response = new stdClass();
	if(Tools::checkPresenceOfParam("id", $_POST) && Tools::checkPresenceOfParam("param", $_POST) && Tools::checkPresenceOfParam("new_value",$_POST)){
		$id = $_POST['id'];
		$param = $_POST['param'];
		$new_value = $_POST['new_value'];

		$obrazek = assetsFactory::getEntity("obrazekClass",$id);
		if($param == "db_front"){
			$filter = array();
			$entity_id = $obrazek->db_entity_id;
			$filter[] = new filterClass("entity_id", "=", $entity_id);
			$obrazky = assetsFactory::getAllEntity("obrazekClass",$filter);
			foreach ($obrazky as $key => $value){
				$value->db_front = 0;
			}
		}
		$obrazek->$param = $new_value;

		$response->status = 1;
		$response->message = __("Uloženo","yourpraguetransfer");
	}else{
		$response->status = 0;
		$response->message = __("Chybějící parametry","yourpraguetransfer");
	}
	wp_send_json($response);
	die();
}


function removeObrazek(){
	$response = new stdClass();
	if(Tools::checkPresenceOfParam("id", $_POST)){
		$id = $_POST['id'];
		$result = assetsFactory::removeEntity("obrazekClass",$id);
		if($result){
			$response->status = 1;
			$response->message = __("Smazáno","yourpraguetransfer");
		}else{
			$response->status = 0;
			$response->message = __("Došlo k chybě při mazání","yourpraguetransfer");
		}
	}else{
		$response->status = 0;
		$response->message = __("Chybějící parametry","yourpraguetransfer");
	}
	wp_send_json($response);
	die();
}


function getCarOffers(){

    // now shut down error reporting for a while
    error_reporting(0);
    ini_set('display_errors', 'Off');

    /* GETTING REQUEST DATA */
    $request_body = file_get_contents('php://input');
    $data = json_decode($request_body, true);

    /* */
    $response = new stdClass();

    $persons = 1;


    if(Tools::checkPresenceOfParam("from_lat_lng", $data) && Tools::checkPresenceOfParam("to_lat_lng",$data)){
        $from_lat_lng = $data['from_lat_lng'];
        $to_lat_lng = $data['to_lat_lng'];


        // zjisti zdali některý z bodů spadá na letiště a který nespadá
        $airport = zonaClass::isVertexOnAirport(array($from_lat_lng, $to_lat_lng));

        // pokud některý z bodu spadá do letištní zóny nastavili jsme destination jako finální bod
        if(count($airport->notBelongToAirport)>0 && count($airport->belongToAirport)>0){
            $destination = array_pop($airport->notBelongToAirport);

            // zjistíme zdali daná destinace spadá do některé
            $destination_zone = zonaClass::isVertexInZones($destination);

            if($destination_zone!== false){

                // získám ze zóny všechny ceníky které mají zahrnutou zónu v sobě a jsou seřazené od nejlevnějšího po nejdražší
                $ceniky = $destination_zone->getCeniky();

                $vozidla = array();

                // k ceníkům a najedeme vozidla, ty zakládáme do pole a připojujeme k ním ceny z ceníků
                foreach ($ceniky as $key => $value){

                    $cena_tam = $value->db_cena_tam;
                    $cena_zpet = $value->db_cena_zpet;
                    $max_osob = $value->db_max_osob;
                    $min_osob = $value->db_min_osob;

                    if($min_osob <= $persons){
                        $vozidlo = $value->getSubobject("vozidlo");
                        $vozidlo->setForceNotUpdate();
                        $vozidlo->set_not_update("db_cenik_cena_tam",$cena_tam);
                        $vozidlo->set_not_update("db_cenik_cena_zpet",$cena_zpet);

                        if($vozidlo->db_max_osob >= $persons){
                            // u vozidel však musíme kontrolovat zdali již není v seznamu pokud ano, záznam zaměníme pouze pokud je cena vyšší jinak necháme
                            if(isset($vozidla[$vozidlo->getId()])){
                                $old_vozidlo = $vozidla[$vozidlo->getId()];
                                if($old_vozidlo->db_cena_tam < $vozidlo->db_cena_tam){
                                    $vozidla[$vozidlo->getId()] = $vozidlo;
                                }
                            }else{
                                $vozidla[$vozidlo->getId()] = $vozidlo;
                            }
                        }

                    }

                }

                // je třeba vylistovat zbylá auta která nebyli v zóně, protože pro ně stanovíme cenu dle KM, pokud již je vůz v poli tak nepřidáváme, cena zóny má přednost
                $vozidla_dalsi = assetsFactory::getAllEntity("vozidloClass");
                foreach ($vozidla_dalsi as $key => $value){
                    if(!isset($vozidla[$value->getId()]) && $value->db_max_osob >= $persons){
                        $vozidla[$value->getId()] = $value;
                    }
                }

                $response = new stdClass();
                $response->cars = $vozidla;


                $response->status = 1;
                $response->message = "Zvýhodněné ceny nalezeny";
            }else{
                // pokud zóny nesedí vylistujeme všechny auta a dáme ceny za km
                $vozidla = assetsFactory::getAllEntity("vozidloClass");
                foreach ($vozidla as $key => $value){
                    $value->set_not_update('db_letistni_transfer', false);
                }
                $response->cars = $vozidla;
                $response->status = 1;
                $response->message = "Žádná z destinací nespadá do zóny, zobrazuji klasickou kilometráž";
            }

        }else{
            // pokud nesedí letiště vylistujeme všechny auta a dáme ceny za km
            $vozidla = assetsFactory::getAllEntity("vozidloClass");
            foreach ($vozidla as $key => $value){
                $value->set_not_update('db_letistni_transfer', false);
            }
            $response->cars = $vozidla;
            $response->status = 1;
            $response->message = "Žádná z destinací není letiště, zobrazuji klasickou kilometráž";
        }

    }else{
        $response->status = 0;
        $response->message = "Chybějící parametry";
    }

    if(property_exists($response, "cars")){
        foreach ($response->cars as $key => $value){
            $value->getSubobject("obrazek");
            $value->writeDials();
            $value->ignoreInterface();
        }
    }

    $response->cars = array_values($response->cars);

    wp_send_json($response);
    die();
}


function checkCarPrice(){
    // now shut down error reporting for a while
    error_reporting(0);
    ini_set('display_errors', 'Off');

    /* GETTING REQUEST DATA */
    $request_body = file_get_contents('php://input');
    $data = json_decode($request_body, true);

    /* */
    $response = new stdClass();

    if(
        Tools::checkPresenceOfParam("selected_offer", $data) &&
        Tools::checkPresenceOfParam("destination_from", $data) &&
        Tools::checkPresenceOfParam("destination_to", $data) &&
        Tools::checkPresenceOfParam("persons", $data) &&
        Tools::checkPresenceOfParam("distance", $data) &&
        Tools::checkPresenceOfParam("duration", $data) &&
        Tools::checkPresenceOfParam("currency", $data) &&
        isset($data["selected_way_option"])
        ){

        $selected_offer = $data['selected_offer'];
        $destination_from = $data['destination_from'];
        $destination_to = $data['destination_to'];
        $persons = $data['persons'];
        $selected_way_option = $data['selected_way_option'];
        $duration = $data['duration'];
        $distance = $data['distance'];
        $currency = $data['currency'];


        $car_id = $selected_offer['db_id'];

        $response = vozidloClass::calculateComplexPrice($car_id, $destination_from, $destination_to, $persons, $selected_way_option, $duration, $distance, $currency);

    }else{
        $response->status = 0;
        $response->message = "Chybějící parametry";
    }

    wp_send_json($response);
    die();

}