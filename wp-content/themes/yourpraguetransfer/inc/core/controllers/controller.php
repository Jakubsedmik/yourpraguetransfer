<?php

/*
 * Controller slouží k ovládání a je automaticky sestaven a volán pomocí router.php
 * Controller je zavolán na základě URL pomocí routeru a je automaticky spuštěna metoda
 * action - metodu action je nuté tedy vždy implementova v každém dílčím kontrolleru
 * Při kontstruování controlleru je automaticky na základně názvu controlleru také vybrán
 * pohled (view) který controller použije. Všechna dílčí POST a GET data se pak nachází v 
 * proměnné requestData na základě, kterých se provádí logika v metodě action.
 * V metodě můžeme také zavolat metodu performView a předat tak řízení spjatému pohledu.
 * Pohled je třeba mít nadefinovaný v složce views
 */

/**
 * Description of controller
 *
 * @author Uzivatel
 */
abstract class controller {
    protected $requestData;
    protected $view;
    protected $controllerName;
    protected $viewData;


    /*
     * Sestaví Controller a nastaví pohled, requestData(data z getu či postu)
     * a založí viewData - data která by mohl ještě
     * view potřebovat pro nějaký speciální výpis
     */
    public function __construct($data, $controllerName) {
        $this->requestData = $data;
        $this->$controllerName = $controllerName;
        $this->view = $controllerName . "View.php";
        $this->viewData = array();
    }
    
    /*
     * Předá řízení danému pohledu, který je s kontrollerem spjatý
     * view je možné také změnit pomocí setView()
     */
    public function performView(){
        global $pluginPath;
        
        if(file_exists($pluginPath . '/views/' . $this->view)){
            echo frontendError::getBackendErrors();
            if(DEBUG_PANEL){
                echo globalUtils::renderDebug();
            }
            require_once ($pluginPath . '/views/' . $this->view);
        }else {
            trigger_error("Kontroler nemá asociovaný pohled");
        }
        
    }
    
    /*
     * metoda automaticky spouštěná pomocí Routeru při založení controlleru
     */
    public function performAction(){
        $this->controllerRouter();
    }
    
    // metoda kterou je třeba vždy implementovat a na základě které se provádí celá logika změny / vytvoření / úpravy dat
    public abstract function action();
    
    
    /*
     * debugovací metoda, parametr je proměná kteorou chcete proskenovat a zjistit z čeho se skládá
     */
    protected function debug($var){
        echo "<pre>";
        echo "<code>";
        print_r($var);
        echo "</code>";
        echo "</pre>";
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


    /*
     * Metoda pro nastavení pohledu, např pokud se uvnitř logiky (action) rozhodneme že pohled by měl být jiný (např nějaký endpoint) tak jej můžeme pomocí
     * této metody přenastavit
     */
    protected function setView($view){
        $this->view = $view . "View.php";
    }
    
    
    public function controllerRouter(){
        $request = array_merge($_GET, $_POST);
        $vanishedData = array_filter($request, function ($key, $value){
            if($key == "action"){
                return false;
            }
            return true;
        }, ARRAY_FILTER_USE_BOTH);

        $this->requestData = $vanishedData;
        
        if(isset($request['action']) && strlen($request['action']) > 0){
            $call = $request['action'];
            if(method_exists($this, $request['action'])){
                $this->$call();
                return true;
            }else{
                trigger_error("Zadaná akce ještě nebyla implementována :: " . $call);
            }
        }
        trigger_error("Nebyla specifikována akce, spouštím základní akci.");
        $this->action();
    }

    public function getInstanceOrPostData($instanceName, $key){
    	if(Tools::checkPresenceOfParam($this->requestData, $key)){

	    }
    }
}
