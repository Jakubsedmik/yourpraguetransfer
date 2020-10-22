<?php
define("VERSION_LINKS", "1.3");
session_start();
require_once (__DIR__ . "/inc/core/entity_translations/translationHandler.php");

/*
 * Core load
 */
require_once (__DIR__ . "/inc/core/main.php");
require_once (__DIR__ . '/Realsys_menu.php');

/*
 * Základní styly a skripty do FE
 */
function s7_scripts_styles() {
	global $ajax_localization;
	if(!DEPLOYMENT){

		// Pokud jsme na developmentu tak natahujeme všecko zvlášť abychom nemuseli spouštět bundler

		// CSS - kompiluje ho automaticky LESS Watcher (při změně, ale dist nevytváří, nutno sepnout GULP)
		wp_enqueue_style("main_css", site_url() . ASSETS_PATH . "css/css_frontend/main.css", array(), VERSION_LINKS);

		// JS
		wp_enqueue_script("jquery_js", site_url() . ASSETS_PATH . "js/js_frontend/jquery-3.5.1.min.js", array(), VERSION_LINKS, true);
        wp_enqueue_script("popper_js", site_url() . ASSETS_PATH . "js/js_frontend/popper.min.js", array('jquery_js'), VERSION_LINKS, true);
		wp_enqueue_script("bootstrap_js", site_url() . ASSETS_PATH . "js/js_frontend/bootstrap.min.js", array("jquery_js"), VERSION_LINKS, true);
        wp_enqueue_script("justifiedgallery_js", site_url() . ASSETS_PATH . "js/js_frontend/jquery.justifiedGallery.min.js", array("jquery_js"), VERSION_LINKS, true);


        wp_register_script("main_js",site_url() . ASSETS_PATH . "js/js_frontend/main.js", array("jquery_js", "popper_js", "bootstrap_js", "justifiedgallery_js"), VERSION_LINKS, true);
		wp_localize_script("main_js","serverData", $ajax_localization);
		wp_enqueue_script("main_js");

        // VUE CLI
        $vueDirectory    = join( "/", [ get_template_directory_uri(), 'assets', 'js', 'js_frontend' ,'vue', 'dist' ] );
        wp_register_style( 'backend-vue-style', $vueDirectory . '/app.css', array(), VERSION_LINKS );
        wp_register_script( 'backend-vue-script', $vueDirectory . '/app.js', [], VERSION_LINKS, true );
        wp_enqueue_style( 'backend-vue-style' );
        wp_enqueue_script( 'backend-vue-script' );

	}else{

		// Vše se kompiluje skrze GULP - gulp frontend_styles, gulp frontend_scripts - tyto úlohy
		// packují všechno co se nachází v src a vytváří komplet file v dist

		// CSS
		wp_enqueue_style("main_css", site_url() . ASSETS_PATH . "css/css_frontend/dist/main.min.css", array(), VERSION_LINKS);

		// JS
		wp_enqueue_script("main_js", site_url() . ASSETS_PATH . "js/js_frontend/dist/main.min.js", array(), VERSION_LINKS, true);

		// VUE - lepší být bokem
		wp_enqueue_script("bundle_js", ASSETS_PATH . "/js/js_frontend/dist/bundle.js", array("main_js"), VERSION_LINKS, true);
	}
}

add_action( 'wp_enqueue_scripts', 's7_scripts_styles' );


/** Detekuje provoz javascriptu v klientovi + FALLBACK*/
function s7_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 's7_javascript_detection', 0 );


