<?php

/*
 * RUN VARS
 */
$pluginUrl    = get_template_directory_uri();
$actionsStack = array();

/* DEFAULT UPLOAD SIZE */
define( "UPLOAD_SIZE", 10000000 );

//ZAPNOUT DEBUG PANEL
define( "DEBUG_PANEL", false );

// STRÁNKOVÁNÍ
define( "PAGING", 6 );
define( "MAX_PAGING_POSITIONS", 10 );

//security nonce
define( "GLOBAL_AJAX_NONCE", "ajaxAction7854efas." );

// deployment config
define( "DEPLOYMENT", false );

//PLUGIN SLUG
define( "PLUGIN_SLUG", "yourpraguetransfer" );

//paths
define( "ASSETS_PATH", "/wp-content/themes/yourpraguetransfer/assets/" );
define( "ADMIN_BASE_URL", BASE_URL . "wp-admin/admin.php?page=" . PLUGIN_SLUG );


// recaptcha secret BE
define( "RECAPTCHA", "6Ld5jcwUAAAAAHkJW4PKS2g11BUtuxMV7XvP2aud" );
define( "RECAPTCHA_SITEKEY", "6Ld5jcwUAAAAANHZpw5Xa4g-EgVPTOMfmGSSqZ4l" );

// ajax konstanty
define( "AJAXURL", admin_url( "admin-ajax.php" ) );

// Google auth id
define("GOOGLE_ID", "169419171066-51n84mk31m3sdi47rtkj84tprnrppker.apps.googleusercontent.com");
define("GOOGLE_API_KEY", "AIzaSyBLIBdR0G1-KMTJDEmHeLdI87qAItL7zyw");
define("GOOGLE_SERVER_API_KEY", "AIzaSyDLb5HxunZlhEtXHmELaNbd9XMajfkoQvc");


// CURRENCY
define("CURRENCY", "Kč");
define("CURRENCY_CODE", "CZK");
define("LANG_CODE", "en-US");

$currencies = array(
    0 => array(
        'code' => 'CZK',
        'label' => 'Kč'
    ),
    1 => array(
        'code' => 'EUR',
        'label' => '€'
    )
);


// regex check konstanty
define( "REGEX_EMAIL", "/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/iD" );
define( "REGEX_TELEPHONE", "/^(\+49)? ?[1-9][0-9]{2} ?[0-9]{3} ?[0-9]{3}$/" );
define( "REGEX_TIME", '/^\d{1,2}:\d{1,2}$/m' );
define( "REGEX_URL_ABSOLUTE", '%^(?:(?:https?|ftp)://)(?:\S+(?::\S*)?@|\d{1,3}(?:\.\d{1,3}){3}|(?:(?:[a-z\d\x{00a1}-\x{ffff}]+-?)*[a-z\d\x{00a1}-\x{ffff}]+)(?:\.(?:[a-z\d\x{00a1}-\x{ffff}]+-?)*[a-z\d\x{00a1}-\x{ffff}]+)*(?:\.[a-z\x{00a1}-\x{ffff}]{2,6}))(?::\d+)?(?:[^\s]*)?$%iu' );
define( "REGEX_URL_RELATIVE", "");

// DEFAULT CONTROLLER
define( "DEFAULT_CONTROLLER", "home" );


// TYPY CHYB
define( "ERROR", "danger" );
define( "WARNING", "warning" );
define( "SUCCESS", "success" );
define( "INFO", "info" );


// OVĚŘOVACÍ SLOVNÍK

define( "STRING63", "str63" ); // max 63 chars OK
define( "STRING255", "str255" ); // max 255 chars OK
define( "STRING511", "str511" ); // max 511 chars OK
define( "STRING", "str" ); // string not limited
define( "NUMBER", "int" ); // max 2 147 483 647 positive negative OK
define( "BOOL", "bool" ); // max 1/0 or true/false OK
define( "FLOAT", "float" ); // standard float OK

