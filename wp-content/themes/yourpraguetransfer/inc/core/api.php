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
	'getInzeratObrazky' => array(
		'callback' => 'getInzeratObrazky',
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
	'googleVerification' => array(
		'callback' => 'googleVerification',
		'private' => false
	),
	'checkUserExists' => array(
		'callback' => 'checkUserExists',
		'private' => false
	),
	'checkUserExistsAdvanced' => array(
		'callback' => 'checkUserExistsAdvanced',
		'private' => false
	),
	'getInzeraty' => array(
		'callback' => 'getInzeraty',
		'private' => false
	),
	'changeUserAvatar' => array(
		'callback' => 'changeUserAvatar',
		'private' => false
	),
	'removeInzerat' => array(
		'callback' => 'removeInzerat',
		'private' => false
	),
	'changeInzeratStatus' => array(
		'callback' => 'changeInzeratStatus',
		'private' => false
	),
	'createInzeratImages' => array(
		'callback' => 'createInzeratImages',
		'private' => false
	),
	'removeWatchdog' => array(
		'callback' => 'removePes',
		'private' => false
	),
	'createWatchdog' => array(
		'callback' => 'createWatchdog',
		'private' => false
	),
	'checkUserCredits' => array(
		'callback' => 'checkUserCredits',
		'private' => false
	),
	'payForService' => array(
		'callback' => 'payForService',
		'private' => false
	),
	'payForContact' => array(
		'callback' => 'payForContact',
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
			$response->message = __("Objekt byl odebrán","realsys");
		}else{
			$response->status = 0;
			$response->message = __("Nepodařilo se odebrat","realsys");
		}
	}else{
		$response->status = 0;
		$response->message = __("Chybějící vstupní data","realsys");
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
				'inzerat_id' => $_POST['id']
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
		$response->message = __("Některé parametry nebyli vyplněny","realsys");
		$response->description = $result;
		wp_send_json($response);
		die();
	}elseif (!is_array($result)){
		$response = new stdClass();
		$response->status = 0;
		$response->message = __("Nastala interní chyba","realsys");
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
	foreach ($filters as $key => $value){
		$dbFilters[] = new filterClass($key, "=", $value);
	}



	if(class_exists($model)){

		$page = $page-1;
		$offset = $count_page * $page;

		if(Tools::checkPresenceOfParam("search", $allrequest)){
			$search = $allrequest['search'];
			$items = assetsFactory::getAllEntity($model, $dbFilters);

			$items = array_filter($items, function($obj, $index) use ($search){
				return $obj->findMe($search);
			},ARRAY_FILTER_USE_BOTH);
			$count = count($items);

			$items = array_slice($items, $offset, $count_page);

		}else{

			$items = assetsFactory::getAllEntity($model, $dbFilters, $offset, $count_page);
			$count = assetsFactory::getAllEntityCount($model, $dbFilters);

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
		$response->message = __("Výsledky byli vráceny","realsys");
		wp_send_json($response);
		die();


	}else{
		$response = new stdClass();
		$response->status = 0;
		$response->message = __("Tento model v systému neexistuje","realsys");
		wp_send_json($response);
		die();
	}


}

function getInzeratObrazky(){
	$response = new stdClass();
	if(Tools::checkPresenceOfParam("id", $_GET)){
		$id = $_GET['id'];
		$filter = array();
		$filter[] = new filterClass("inzerat_id","=", $id);
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
			$inzerat_id = $obrazek->db_inzerat_id;
			$filter[] = new filterClass("inzerat_id", "=", $inzerat_id);
			$obrazky = assetsFactory::getAllEntity("obrazekClass",$filter);
			foreach ($obrazky as $key => $value){
				$value->db_front = 0;
			}
		}
		$obrazek->$param = $new_value;

		$response->status = 1;
		$response->message = __("Uloženo","realsys");
	}else{
		$response->status = 0;
		$response->message = __("Chybějící parametry","realsys");
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
			$response->message = __("Smazáno","realsys");
		}else{
			$response->status = 0;
			$response->message = __("Došlo k chybě při mazání","realsys");
		}
	}else{
		$response->status = 0;
		$response->message = __("Chybějící parametry","realsys");
	}
	wp_send_json($response);
	die();
}


