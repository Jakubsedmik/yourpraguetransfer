<?php


$base_url_regex = str_replace("/", "\/", BASE_URL);

$routes = array(
	$base_url_regex . 'new\/' => "homeController",
	$base_url_regex . 'inzerat\/' => "inzeratDetailController",
	$base_url_regex . 'uzivatel\/' => "uzivatelDetailController",
	$base_url_regex . "login\/" => "loginController",
	$base_url_regex . "vypis\/" => "vypisController",
	$base_url_regex . "vypismapa\/" => "vypisMapaController",
	$base_url_regex . "gopay\/" => "gopayController",
	$base_url_regex . "objednavka\/" => "objednavkaController",
	$base_url_regex . "editace-inzeratu\/" => "inzeratEditController",
	$base_url_regex . "pridat-inzerat\/" => "pridatInzeratController",
	$base_url_regex . "hlidacipes\/" => "hlidacipesController",
);



/**
 * Rewrity pro jednotlivé parametry
 */

$rewrites = array(
	'inzerat_id' => array(
		'regex' => '^inzerat/([^/]*)/?',
		'rewrite' => 'index.php?pagename=inzerat&inzerat_id=$matches[1]'
	),
	'uzivatel_id' => array(
		'regex' => '^uzivatel/([^/]*)/?',
		'rewrite' => 'index.php?pagename=uzivatel&uzivatel_id=$matches[1]'
	)
);


/*
 * Routing URLS
 */

$routing_urls = array(
	"inzeratClass" => array(
		'detail' => home_url() . '/inzerat/%d/',
		'listing' => home_url() . '/vypis/',
		'add' => home_url() . '/pridat-inzerat/',
		'edit' => home_url() . '/editace-inzeratu/?id=%d'
	),
	"uzivatelClass" => array(
		'detail' => home_url() . '/uzivatel/%d/',
		'login' => home_url() . "/login/",
		'resetpwd' => home_url() . '/login/?action=requestResetPassword'
	),
	"vypis" => array(
		'listing' => home_url() . '/vypis/',
		'map' => home_url() . '/vypismapa/'
	),
	"gopay" => array(
		"payment" => home_url() . '/gopay/?id=%d',
		"confirmation" => home_url() . '/gopay/',
		"quickpayment" => home_url() . "/gopay/?action=quickOrder"
	),
	"hlidacipesClass" => array(
		"detail" => home_url() . "/hlidacipes/?id=%d",
		"listing" => home_url() . "/uzivatel/%d/"
	),
	"objednavkaClass" => array(
		"detail" => home_url() . "/objednavka/"
	)
);