define( "URL_RELATIVE", "url" ); // url only relative
define( "URL", "url" ); // url only relative
define( "URL_ABSOLUTE", "url_abs" ); // url only absolute with protocol
define( "EMAIL", "mail" ); // standard email OK
define( "FOREIGN_KEY", "fk" ); // foreign key OK (with control against relations var)
define( "TEL", "tel" ); // telephone like +48 777 777 777 OK
define( "PRICE", "price" ); // price only positive till 2 147 483 647 OK
define( "PRICE_ZERO", "price_zero" ); // price only positive till 2 147 483 647, including zero
define( "TIMESTAMP", "timestamp" ); // valid timestamp OK
define( "PHPARRAY", "array" ); // valid PHP array
define( "PDF_URL", "pdf_url"); // valid PDF URL

define( "DATE", "date" ); // DEPRECATED
define( "TIME", "time" ); // DEPRECATED


// PRAVIDLA PRO JEDNOTLIVÉ TŘÍDY
// tyto pravidla jsou defaultně zděděné do AJAX interfacu
$field_rules = array(
	"obrazekClass"    => array(
		'db_id'         => array(
			"type"     => NUMBER,
			"required" => true
		),
		"db_titulek"    => array(
			"type"     => STRING255,
			"required" => false
		),
		"db_popisek"    => array(
			"type"     => STRING511,
			"required" => false
		),
		"db_kod"        => array(
			"type"     => STRING255,
			"required" => true
		),
		"db_url"        => array(
			"type"     => URL_RELATIVE,
			"required" => true
		),
		"db_entity_id" => array(
			"type"     => FOREIGN_KEY,
			"required" => false
		),
		'db_entity_class'=> array(
		    "type" => STRING255,
            "required" => true
        ),
		"db_front"      => array(
			"type"     => BOOL,
			"required" => false
		)
	),
	'objednavkaClass' => array(
		'db_id'         => array(
			'type'     => NUMBER,
			'required' => false
		),
		'db_jmeno' => array(
			'type'     => STRING255,
			'required' => true
		),
		'db_prijmeni'       => array(
			'type'     => STRING255,
			'required' => true
		),
		'db_email'   => array(
			'type'     => EMAIL,
			'required' => true
		),
		'db_telefon' => array(
			'type' => TEL,
			'required' => true
		),
		'db_destinace_z' => array(
			'type' => STRING511,
			'required' => true
		),
		'db_destinace_do' => array(
			"type" => STRING511,
			'required' => true
		),
		'db_cas' => array(
			"type" => TIMESTAMP,
			"required" => true
		),
        'db_cas_zpet' => array(
            "type" => TIMESTAMP,
            "required" => false
        ),
        'db_pocet_osob' => array(
            "type" => NUMBER,
            "required" => true
        ),
        'db_znameni' => array(
            "type" => STRING255,
            "required" => false
        ),
        'db_poznamka' => array(
            "type" => STRING511,
            "required" => false
        ),
        'db_detska_sedacka' => array(
            "type" => BOOL,
            "required" => true
        ),
        'db_velka_zavazadla' => array(
            "type" => BOOL,
            "required" => true
        ),
        'db_typ_platby' => array(
            "type" => BOOL,
            "required" => true
        ),
        'db_mena' => array(
            "type" => BOOL,
            "required" => true
        ),
        'db_cena' => array(
            "type" => PRICE,
            "required" => true
        ),
        'db_vozidlo_id' => array(
            "type" => FOREIGN_KEY,
            "required" => true
        ),
        'db_stav' => array(
            "type" => BOOL,
            "required" => true
        ),
        'db_hash' => array(
            "type" => STRING255,
            "required" => false
        )
	),
	"ciselnikClass"   => array(
		'db_id'          => array(
			'type'     => NUMBER,
			'required' => false
		),
		'db_domain'      => array(
			'type'     => STRING255,
			'required' => true
		),
		'db_property'    => array(
			'type'     => STRING255,
			'required' => true
		),
		'db_value'       => array(
			'type'     => STRING511,
			'required' => true
		),
		'db_translation' => array(
			'type'     => STRING511,
			'required' => true
		),
	),
    'vozidloClass' => array(
        'db_id' => array(
            'type' => NUMBER,
            'required' => false
        ),
        'db_nazev' => array(
            'type' => STRING511,
            'required' => true
        ),
        'db_popis' => array(
            'type' => STRING511,
            'required' => true
        ),
        'db_letistni_transfer' => array(
            'type' => PRICE,
            'required' => true
        ),
        'db_trida' => array(
            'type' => NUMBER,
            'required' => true
        ),
        'db_max_zavazadel' => array(
            'type' => NUMBER,
            'required' => false
        ),
        'db_max_osob' => array(
            'type' => NUMBER,
            'required' => false
        ),
        'db_hvezdy' => array(
            'type' => NUMBER,
            'required' => false
        ),
        'db_cena_za_jednotku' => array(
            'type' => NUMBER,
            'required' => true
        ),
        'db_jednotka' => array(
            'type' => NUMBER,
            'required' => true
        ),
        'db_top' => array(
            'type' => BOOL,
            'required' => false
        ),
        'db_wifi' => array(
            'type' => BOOL,
            'required' => false
        ),
        'db_voda' => array(
            'type' => BOOL,
            'required' => false
        ),
        'db_vyzvednuti' => array(
            'type' => BOOL,
            'required' => false
        ),
        'db_klimatizace' => array(
            'type' => BOOL,
            'required' => false
        ),
        'db_voucher' => array(
            'type' => BOOL,
            'required' => false
        ),
    ),
    'cenikClass' => array(
        'db_id' => array(
            'required' => false,
            'type' => NUMBER
        ),
        'db_nazev' => array(
            'required' => true,
            'type' => STRING255
        ),
        'db_zona_id' => array(
            'required' => true,
            'type' => PHPARRAY
        ),
        'db_cena_tam' => array(
            'required' => true,
            'type' => NUMBER
        ),
        'db_cena_zpet' => array(
            'required' => false,
            'type' => NUMBER
        ),
        'db_max_osob' => array(
            'required' => false,
            'type' => NUMBER
        ),
        'db_min_osob' => array(
            'required' => false,
            'type' => NUMBER
        ),
        'db_vozidlo_id' => array(
            'required' => true,
            'type' => FOREIGN_KEY
        ),
    ),
    'referenceClass' => array(
        'db_id' => array(
            'required' => false,
            'type' => NUMBER
        ),
        'db_jmeno' => array(
            'required' => true,
            'type' => STRING255
        ),
        'db_pozice' => array(
            'required' => true,
            'type' => STRING255
        ),
        'db_reference' => array(
            'required' => true,
            'type' => STRING511
        )
    ),
    'zonaClass' => array(
        'db_nazev' => array(
            'required' => true,
            'type' => STRING255
        ),
        'db_zone_polygon' => array(
            'required' => true,
            'type' => PHPARRAY
        )
    )
);