function googleVerification(){
	$response = new stdClass();
	$result = Tools::postChecker(
		$_POST,
		array(
			"email" => array(
				"type" => EMAIL,
				"required" => true
			),
			"gid" => array(
				"type" => STRING,
				"required" => true
			),
			"token" => array(
				"type" => STRING,
				"required" => true
			)
		),
		true
	);
	if($result){

		$email = $_POST['email'];
		$gid = $_POST['gid'];
		$token = $_POST['token'];

		$uzivatel = assetsFactory::getAllEntity(
			"uzivatelClass",
			array(
				new filterClass("email","=","'" . $email . "'"),
				new filterClass("gmid", "=","'" . $gid . "'")
			),
			false,
			false,
			true
		);
		if(is_array($uzivatel) && count($uzivatel) == 0){
			$response->status = 1;
			$response->message = __("Uživatel neexistuje","realsys");
		}else{

			$verificationArray = array(
				"email" => $_POST['email'],
				"sub" => $_POST['gid']
			);

			$payload = Tools::googleTokenVerification($token, $verificationArray);
			if($payload){

				$response->status = 0;
				$response->message = __("Tento uživatel již existuje","realsys");
				$uzivatel = array_shift($uzivatel);
				$uzivatel->logIn();

				ob_start();
				/* TODO prozatímní redirect na přidání inzerátu, po spuštění musí být na profil */
				Tools::jsRedirect(Tools::getFERoute("inzeratClass",false, "add"),1500);

				//Tools::jsRedirect(Tools::getFERoute("uzivatelClass", $uzivatel->getId()),500);
				$ob = ob_get_clean();

				$response->actionHtml = $ob;
			}else{
				$response->status = -2;
				$response->message = __("Systém - chyba, pokoušíte se o něco nekalého","realsys");
			}

		}
	}else{
		$response->status = -1;
		$response->message = __("Došlo k technické chybě - chybějící parametry","realsys");
	}
	wp_send_json($response);
	die();
}



function checkUserExists(){

	if(Tools::checkPresenceOfParam("db_email", $_GET)){
		$email = $_GET['db_email'];
		$user_exists = assetsFactory::getAllEntity("uzivatelClass",array(new filterClass("email", "=", "'" . $email . "'")));
		if($user_exists && is_array($user_exists) && count($user_exists) > 0){
			wp_send_json(false);
			die();
		}
	}
	wp_send_json(true);
	die();
}

function checkUserExistsAdvanced(){

	if(Tools::checkPresenceOfParam("db_email", $_GET)){

		$email = $_GET['db_email'];
		wp_send_json(uzivatelClass::isUserAnonymous($email));
		die();

	}else{
		$response = new stdClass();
		$response->status = -1;
		$response->message = "Chybějící parametry kontroly.";
		wp_send_json($response);
		die();
	}
}