/* Customizace pomocí theme editoru v adminu */
function s7_theme_editor($wp_customize){

	// SEKCE
	$wp_customize->add_section( 'main_setting' , array(
		'title'      => __( 'Vlastní nastavení šablony', 'realsys' ),
		'priority'   => 30,
	) );

	// DATA
	$wp_customize->add_setting( 'slider_text_main' , array(
		'default'   => 'Přeprava na zavolanou',
		'transport' => 'refresh',
	) );

	$wp_customize->add_setting( 'slider_text_secondary' , array(
		'default'   => 'Jednoduše Zvolte odkud pojedete a kam to bude a získejte okamžik nabídky',
		'transport' => 'refresh',
	) );

	$wp_customize->add_setting( 'slider_button_text' , array(
		'default'   => 'Vyhledat',
		'transport' => 'refresh',
	) );

    $wp_customize->add_setting( 'slider_perex_text' , array(
        'default'   => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus tristique posuere
                        mi vitae venenatis. Suspendisse viverra ligula diam, sed pellentesque
                        nunc luctus at. Phasellus pulvinar sagittis',
        'transport' => 'refresh',
    ) );

    // SLIDER COVID
    $wp_customize->add_setting( 'slider_covid_text' , array(
        'default'   => '<strong class="text-white">Covid19 </strong>opatření',
        'transport' => 'refresh',
    ) );

    $wp_customize->add_setting( 'slider_covid_url' , array(
        'default'   => '/',
        'transport' => 'refresh',
    ) );


    // DATA USPS
	$wp_customize->add_setting( 'usp1' , array(
		'default'   => 'PITÍ ZDARMA',
		'transport' => 'refresh',
	) );

	$wp_customize->add_setting( 'usp2' , array(
		'default'   => 'PLATBA ONLINE',
		'transport' => 'refresh',
	) );

	$wp_customize->add_setting( 'usp3' , array(
		'default'   => 'BEZPEČNOST',
		'transport' => 'refresh',
	) );

	$wp_customize->add_setting( 'usp4' , array(
		'default'   => 'WIFI NA PALUBĚ',
		'transport' => 'refresh',
	) );

	$wp_customize->add_setting( 'usp5' , array(
		'default'   => 'NONSTOP 24/7',
		'transport' => 'refresh',
	) );


	/* VOZOVY PARK */
	$wp_customize->add_setting( 'vozovy_park_title' , array(
		'default'   => 'Náš vozový park',
		'transport' => 'refresh',
	) );

	$wp_customize->add_setting( 'vozovy_park_subtitle' , array(
		'default'   => 'Podívejte se, jakými vozy se u nás můžete svést. Vyberte si z naší nabídky přímo na míru.',
		'transport' => 'refresh',
	) );

	$wp_customize->add_setting( 'vsechny_vozy' , array(
		'default'   => 'Všechny vozy',
		'transport' => 'refresh',
	) );

	/* KLIENTSKE REFERENCE */
	$wp_customize->add_setting( 'klientske_reference_title' , array(
		'default'   => 'Klientské reference',
		'transport' => 'refresh',
	) );

    $wp_customize->add_setting( 'klientske_reference_subtitle' , array(
        'default'   => 'Nejste si jistí? Naše reference to řeknou za nás.',
        'transport' => 'refresh',
    ) );

	/* JSME JEDNIČKA */
	$wp_customize->add_setting( 'jsme_jednicka_title' , array(
        'default'   => 'Jsme jednička na trhu',
		'transport' => 'refresh',
	) );

    $wp_customize->add_setting( 'jsme_jednicka_subtitle' , array(
        'default'   => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam risus nunc, pellentesque in venenatis sed, fermentum vitae nibh. Aliquam convallis pulvinar massa in rutrum',
        'transport' => 'refresh',
    ) );

    /* KONTAKT */
    $wp_customize->add_setting( 'kontakt_title' , array(
        'default'   => 'Kontakt',
        'transport' => 'refresh',
    ) );

    $wp_customize->add_setting( 'kontakt_subtitle' , array(
        'default'   => 'Rezervujte si jízdu přímo na našem dispečinku. Neváhejte zavolat.',
        'transport' => 'refresh',
    ) );

    $wp_customize->add_setting( 'telefon' , array(
        'default'   => '+420 722 855 989',
        'transport' => 'refresh',
    ) );

    $wp_customize->add_setting( 'email' , array(
        'default'   => 'info@yourpraguetransfers.cz',
        'transport' => 'refresh',
    ) );

    $wp_customize->add_setting( 'adresa' , array(
        'default'   => 'Evropská 27, 247 89, Praha 6',
        'transport' => 'refresh',
    ) );

    $wp_customize->add_setting( 'neco_o_nas_title' , array(
        'default'   => 'Něco o nás',
        'transport' => 'refresh',
    ) );

    $wp_customize->add_setting( 'neco_o_nas_subtitle' , array(
        'default'   => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida.',
        'transport' => 'refresh',
    ) );

    $wp_customize->add_setting( 'vice_o_nas_button' , array(
        'default'   => 'Více o nás',
        'transport' => 'refresh',
    ) );


	// KONTROLKY

    // slider
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'slider_text_main_control', array(
		'label'      => __( 'Hlavní nadpis slider', 'realsys' ),
		'description' => __("Hlavní nadpis ve slideru"),
		'section'    => 'main_setting',
		'settings'   => 'slider_text_main',
		'type' => 'text'
	)));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'slider_text_secondary_control', array(
		'label'      => __( 'Podnadpis slider', 'realsys' ),
		'description' => __("Podnadpis slider"),
		'section'    => 'main_setting',
		'settings'   => 'slider_text_secondary',
		'type' => 'text'
	)));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'slider_button_text_control', array(
		'label'      => __( 'Tlačítko ve slideru', 'realsys' ),
		'description' => __("Tlačítko ve slideru"),
		'section'    => 'main_setting',
		'settings'   => 'slider_button_text'
	)));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'slider_perex_text_control', array(
		'label'      => __( 'Perex slider', 'realsys' ),
		'description' => __("Hutný text pod vyhledat"),
		'section'    => 'main_setting',
		'settings'   => 'slider_perex_text',
        'type' => 'textarea'
	)));

	// USP
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'usp1_control', array(
		'label'      => __( 'USP1', 'realsys' ),
		'description' => __("Pití zdarma"),
		'section'    => 'main_setting',
		'settings'   => 'usp1',
	)));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'usp2_control', array(
		'label'      => __( 'USP2', 'realsys' ),
		'description' => __("Platba online"),
		'section'    => 'main_setting',
		'settings'   => 'usp2',
	)));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'usp3_control', array(
		'label'      => __( 'USP3', 'realsys' ),
		'description' => __("Bezpečnost"),
		'section'    => 'main_setting',
		'settings'   => 'usp3'
	)));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'usp4_control', array(
		'label'      => __( 'USP4', 'realsys' ),
		'description' => __("Wifi na palubě"),
		'section'    => 'main_setting',
		'settings'   => 'usp4'
	)));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'usp5_control', array(
		'label'      => __( 'USP5', 'realsys' ),
		'description' => __("Nonstop 24/7"),
		'section'    => 'main_setting',
		'settings'   => 'usp5'
	)));


	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'vozovy_park_title_control', array(
		'label'      => __( 'Vozový park', 'realsys' ),
		'description' => __("Vozový park hlavní nadpis"),
		'section'    => 'main_setting',
		'settings'   => 'vozovy_park_title'
	)));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'vozovy_park_subtitle_control', array(
		'label'      => __( 'Vozový park podnadpis', 'realsys' ),
		'description' => __("Vozový park podnadpis"),
		'section'    => 'main_setting',
		'settings'   => 'vozovy_park_subtitle'
	)));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'vsechny_vozy_control', array(
		'label'      => __( 'Všechny vozy tlačítko', 'realsys' ),
		'description' => __("Tlačítko všechny vozy"),
		'section'    => 'main_setting',
		'settings'   => 'vsechny_vozy'
	)));

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'slider_covid_text_control', array(
        'label'      => __( 'COVID19 Text', 'realsys' ),
        'description' => __("COVID19 Tlačítko text"),
        'section'    => 'main_setting',
        'settings'   => 'slider_covid_text'
    )));

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'slider_covid_url_control', array(
        'label'      => __( 'COVID19 Link', 'realsys' ),
        'description' => __("COVID19 Link tlačítko"),
        'section'    => 'main_setting',
        'settings'   => 'slider_covid_url'
    )));

	// Klientske reference

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'klientske_reference_title_control', array(
		'label'      => __( 'Klientské reference', 'realsys' ),
		'description' => __("Nadpis klientské reference"),
		'section'    => 'main_setting',
		'settings'   => 'klientske_reference_title'
	)));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'klientske_reference_subtitle_control', array(
		'label'      => __( 'Klientské reference', 'realsys' ),
		'description' => __("Podnadpis klientské reference"),
		'section'    => 'main_setting',
		'settings'   => 'klientske_reference_subtitle'
	)));


	// Jsme jednička

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'jsme_jednicka_title_control', array(
        'label'      => __( 'Jsme jednička na trhu', 'realsys' ),
        'description' => __("Jsme jednička na trhu nadpis"),
        'section'    => 'main_setting',
        'settings'   => 'jsme_jednicka_title'
    )));

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'jsme_jednicka_subtitle_control', array(
        'label'      => __( 'Jsme jednička na trhu', 'realsys' ),
        'description' => __("Jsme jednička na trhu podnadpis"),
        'section'    => 'main_setting',
        'settings'   => 'jsme_jednicka_subtitle'
    )));


    // Kontakt

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'kontakt_title_control', array(
        'label'      => __( 'Kontakt', 'realsys' ),
        'description' => __("Kontakt nadpis"),
        'section'    => 'main_setting',
        'settings'   => 'kontakt_title'
    )));

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'kontakt_subtitle_control', array(
        'label'      => __( 'Kontakt', 'realsys' ),
        'description' => __("Kontakt podnadpis"),
        'section'    => 'main_setting',
        'settings'   => 'kontakt_subtitle'
    )));

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'telefon_control', array(
        'label'      => __( 'Telefon', 'realsys' ),
        'description' => __("Telefon"),
        'section'    => 'main_setting',
        'settings'   => 'telefon'
    )));

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'email_control', array(
        'label'      => __( 'Email', 'realsys' ),
        'description' => __("Email"),
        'section'    => 'main_setting',
        'settings'   => 'email'
    )));

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'adresa_control', array(
        'label'      => __( 'Adresa', 'realsys' ),
        'description' => __("Adresa"),
        'section'    => 'main_setting',
        'settings'   => 'adresa'
    )));

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'neco_o_nas_title_control', array(
        'label'      => __( 'Něco o nás', 'realsys' ),
        'description' => __("Něco o nás nadpis"),
        'section'    => 'main_setting',
        'settings'   => 'neco_o_nas_title'
    )));

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'neco_o_nas_subtitle_control', array(
        'label'      => __( 'Něco o nás', 'realsys' ),
        'description' => __("Něco o nás perex"),
        'section'    => 'main_setting',
        'settings'   => 'neco_o_nas_subtitle'
    )));

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'vice_o_nas_button_control', array(
        'label'      => __( 'Něco o nás', 'realsys' ),
        'description' => __("Více o nás button"),
        'section'    => 'main_setting',
        'settings'   => 'vice_o_nas_button'
    )));



}
add_action("customize_register", "s7_theme_editor");