$frontend_general_rules = array(

	"db_heslo" => array(
		"required" => true,
		"minlength" => 6
	),
	"db_heslo2" => array(
		"required" => true,
        "minlength" => 6,
        "equalTo" => "#heslo"
	),
	"db_jmeno" => array(
		"required" => true,
        "minlength" => 3
	),
	"db_prijmeni" =>array(
		"required" => true,
        "minlength" => 3
	),
	"db_telefon" => array(
		"required" => true,
        "phoneCZ" => true
	),
	"db_email" => array(
		"required" => true,
		"remote" => AJAXURL . "?action=checkUserExists"
	),
	"db_email_nocheck" => array(
		"required" => true,
		"email" => true
	),
	"db_ulice" => array(
		"required" => true,
		"minlength" => 2
	),
	"db_cp" => array(
		"required" => true,
		"minlength" => 2
	),
	"db_mesto" => array(
		"required" => true,
		"minlength" => 2
	),
	"db_psc" => array(
		"required" => true,
		"zip" => true
	),
	"db_mestska_cast" => array(
		"required" => true,
		"minlength" => 2
	),
	"db_podlahova_plocha" => array(
		"required" => true,
		"number" => true
	),
	"db_pozemkova_plocha" => array(
		"required" => true,
		"number" => true
	),
	"db_titulek" => array(
		"required" => true
	),
	"db_pocet_mistnosti" => array(
		"required" => true,
		"minlength" => 2
	),
	"db_popis" => array(
		"required" => false,
	),
	"db_cena" => array(
		"required" => true,
		"number" => true
	),
	'db_typ_inzeratu' => array(
		"required" => true,
		"number" => true
	),
	'db_typ_stavby' => array(
		"required" => true,
		"number" => true
	),
	'db_stav_objektu' => array(
		"required" => true,
		"number" => true
	),
	'db_vybavenost' => array(
		"required" => true,
		"number" => true
	),
	'db_penb' => array(
		"required" => true,
		"number" => true
	),
	'db_typ_vlastnictvi' => array(
		"required" => true,
		"number" => true
	),
	'db_patro' => array(
		"required" => false,
		"number" => true
	),
	'db_celkem_podlazi' => array(
		"required" => false,
		"number" => true
	),
	'db_inzerat_obrazky[]' => array(
		"required" => true
	),
	'credits' => array(
		"required" => true
	),
	'payment' => array(
		'required' => true
	)
);