function getInzeraty(){

	// now shut down error reporting for a while
	error_reporting(0);
	ini_set('display_errors', 'Off');

	/* GETTING REQUEST DATA */
	$request_body = file_get_contents('php://input');
	$data = json_decode($request_body, true);



	/* SETTING RESPONSE OBJECT */
	$response = new stdClass();


	/* SETTING UP ORDERING */
	$orderBy = "ORDER BY id DESC";
	if(Tools::checkPresenceOfParam("sortBy", $data)){
		$sorting = $data['sortBy'];
		$sorting = explode(":", $sorting);
		$sortBy = $sorting[0];
		$sortDirection = $sorting[1];
		$sortBy = str_replace("db_", "", $sortBy);
		$orderBy = "ORDER BY $sortBy " . $sortDirection;
	}

	/*SETTING UP PAGGING */
	$bufferSize = false;
	$offset = false;
	if(Tools::checkPresenceOfParam("countPage", $data) && Tools::checkPresenceOfParam("page", $data)){
		$bufferSize = $data['countPage'];
		$page = $data['page'];
		$offset = $bufferSize * ($page-1);
	}


	/* SETTING UP SEARCH */
	$filter_arr = array();
	$filter_arr[] = new filterClass("stav_inzeratu","=",1);
	if(Tools::checkPresenceOfParam("search", $data)){
		global $filter_parameters;
		$search_arr = $data['search'];


		foreach ($search_arr as $key => $value){

			if(Tools::checkPresenceOfParam($value['name'], $filter_parameters)){

				$search_item = $value;
				if(is_array($search_item['value'])){
					for ($i= 0; $i < count($search_item['value']); $i++){
						$operator = $search_item['operator'][$i];
						$deserved_value = $search_item['value'][$i];
						$column = str_replace("db_","",$search_item['name']);
						$filter = new filterClass($column, $operator, "'" . $deserved_value . "'");
						$filter_arr[] = $filter;
					}
				}elseif ($filter_parameters[$search_item['name']]['type'] == 'map-search'){
					continue;
				}else{

					$wanted_value = $search_item['value'];
					if($wanted_value != -1){
						$column = str_replace("db_","",$search_item['name']);
						$filter = new filterClass($column, $search_item['operator'], "'" . $wanted_value . "'");
						$filter_arr[] = $filter;
					}
				}
			}

			/* FILTROVÁNÍ DLE LAT A LNG RADIUS */
			if($value['name'] == 'db_lng' || $value['name'] == 'db_lat'){
				if($value['value'] != -1){
					$value_loc_min = floatval($value['value']) - RADIUS;
					$value_loc_max = floatval($value['value']) + RADIUS;
					$column = str_replace("db_","",$value['name']);
					$filter = new filterClass($column, '<', $value_loc_max);
					$filter_arr[] = $filter;
					$filter = new filterClass($column, '>', $value_loc_min);
					$filter_arr[] = $filter;
				}
			}

		}

	}

	/* DATA MINIG */
	$inzeraty = assetsFactory::getAllEntity(
		"inzeratClass",
		$filter_arr,
		$offset,
		$bufferSize,
		false,
		"ORDER BY $sortBy " . $sortDirection
	);



	$i = 0;
	$ordered_list = array();
	foreach ($inzeraty as $key => $val){
		$val->ignoreInterface();
		$val->writeDials();
		$val->getSubobject("obrazek");
		$val->setForceNotUpdate();
		$val->link = Tools::getFERoute("inzeratClass", $val->getId());
		$val->order = $i;
		$ordered_list[] = $val;
		$i++;
	}

	/* SENDING RESPONSE */
	$response->status = 1;
	$response->appData = new stdClass();
	$response->appData->inzeraty = $inzeraty;
	$response->appData->currency = CURRENCY;
	$response->appData->totalRecordsCount = assetsFactory::getAllEntityCount("inzeratClass", $filter_arr);
	wp_send_json($response);
	die();
}


function changeUserAvatar() {
	$result = Tools::postChecker($_POST,array(
		'id' => array(
			'required' => true,
			'type' => NUMBER
		)
	),true);
	if($result){

		$response = Tools::uploadImage();

		if(is_object($response)){
			$universal_name = $response->universal_name;
			$default_url = $response->default_url;


			$obrazek = assetsFactory::createEntity("obrazekClass", array(
				'url' => $default_url,
				'kod' => $universal_name
			));

			$id = $_POST['id'];
			$uzivatel = assetsFactory::getEntity("uzivatelClass", $id);

			if($uzivatel && $uzivatel->isUserLoggedIn()){
				$url = home_url() . $obrazek->getImageDimensions()['gallery'];
				$response->gallery_url = $url;
				$uzivatel->db_avatar = $url;
				$response->db_id = $obrazek->getId();
			}else{
				$response = new stdClass();
				$response->status = 0;
				$response->message = __("Uživatel neexistuje nebo není zalogován","realsys");
			}
		}else{
			$response = new stdClass();
			$response->status = 0;
			$response->message = __("Nastala chyba!","realsys");
		}


	}else{
		$response = new stdClass();
		$response->status = 0;
		$response->message =__("Některé parametry nebyli specifikovány","realsys");
	}

	wp_send_json($response);
	die();
}


