<?php

/*
 * Router pracuje s POST a GET a rozhoduje jaký kontroler se zavede.
 * V závislosti na tom potom kontroller provádí logiku, volá jednotlivé
 * třídy a vyhodí pohled (view). Router slouží jako hlavní zaváděcí soubor
 */

require_once __DIR__ . '/controllers/controller.php';

// sjednotí post i get do jednoho pole, nehledá rozdíly mezi černýma a bílíma
$data = array_merge($_GET, $_POST);
if(isset($data["controller"])){
    
    // kontroller je nastaven, pokračuj v provádění
    
    // requiruje kontroller
    $controllerName = $data["controller"];
    if(file_exists(__DIR__ . "/controllers/" . $controllerName . "Controller.php")){
        require_once(__DIR__ . "/controllers/" . $controllerName . "Controller.php");
    }else {
        //pokud neexistuje, vyhodí chybu a chcípne
        trigger_error("Kontroller $controllerName není nastaven");
        die();
    }
    
    // nastaví jméno kontrolleru 
    $controller = $controllerName;
    $controllerName .= "Controller";
    // očistí data z post a get od controlleru a akce
    $vanishedData = array_filter($data, function($val, $key){
        if($key == "controller" || $key == "action"){
            return false;
        }
        return true;
    },ARRAY_FILTER_USE_BOTH);
    
    if(class_exists($controllerName)){
        // zkontroluje zda existuje kontroller a pokud ano vytvořího
        $mainController = new $controllerName($vanishedData, $controller);
    }else {
        // pokud neexistuje tak chcípne na choleru
        trigger_error("Kontroler nebyl zkonstruován");
        die();
    }

    if(isset($data["action"])){
        // zkontroluje nastavení akce, pokud je nastavená hledá metodu v kontroleru
        if(method_exists($mainController, $data["action"])){
            // spustí metodu kontroleru action
            $action = $data["action"];

            $mainController->$action();
        }else {
            // pokud akci nenalzne vyhodí chybu
            trigger_error("Kontroler nedisponuje zadanou akcí");
        }
    }else {
        // pokud není akce specifikována spustí defaultní akci performAction();
        $mainController->performAction();
    }
}else {
    // kontroler není nastaven, načti default
    trigger_error("Kontroller nebyl specifikován. Načítám základní");
    $controller = DEFAULT_CONTROLLER;
    $controllerName = DEFAULT_CONTROLLER . "Controller";
    require_once(__DIR__ . "/controllers/" . $controllerName . ".php");
    $basicController = new $controllerName($data, $controller);
    $basicController->performAction();
}
