<?php

$dev_branch = true;


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

// SMS MANAGER API KEY
define("SMS_API_KEY", "ebf1c47065b933d486f76f27abb4cd997c4c4c7f");


// ajax konstanty
define( "AJAXURL", admin_url( "admin-ajax.php" ) );

// Google auth id
define("GOOGLE_ID", "169419171066-51n84mk31m3sdi47rtkj84tprnrppker.apps.googleusercontent.com");
define("GOOGLE_API_KEY", "AIzaSyBLIBdR0G1-KMTJDEmHeLdI87qAItL7zyw");
define("GOOGLE_SERVER_API_KEY", "AIzaSyDLb5HxunZlhEtXHmELaNbd9XMajfkoQvc");

// FAKTUROID Credentials
define("FAKTUROID_SLUG", "szukamdomdev");
define("FAKTUROID_MAIL", "sedmik@studioseven.cz");
define("FAKTUROID_API_KEY", "0152b6409f5e3bd901c27826be6dd81dd57f796b");
define("FAKTUROID_AGENT", "PHPlib <sedmik@studioseven.cz>");

// CURRENCY
define("CURRENCY", "Kč");
define("CURRENCY_CODE", "PLN");
define("LANG_CODE", "pl-PL");

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
		"required" => __("Heslo musí být vyplněno", "realsys")
	),
	"db_heslo2" => array(
		"required" => __("Prosím potvrďte heslo","realsys")
	),
	"db_email" => array(
		"remote" => __("Uživatel s touto emailovou adresou již existuje","realsys")
	)
);

$frontend_common_messages = array(
		"required" => __("Toto pole je povinné.","realsys"),
        "email" => __("Zadejte platnou emailovou adresu.", "realsys"),
        "url" => __("Zadejte platné URL.", "realsys"),
        "date" => __("Zadejte platné datum.", "realsys"),
        "dateISO" => __("Zadejte platné datum.", "realsys"),
        "number" => __("Zadejte platné číslo.", "realsys"),
        "digits" => __("Zadejte platné číslice.", "realsys"),
        "creditcard" => __("Zadejte platné číslo kreditní karty.", "realsys"),
        "maxlength" => __('Zadejte maximálně {0} znaků.', "realsys"),
        "minlength" => __('Zadejte minimálně {0} znaků.', "realsys"),
        "range" => __('Zadejte hodnotu mezi {0} a {1}.', "realsys")
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
    'db_reference' => 'Text reference'
);


// EPAYMENT KONSTANTY
define( "TEST_MODE", true );
define( "GOPAY_INLINE", false);
define ("GOPAY_STANDARD_CALLBACK", home_url() . "/gopay/?action=confirmPayment");
define ("GOPAY_QUICK_CALLBACK", home_url() . "/gopay/?action=confirmQuickPayment");

require_once("model_controller_backend.php");

require_once("relations.php");


// CISELNIKY

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
	'uzivatelClass' => array(
		'db_stav'
	),
	'objednavkaClass' => array(
		'db_stav'
	),
    'vozidloClass' => array(
        'db_trida',
        'db_jednotka'
    )
);