function removeInzerat(){
	$response = new stdClass();

	$result = Tools::postChecker($_POST, array(
		"inzeratid" => array(
			'required' => true,
			'type' => NUMBER
		),
		"userid" => array(
			'required' => true,
			'type' => NUMBER
		)
	), true);

	if($result){
		$uzivatel_id = $_POST['userid'];
		$inzerat_id = $_POST['inzeratid'];
		$uzivatel = assetsFactory::getEntity('uzivatelClass', $uzivatel_id);
		if($uzivatel->isUserLoggedIn()){
			$inzerat = assetsFactory::getEntity("inzeratClass", $inzerat_id);
			if($inzerat && $inzerat->db_uzivatel_id == $uzivatel_id){
				$result = assetsFactory::removeEntity("inzeratClass", $inzerat_id);
				if($result){
					$response->status = 1;
					$response->message = __("Úspěšně smazáno","realsys");
				}else{
					$response->status = 0;
					$response->message = __("Smazání se nevydařilo","realsys");
				}
			}else{
				$response->status = 0;
				$response->message = __("Inzerát není ve vlastnictví uživatele.","realsys");
			}
		}else{
			$response->status = 0;
			$response->message = __("Uživatel není přihlášen","realsys");
		}
	}else{
		$response->status = 0;
		$response->message = __("Některé parametry nebyli specifikovány","realsys");
	}

	wp_send_json($response);
	die();
}


function changeInzeratStatus(){
	$response = new stdClass();

	$result = Tools::postChecker($_POST, array(
		"inzeratid" => array(
			'required' => true,
			'type' => NUMBER
		),
		"userid" => array(
			'required' => true,
			'type' => NUMBER
		),
		"inzeratstatus" => array(
			'required' => true,
			'type' => NUMBER
		)
	), true);

	if($result){
		$uzivatel_id = $_POST['userid'];
		$inzerat_id = $_POST['inzeratid'];
		$inzerat_status = $_POST['inzeratstatus'];

		$uzivatel = assetsFactory::getEntity('uzivatelClass', $uzivatel_id);
		if($uzivatel->isUserLoggedIn()){
			$inzerat = assetsFactory::getEntity("inzeratClass", $inzerat_id);
			if($inzerat && $inzerat->db_uzivatel_id == $uzivatel_id){
				if($inzerat_status == 0 || $inzerat_status == 1){
					if($inzerat->db_stav_inzeratu !== 2){
						$inzerat->db_stav_inzeratu = $inzerat_status;
						$response->status = 1;
						$response->message = __("Úspěšná změna stavu inzerátu","realsys");
					}else{
						$response->status = 0;
						$response->message = __("Inzerát není ještě schválený. Nelze ho nyní aktivovat.","realsys");
					}
				}else{
					$response->status = 0;
					$response->message = __("Nepřípustné hodnoty stavu inzerátu","realsys");
				}

			}else{
				$response->status = 0;
				$response->message = __("Inzerát není ve vlastnictví uživatele","realsys");
			}
		}else{
			$response->status = 0;
			$response->message = __("Uživatel není přihlášen","realsys");
		}
	}else{
		$response->status = 0;
		$response->message = __("Některé parametry nebyli specifikovány","realsys");
	}

	wp_send_json($response);
	die();
}


