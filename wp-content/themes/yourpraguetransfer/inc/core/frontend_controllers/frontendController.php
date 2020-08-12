<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of frontendController
 *
 * @author Jackie
 */

abstract class frontendController {
    
    public static $method = "performAction";
    public static $beforeHeadersMethod = "beforeHeadersAction";
	public static $afterHeadersMethod = "afterHeadersAction";
    protected $actionName;
    protected $view;
    public $requestData;
    protected $workData;
    protected $shortcodeData;

    
    public function __construct($actionName) {

        $this->actionName = $actionName;
        $this->view = $actionName . "View.php";
        $this->requestData = array();
        $this->workData = array();
        $this->register();
        $this->registerRoute();
    }


    /*
     * Při konstrukci kontroleru zaregistruje akci (defaultne performAction) do shortcodu který
     * nese název kontrolleru, tzn že kontroller lze mimo jin spouštět i na shortcode např [homeController].
     * Shortcodový controller nespouští žádnou funkci před výpisem hlaviček
     */
    public function register(){
        add_shortcode($this->actionName, array($this, self::$method ));
    }

    /*
     * Pří konstrukci kontroleru je také sepnuta tato funkce která si natáhne routing tabulku uvedenou v souboru
     * routingTable.php a oproti ní ověří zdali současná url a typ kontroleru neodpovídají současnému kontrolleru.
     * Pokud ano tak spustí funkci beforeHeadersMethod která pracuje před výpisem hlaviček a následně
     * navěsí na akci the_content samotnou akci afterHeadersMethod - ta vypíše theContent a následně vypíše performAction
     */
    public function registerRoute(){
    	global $routes;
		$_this = $this;
    	$routes_passed = array_filter($routes, function($value, $index) use ($_this){
			if($value == get_class($_this)){
				$current_url = $_SERVER["REQUEST_URI"];

				if(preg_match('/^' . $index . '/i', $current_url)){
					return true;
				}
			}
	    }, ARRAY_FILTER_USE_BOTH);

	    if(count($routes_passed) > 0){
		    call_user_func(array($this, self::$beforeHeadersMethod));
	    	add_filter("the_content", array($this, self::$afterHeadersMethod ));

	    }
    }


    /*
     * perform action slouží k spuštění kontrollerRouteru který volí akci která se bude spouštět a k výpisu
     * view
     */
    public function performAction($atts=array()){
        $this->shortcodeData = $atts;
        ob_start();
        $this->controllerRouter();
        $this->performView();
        return ob_get_clean();
    }

    /*
     * Na základě nastaveného view načte view a vypíše ho
     */
    public function performView(){
        global $pluginPath;
        
        if(file_exists($pluginPath . '/frontend_views/' . $this->view)){
            require_once ($pluginPath . '/frontend_views/' . $this->view);
        }else {
            trigger_error("Kontroler nemá asociovaný pohled");
        }
    }

    /*
     * Může během běhu přenastavit view kontrolleru
     */
    public function setView($view){
        $this->view = $view . "View.php";
    }

    /*
     * Controller router slouží k tomu aby spustil buď základní akci ($this->action) nebo nějakou jinou
     * akci specifikovanou v parametru get action
     */
    public function controllerRouter(){
        $request = array_merge($_GET, $_POST);
        $vanishedData = array_filter($request, function ($key, $value){
            if($key == "action"){
                return false;
            }
            return true;
        }, ARRAY_FILTER_USE_BOTH);

        $this->requestData = $vanishedData;

	    /* načtení WP proměnných do requestData */
	    global $wp_query;
	    $query_vars = $wp_query->query_vars;
	    $this->requestData = array_merge($this->requestData, $query_vars);
        
        if(isset($request['action']) && strlen($request['action']) > 0){
            $call = $request['action'];
            if(method_exists($this, $request['action'])){
                $this->$call();
                return true;
            }else{
            	trigger_error("Zadaná akce neexistuje - spouštím základní akci");
            	$this->action();
            	return false;
            }
        }

        trigger_error("Nebyla specifikována akce - spouštím základní akci.");
        $this->action();
    }


    /* metoda která spouští věci před odesláním hlavičky */
    public abstract function beforeHeadersAction();


    /* metoda která spouští věci po odeslání hlavičky */
    public function afterHeadersAction($the_content){
	    echo $the_content;
	    echo $this->performAction();
    }

	/*
	 * Slouží k získávání dat z postu např při vytváření nových instancí
	 */
	protected function getPostData($key){
		if(isset($this->requestData[$key])){
			return $this->requestData[$key];
		}
		return "";
	}


    /* metody které je třeba v controlleru implementovat*/
    public abstract function action();


    
}