$frontend_add_rules = array(
	'db_patro' => array(
		'type' => NUMBER,
		'required' => array(
			array('db_typ_nemovitosti'=> 4, 'db_typ_stavby' => 5 ),
		),
		'appear' => array(

		)
	)
);


$frontend_general_messages = array(
	"db_heslo" => array(
		"required" => __("Heslo musí být vyplněno", "yourpraguetransfer")
	),
	"db_heslo2" => array(
		"required" => __("Prosím potvrďte heslo","yourpraguetransfer")
	),
	"db_email" => array(
		"remote" => __("Uživatel s touto emailovou adresou již existuje","yourpraguetransfer")
	)
);

$frontend_common_messages = array(
		"required" => __("Toto pole je povinné.","yourpraguetransfer"),
        "email" => __("Zadejte platnou emailovou adresu.", "yourpraguetransfer"),
        "url" => __("Zadejte platné URL.", "yourpraguetransfer"),
        "date" => __("Zadejte platné datum.", "yourpraguetransfer"),
        "dateISO" => __("Zadejte platné datum.", "yourpraguetransfer"),
        "number" => __("Zadejte platné číslo.", "yourpraguetransfer"),
        "digits" => __("Zadejte platné číslice.", "yourpraguetransfer"),
        "creditcard" => __("Zadejte platné číslo kreditní karty.", "yourpraguetransfer"),
        "maxlength" => __('Zadejte maximálně {0} znaků.', "yourpraguetransfer"),
        "minlength" => __('Zadejte minimálně {0} znaků.', "yourpraguetransfer"),
        "range" => __('Zadejte hodnotu mezi {0} a {1}.', "yourpraguetransfer")
);


// VŠEOBECNÝ SLOVNÍK PRO PŘEKLADY FIELDŮ
$dictionary = array(
	'db_domain'          => "Doména",
	'db_property'        => "Vlastnost",
	'db_value'           => "Hodnota",
	'db_translation'     => "Překlad",
	'db_front'           => "Náhledový obrázek",
    'db_nazev' => 'Název',
    'db_trida' => 'Třída',
    'db_hvezdy' => 'Počet hvězd',
    'db_top' => 'TOP',
    'db_max_osob' => 'Max. osob',
    'db_max_zavazadel' => 'Max. zavazadel',
    'db_cena_za_jednotku' => 'Cena za jednotku',
    'db_jednotka' => 'Jednotka',
    'db_id' => 'ID',
    'db_url' => 'URL',
    'db_titulek' => 'Titulek',
    'db_popisek' => 'Popisek',
    'db_cena_tam' => 'Cena tam',
    'db_cena_zpet' => 'Cena zpět',
    'db_min_osob' => 'Min. osob',
    'db_jmeno' => 'Jméno',
    'db_pozice' => 'Pozice',
    'db_reference' => 'Text reference',
    'db_prijmeni' => "Příjmení",
    'db_email' => "Email",
    'db_cena' => "Cena",
    'db_destinace_z' => "Z",
    'db_destinace_do' => "Do",
    'db_pocet_osob' => "Počet osob",
    'db_stav' => "Stav",
    'db_typ_platby' => "Typ platby",
    'db_mena' => "Měna"
);