function createInzeratImages(){
	$result = Tools::postChecker($_POST,array(
		'id' => array(
			'required' => true,
			'type' => NUMBER
		)
	),true);
	if($result){

		$response = Tools::uploadImage();

		if(is_object($response)){
			$universal_name = $response->universal_name;
			$default_url = $response->default_url;


			$obrazek = assetsFactory::createEntity("obrazekClass", array(
				'url' => $default_url,
				'kod' => $universal_name
			));

			$id = $_POST['id'];
			$uzivatel = assetsFactory::getEntity("uzivatelClass", $id);

			if($uzivatel && $uzivatel->isUserLoggedIn()){
				$url = home_url() . $obrazek->getImageDimensions()['listing'];
				$response->gallery_url = $url;
				$response->db_id = $obrazek->getId();
			}else{
				$response = new stdClass();
				$response->status = 0;
				$response->message = __("Uživatel neexistuje nebo není zalogován","realsys");
			}
		}else{
			$response = new stdClass();
			$response->status = 0;
			$response->message = __("Nastala chyba!","realsys");
		}


	}else{
		$response = new stdClass();
		$response->status = 0;
		$response->message = __("Některé parametry nebyli specifikovány","realsys");
	}

	wp_send_json($response);
	die();
}


function removePes(){
	$response = new stdClass();

	$result = Tools::postChecker($_POST, array(
		"id" => array(
			'required' => true,
			'type' => NUMBER
		),
		"userid" => array(
			'required' => true,
			'type' => NUMBER
		)
	), true);

	if($result){
		$uzivatel_id = $_POST['userid'];
		$pes_id = $_POST['id'];
		$uzivatel = assetsFactory::getEntity('uzivatelClass', $uzivatel_id);
		if($uzivatel->isUserLoggedIn()){
			$pes = assetsFactory::getEntity("hlidacipesClass", $pes_id);
			if($pes && $pes->db_uzivatel_id == $uzivatel_id){
				$result = assetsFactory::removeEntity("hlidacipesClass", $pes_id);
				if($result){
					$response->status = 1;
					$response->message = __("Úspěšně smazáno","realsys");
				}else{
					$response->status = 0;
					$response->message = __("Smazání se nevydařilo","realsys");
				}
			}else{
				$response->status = 0;
				$response->message = __("Inzerát není ve vlastnictví uživatele.","realsys");
			}
		}else{
			$response->status = 0;
			$response->message = __("Uživatel není přihlášen","realsys");
		}
	}else{
		$response->status = 0;
		$response->message = __("Některé parametry nebyli specifikovány","realsys");
	}

	wp_send_json($response);
	die();
}

function createWatchdog(){

	// now shut down error reporting for a while
	error_reporting(0);
	ini_set('display_errors', 'Off');

	$request_body = file_get_contents('php://input');
	$data = json_decode($request_body, true);
	$response = new stdClass();
	$result = Tools::postChecker($data, array(
		"filters" => array(
			"type" => PHPARRAY,
			"required" => true
		),
		"name" => array(
			"type" => STRING255,
			"required" => true
		),
		"type" => array(
			"type" => NUMBER,
			"required" => true
		)
	), true);


	if($result){
		$user = uzivatelClass::getUserLoggedId();
		if($user !== false){
			$user = assetsFactory::getEntity("uzivatelClass",$user);
			$type = $data['type'];

			if($type == 1 || $type == 2){

				$result = Tools::postChecker($data, array(
					"transactionId" => array(
						"type" => NUMBER,
						"required" => true
					)
				), true);

				if($result){
					$transactionid = $data['transactionId'];
					$transaction = assetsFactory::getEntity("transakceClass", $transactionid);
					if($transaction){
						if(!$transaction->isConfirmed()){
							if($transaction->isRequestedByCurrentUser()){

								//account transaction
								$transaction->db_accept = 1;
								$transaction->aktualizovat();

								// build watchdog
								$hlidacipes = hlidacipesClass::setupDog($data, $user);

								if($hlidacipes){
									$response->status = 1;
									$response->message = __("Hlídací pes úspěšně vytvořen","realsys");
								}else{
									$response->status = 0;
									$response->message = __("Hlídací pes se nepodařil vytvořit","realsys");
								}
							}else{
								$response->status = 0;
								$response->message = __("Nevalidní transakce","realsys");
							}
						}else{
							$response->status = 0;
							$response->message = __("Neplatná transakce","realsys");
						}
					}else{
						$response->status = 0;
						$response->message = __("Neexistující transakce","realsys");
					}
				}else{
					$response->status = 0;
					$response->message = __("Hlídací pes nebyl vytvořen, protože nebyla doložena platná transakce.","realsys");
				}

			}else{
				$hlidacipes = hlidacipesClass::setupDog($data, $user);
				
				if($hlidacipes){
					$response->status = 1;
					$response->message = __("Hlídací pes úspěšně vytvořen","realsys");
				}else{
					$response->status = 0;
					$response->message = __("Hlídací pes se nepodařil vytvořit","realsys");
				}
			}
		}else{
			$response->status = 0;
			$response->message = __("Hlídací pes se nevytvořil. Nejste přihlášen.","realsys");
		}
	}else{
		$response->status = 0;
		$response->message = __("Nebyli zadány všechny parametry","realsys");
	}

	wp_send_json($response);
	die();
}