/* Registrace menu do webu */
function s7_registrace_menu(){
    register_nav_menu("cms_header_menu","CMS menu v hlavičce webu");
    register_nav_menu("cms_header_menu_en","CMS menu v hlavičce webu (anglické)");
	register_nav_menu("category_header_menu","Menu pro kategorie v hlavičce");
}
add_action( 'after_setup_theme', 's7_registrace_menu' );

/* Registrace widgetů */
register_sidebar(array(
	'id' => 'first_footer_col',
	'name' => 'Patička 1',
	'description' => 'Patička sloupec 1',
	'class' => 'col-lg-2 col-md-6 col-12',
	'before_widget' => '<div class="s7_footer-col-menu">',
	'after_widget' => '</div>',
	'before_title' => '<h3>',
	'after_title' => '</h3>'
));

register_sidebar(array(
	'id' => 'second_footer_col',
	'name' => 'Patička 2',
	'description' => 'Patička sloupec 2',
	'class' => 'col-lg-3 col-md-6 col-12',
	'before_title' => '<h3>',
	'after_title' => '</h3>',
    'before_widget' => '',
    'after_widget' => '',
));

register_sidebar(array(
	'id' => 'third_footer_col',
	'name' => 'Patička 3',
	'description' => 'Patička sloupec 3',
	'class' => 'col-lg-4 col-md-6 col-12',
	'before_title' => '<h3>',
	'after_title' => '</h3>',
    'before_widget' => '',
    'after_widget' => '',
));