// EPAYMENT KONSTANTY
define( "TEST_MODE", true );
define( "GOPAY_INLINE", false);
define ("GOPAY_STANDARD_CALLBACK", home_url() . "/gopay/?action=confirmPayment");
define ("GOPAY_QUICK_CALLBACK", home_url() . "/gopay/?action=confirmQuickPayment");

require_once("model_controller_backend.php");

require_once("relations.php");


// CISELNIKY
// číselníky které se přebírají z tabulky číselníků
$dials = array(
	'inzeratClass'  => array(
		'db_typ_nemovitosti',
		'db_typ_stavby',
		'db_typ_inzeratu',
		'db_stav_objektu',
		'db_stav_inzeratu',
		'db_vybavenost',
		'db_penb',
		'db_typ_vlastnictvi',
		'db_material'
	),
    'vozidloClass' => array(
        'db_trida',
        'db_jednotka'
    )
);

// místní číselníky, ty se vylučují s číselníky přebíraných z tabulky číselníků
$localDials = array(
	'obrazekClass' => array(
		'db_front' => array(
			0 => "Ne",
			1 => "ANO"
		)
	),
    'objednavkaClass' => array(
        'db_mena' => array(
            0 => $currencies[0]['label'],
            1 => $currencies[1]['label']
        ),
        'db_stav' => array(
            0 => "nezaplacená",
            1 => "zaplacená"
        ),
        'db_typ_platby' => array(
            0 => "hotově",
            1 => "online"
        )
    )
);


// clasess

$classes = array(
	'vozidloClass'  => "Vozidlo",
	'obrazekClass'  => "Obrázek",
	'objednavkaClass' => "Objednávka",
);


$ajax_localization = array(
	"ajaxUrl" => AJAXURL,
	"rules" => $frontend_general_rules,
	"messages" => $frontend_general_messages,
	"common_messages" => $frontend_common_messages,
	"localizations" => array(
		"totoCisloNeniValidni" => __("Toto číslo není validní.","yourpraguetransfer"),
		"totoPscNeniValidni" => __("Toto PSČ není validní. Formát 123 45.","yourpraguetransfer"),
		"nahrajteSvujObrazek" => __("Nahrajte svůj obrázek","yourpraguetransfer"),
		"nacitani" => __("Načítání","yourpraguetransfer"),
		"uploadovani" => __("Uploadování","yourpraguetransfer"),
		"uspesneNahranoNaServer" => __("Úspěšně nahráno na server","yourpraguetransfer"),
		"zruseno" => __("Zrušeno","yourpraguetransfer"),
		"klepneteProZruseni" => __("Klepněte pro zrušení", "yourpraguetransfer"),
		"klepneteProOpakovani" => __("Klepněte pro opakování", "yourpraguetransfer")
	),
    "google_api_key" => GOOGLE_API_KEY
);

require_once __DIR__ . "/configuration_images.php";

define("INVOICES_PATH","uploads/invoices/");
define("INVOICES_URL", home_url() . "/wp-content/uploads/invoices/");


define( "FRONTEND_IMAGES_PATH", get_template_directory_uri() . "/assets/images/images_frontend/" );

// předvolby telefonní

define( "PHONE", "(+48)" );

// RADIUS PRO PODOBNÉ INZERÁTY

define( "RADIUS", "0.5" );

// DATE FORMAT
define("DATE_FORMAT", "d.m.Y h:i");


// DEFAULT WATERMARK
define("ADD_WATERMARK", false);
define("WATERMARK", __DIR__ . "/../../../assets/images/images_backend/watermark.png");
define("WATERMARK_RESIZE_FACTOR", 1);


/* SENDING MAIL FROM */
define("SENDER_MAIL","info@yourpraguetransfer.cz");
define("SENDER_NAME", "Automat");


/* TRANSLATION ENTITIES */
$translation_entities = array(
    'vozidloClass' => array(
        'db_nazev',
        'db_popis',
        'db_trida'
    ),
    'referenceClass' => array(
        'db_pozice',
        'db_reference'
    ),
    'ciselnikClass' => array(
        'db_translation'
    )
);