function checkUserCredits(){

	// now shut down error reporting for a while
	error_reporting(0);
	ini_set('display_errors', 'Off');

	$result = Tools::postChecker($_GET, array(
		'serviceid' => array(
			'type' => NUMBER,
			'required' => true
		)
	), true);

	$response = new stdClass();

	if($result){
		$user_id = uzivatelClass::getUserLoggedId();
		if($user_id !== false){
			$user = assetsFactory::getEntity("uzivatelClass",$user_id);
			if($user){
				$billance = $user->getUserBillance();
				$serviceid = $_GET['serviceid'];
				global $cenik_sluzeb;
				if(isset($cenik_sluzeb[$serviceid])){

					$price = $cenik_sluzeb[$serviceid]['price'];

					if($price <= $billance){
						$response->status = 1;
						$response->message = __("Uživatel má dostatek kreditů","realsys");
					}else{
						$response->status = 0;
						$response->message = __("Uživatel nemá dostatek kreditů - stav kreditů:","realsys") . " " . $billance . ", " . __("Požadované množství:","realsys") . " " . $price;
					}
				}else{
					$response->status = -1;
					$response->message = __("Tato služba neexistuje","realsys");
				}
			}else{
				$response->status = -2;
				$response->message = __("Neexistující uživatel","realsys");
			}
		}else{
			$response->status = -3;
			$response->message = __("Uživatel není přihlášen","realsys");
		}
	}else{
		$response->status = -4;
		$response->message = __("Povinná pole nebyla vyplněna.","realsys");
	}

	wp_send_json($response);
	die();
}


function payForService(){

	// now shut down error reporting for a while
	error_reporting(0);
	ini_set('display_errors', 'Off');

	$result = Tools::postChecker($_GET, array(
		'serviceid' => array(
			'type' => NUMBER,
			'required' => true
		)
	), true);

	$response = new stdClass();

	if($result){
		$user_id = uzivatelClass::getUserLoggedId();
		if($user_id !== false){
			$user = assetsFactory::getEntity("uzivatelClass",$user_id);
			if($user){

				$serviceid = $_GET['serviceid'];
				global $cenik_sluzeb;

				$service = $cenik_sluzeb[$serviceid];
				if(isset($service['requireEntity'])){

					$result = Tools::postChecker($_GET, array(
						'entitytype' => array(
							"type" => STRING255,
							"required" => true
						),
						'entityid' => array(
							"type" => NUMBER,
							"required" => true
						)),
						true
					);

					if($result){
						$entitytype = $_GET['entitytype'];
						$entityid = $_GET['entityid'];
						$entity = assetsFactory::getEntity($entitytype, $entityid);
						if($entity){
							$factory = new transactionFactory($user, $entity);
							$response = $factory->requestService($serviceid);
						}else{
							$response->status = -8;
							$response->message = __("Zadaná entita nebyla nalezena.","realsys");
						}
					}else{
						$response->status = -1;
						$response->message = __("Při objednání služby tohoto typu je třeba poskytnou informace o entitě a její ID","realsys");
					}
				}else{
					$factory = new transactionFactory($user);
					$response = $factory->requestService($serviceid);
				}
			}else{
				$response->status = -2;
				$response->message = __("Neexistující uživatel","realsys");
			}
		}else{
			$response->status = -3;
			$response->message = __("Uživatel není přihlášen","realsys");
		}
	}else{
		$response->status = -4;
		$response->message = __("Povinná pole nebyla vyplněna.","realsys");
	}

	wp_send_json($response);
	die();
}