$localDials = array(
	'obrazekClass' => array(
		'db_front' => array(
			0 => "Ne",
			1 => "ANO"
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
		"totoCisloNeniValidni" => __("Toto číslo není validní.","realsys"),
		"totoPscNeniValidni" => __("Toto PSČ není validní. Formát 123 45.","realsys"),
		"nahrajteSvujObrazek" => __("Nahrajte svůj obrázek","realsys"),
		"nacitani" => __("Načítání","realsys"),
		"uploadovani" => __("Uploadování","realsys"),
		"uspesneNahranoNaServer" => __("Úspěšně nahráno na server","realsys"),
		"zruseno" => __("Zrušeno","realsys"),
		"klepneteProZruseni" => __("Klepněte pro zrušení", "realsys"),
		"klepneteProOpakovani" => __("Klepněte pro opakování", "realsys")
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

$dispozice_options = array(
	__("1+KK", "realsys") => __("1+KK", "realsys"),
	__("1+1", "realsys") => __("1+1", "realsys"),
	__("2+1", "realsys") => __("2+1", "realsys"),
	__("3+1", "realsys") => __("3+1", "realsys"),
	__("4+1", "realsys") => __("4+1", "realsys"),
	__("5+1", "realsys") => __("5+1", "realsys"),
	__("Více než 6", "realsys") => __("Více než 6", "realsys"),
);


// FILTER PARAMETERS

$before24 = time() - 24*60*60;
$before_month = time() - 30*24*60*60;
$before_three_month = time() - 3*30*24*60*60;
$dispozice_filter_options = $dispozice_options;
$dispozice_filter_options[-1] = __("--Bez filtru--","realsys");

$filter_parameters = array(
	'db_typ_inzeratu' => array(
		'name' => __('Typ inzerátu',"realsys"),
		'type' => 'customswitcher',
		'values' => array()
	),
	'db_typ_stavby' => array(
		'name' => __("Typ stavby","realsys"),
		'type' => 'select',
		'values' => array()
	),
	'db_vybavenost' => array(
		'name' => __('Vybavenost',"realsys"),
		'type' => 'option',
		'values' => array()
	),
	'db_lokalita' => array(
		'name' => __('Lokalita',"realsys"),
		'type' => 'map-search',
		'values' => false,
		'class' => "js-autocomplete"
	),
	'db_cena' => array(
		'name' => __('Cena',"realsys"),
		'type' => 'slider',
		'values' => array(0,3000000)
	),
	'db_pocet_mistnosti' => array(
		'name' => __('Dispozice',"realsys"),
		'type' => 'select',
		'values' => $dispozice_filter_options
	),
	'db_podlahova_plocha' => array(
		'name' => __('Velikost',"realsys"),
		'type' => 'slider',
		'values' => array(0,255)
	),
	'db_datum_zalozeni' => array(
		'name' => __("Datum přidání inzerátu","realsys"),
		'type' => 'select-special',
		'values' => array(
			$before24 => array(
				'label' => __('Méně jak 24h',"realsys"),
				'operator' => '>'
			),
			$before_month => array(
				'label' => __('Méně jak 1 měsíc',"realsys"),
				'operator' => '>'
			),
			$before_three_month => array(
				'label' => __('Méně jak 3 měsíce',"realsys"),
				'operator' => '>'
			),
			-1 => array(
				'label' => __('--Bez filtru--',"realsys"),
				'operator' => '='
			)
		)
	),
	'db_balkon' => array(
		'name' => __("Balkón","realsys"),
		'type' => "checkbox",
		'values' => false
	),
	'db_garaz' => array(
		'name' => __("Garáž","realsys"),
		'type' => "checkbox",
		'values' => false
	),
	'db_vytah' => array(
		'name' => __("Výtah","realsys"),
		'type' => "checkbox",
		'values' => false
	),
	'db_terasa' => array(
		'name' => __("Terasa","realsys"),
		'type' => "checkbox",
		'values' => false
	),
	'db_parkovaci_misto' => array(
		'name' => __("Parkování","realsys"),
		'type' => "checkbox",
		'values' => false
	)
);

// FILTER HP PARAMETERS - filtery pro HP
$filter_hp_parameters = array(
	'db_typ_inzeratu',
	'db_pocet_mistnosti',
	'db_typ_stavby',
	'db_lokalita'
);


// CENIK TOPOVANI
$cenik = array(
	20 => 15,
	50 => 200,
	100 => 500,
	500 => 800
);

define("ALONE_CREDIT_PRICE", 4);


// Ceníky služeb
define("SLUZBA_HLIDACI_PES", 0);
define("SLUZBA_TOPOVANI_INZERATU", 1);

$cenik_sluzeb = array(
	0 => array(
		'id' => 0,
		'name' => __('Hlídací pes',"realsys"),
		'price' => 2
	),
	1 => array(
		'id' => 1,
		'name' => __('Topování inzerátu.',"realsys"),
		'logName' => 'Top inzerátu ID: %d',
		'price' => 1,
		'requireEntity' => true,
		'handleFunction' => "handleTopInzerat"
	),
	2 => array(
		'id' => 2,
		'name' => __('Zobrazení kontaktu',"realsys"),
		'logName' => 'Zobrazení kontaktu ID: %d',
		'price' => 3,
		'requireEntity' => true
	)
);

$patra_options = array(
	1 => __("1. patro", "realsys"),
	2 => __("2. patro", "realsys"),
	3 => __("3. patro", "realsys"),
	4 => __("4. patro", "realsys"),
	5 => __("5. patro", "realsys"),
	6 => __("6. patro", "realsys"),
	7 => __("7. patro", "realsys"),
	8 => __("8. patro", "realsys"),
	9 => __("9. patro", "realsys"),
	10 => __("10. patro", "realsys"),
	11 => __("11. patro", "realsys"),
	12 => __("12. patro", "realsys"),
	13 => __("13. patro", "realsys"),
	14 => __("14. patro", "realsys"),
	15 => __("15. patro", "realsys"),
);


$celkem_podlazi_options = array(
	1 => __("jednoho", "realsys"),
	2 => __("dvou", "realsys"),
	3 => __("tří", "realsys"),
	4 => __("čtyř", "realsys"),
	5 => __("pěti", "realsys"),
	6 => __("šesti", "realsys"),
	7 => __("sedmi", "realsys"),
	8 => __("osmi", "realsys"),
	9 => __("devíti", "realsys"),
	10 => __("deseti", "realsys"),
	11 => __("jedenácti", "realsys"),
	12 => __("dvanácti", "realsys"),
	13 => __("třinácti", "realsys"),
	14 => __("čtrnácti", "realsys"),
	15 => __("patnácti", "realsys"),
);


/* SENDING MAIL FROM */
define("SENDER_MAIL","info@yourpraguetransfer.cz");
define("SENDER_NAME", "Automat");