register_sidebar(array(
	'id' => 'fourth_footer_col',
	'name' => 'Patička 4',
	'description' => 'Patička sloupec 4',
	'class' => 'col-lg-3 col-md-6 col-12',
	'before_title' => '<h3>',
	'after_title' => '</h3>',
    'before_widget' => '',
    'after_widget' => '',
));



/* DEAKTIVATE AUTOP Z POSTU */
remove_filter('widget_text_content', 'wpautop');


/* THEME SUPPORTS */
add_theme_support("title_tag");
add_theme_support('custom-logo', array(
    'width'       => 422,
    'flex-width' => false,
	'flex-height' => true
));
add_theme_support( 'post-thumbnails', array("post", "page"));
add_theme_support( 'html5' );

set_post_thumbnail_size( 700, 500,true);

/* NASTAVENÍ CONTENT TYPE PRO MAILY */
function wpse27856_set_content_type(){
    return "text/html";
}
add_filter( 'wp_mail_content_type','wpse27856_set_content_type' );

/* REMOVE EMOJIS */
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );



/* ZMĚNA ODESÍLACÍHO MAILU WP */
function change_my_from_address( $original_email_address ) {
	return SENDER_MAIL;
}
add_filter( 'wp_mail_from', 'change_my_from_address' );

function change_my_sender_name( $original_email_from ) {
	return SENDER_NAME;
}
add_filter( 'wp_mail_from_name', 'change_my_sender_name' );


/* DEAKTIVACE AKTUALIZACÍ */
add_filter( 'auto_update_plugin', '__return_false' );
add_filter( 'auto_update_theme', '__return_false' );

/* GUTTENBERG */
add_theme_support( 'align-wide' );
add_theme_support( 'editor-styles' );
add_editor_style( 'style-editor.css' );


/* TRANSLATIONS AUTOMATION */
require_once (__DIR__ . "/inc/core/entity_translations/entity_translations_generator.php");


