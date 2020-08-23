<?php

// MODEL / CONTROLLER  napojení
/* určuje jaké kontrolery slouží pro obsluhu jakých class */
$models = array(
    "obrazekClass"    => array(
        "frontendController" => "obrazekController",
        "backendController"  => "obrazek"
    ),
    "inzeratClass"    => array(
        "backendController" => "inzeraty"
    ),
    "uzivatelClass"   => array(
        "backendController" => "uzivatel"
    ),
    "objednavkaClass" => array(
        "backendController" => "objednavka"
    ),
    "ciselnikClass"   => array(
        "backendController" => "stav"
    ),
    "grafy"           => array(
        "backendController" => "graf"
    ),
    "transakceClass" => array(
        "backendController" => "transakce"
    ),
    "vozidloClass" => array(
        "backendController" => "vozidlo"
    ),
    "cenikClass" => array(
        "backendController" => "cenik"
    ),
    'zonaClass' => array(
        "backendController" => "zona"
    )
);