function payForContact(){

	// now shut down error reporting for a while
	error_reporting(0);
	ini_set('display_errors', 'Off');

	$response = new stdClass();
	$result = Tools::postChecker($_POST, array(
		"transactionid" => array(
			"type" => NUMBER,
			"required" => true
		),
		"entityid" => array(
			"type" => NUMBER,
			"required" => true
		)
	), true);


	if($result){
		$user = uzivatelClass::getUserLoggedId();
		if($user !== false || (isset($_SESSION['transactionid']) && $_SESSION['transactionid']==$_POST['transactionid'])){


			$transactionid = $_POST['transactionid'];
			$entityid = $_POST['entityid'];

			$transaction = assetsFactory::getEntity("transakceClass", $transactionid);

			if($transaction){
				if(!$transaction->isConfirmed()){
					if($transaction->isRequestedByCurrentUser() || (isset($_SESSION['transactionid']) && $_SESSION['transactionid']==$_POST['transactionid'])){

						unset($_SESSION['transactionid']);
						//account transaction
						$transaction->db_accept = 1;
						$transaction->aktualizovat();

						// get contact
						$inzerat = assetsFactory::getEntity("inzeratClass",$entityid);
						if($inzerat){
							$uzivatel = $inzerat->getSubobject("uzivatel");
							if($uzivatel){
								$response->status = 1;
								$response->jmeno = $uzivatel->db_jmeno;
								$response->prijmeni = $uzivatel->db_prijmeni;
								$response->telefon = $uzivatel->db_telefon;
								$response->email = $uzivatel->db_email;
								$response->uzivatel_url = Tools::getFERoute("uzivatelClass",$uzivatel->getId(),"detail");
								$response->mnozstvi = $transaction->db_mnozstvi;
								$response->currency = CURRENCY;

								if($transaction->isRequestedByCurrentUser()){
									$current_user = uzivatelClass::getUserLoggedObject();
									Tools::sendMail( $current_user->db_email, "Zobrazení kontaktu","sendContact",array(
										"jmeno" => $uzivatel->db_jmeno,
										"prijmeni" => $uzivatel->db_prijmeni,
										"telefon" => $uzivatel->db_telefon,
										"email" => $uzivatel->db_email
									));
								}

								$response->message = __("Kontakt úspěšně získán","realsys");
							}else{
								$response->status = 0;
								$response->message = __("Kontakt se nepodařilo získat. Neplatný uživatel.","realsys");
							}
						}else{
							$response->status = 0;
							$response->message = __("Kontakt se nepodařilo získat. Neplatný inzerát.","realsys");
						}
					}else{
						$response->status = 0;
						$response->message = __("Nevalidní transakce","realsys");
					}
				}else{
					$response->status = 0;
					$response->message = __("Neplatná transakce","realsys");
				}
			}else{
				$response->status = 0;
				$response->message = __("Neexistující transakce","realsys");
			}

		}else{
			$response->status = 0;
			$response->message = __("Kontakt nebyl získán. Nejste přihlášen.","realsys");
		}
	}else{
		$response->status = 0;
		$response->message = __("Nebyli zadány všechny parametry","realsys");
	}

	wp_send_json($response);
	die();
}
