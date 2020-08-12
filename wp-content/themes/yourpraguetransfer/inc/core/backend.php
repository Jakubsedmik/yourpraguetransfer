<?php


/* BACKEND INITIALIZE */



function mojeMenu(){
	$page_hook = add_menu_page("Inzeráty" , "Inzeráty", "publish_posts", PLUGIN_SLUG, "s7interface");
	add_action( 'load-' . $page_hook , 'my_ob_start');
}

/*
 * Funkce pro přesměrování uvnitř pluginu
 */
function my_ob_start() {
	//ob_start();
}

add_action( 'admin_menu', 'mojeMenu' );


function s7interface(){
	require_once __DIR__ . '/router.php';
	echo globalUtils::renderDebug();
}

function adminHeaders($hook){
	global $pluginUrl;
	// zařídí loadování assetů jen v pluginu
	if($hook != 'toplevel_page_' . PLUGIN_SLUG) {
		return;
	}

	// defaultní asset FA
	wp_enqueue_style("fa","https://use.fontawesome.com/releases/v5.8.2/css/all.css", array(), VERSION_LINKS);

	if(DEPLOYMENT){
		// Vše kromě bundle.js se kompiluje skrze GULP - gulp backend_styles, gulp backend_scripts - tyto ulohy
		// packují všechno o se nachází v src a vytváří komplet file v dist

		// CSS
		wp_enqueue_style("all_css", $pluginUrl . "/assets/css/css_backend/dist/main.min.css");

		// JS
		wp_enqueue_media();
		wp_enqueue_script("all_js", $pluginUrl . "/assets/js/js_backend/dist/main.min.js", array(), VERSION_LINKS, true);

		// VUE
		wp_enqueue_script("bundle_js", $pluginUrl . "/assets/js/js_backend/dist/bundle.js", array(), VERSION_LINKS, true);

	}else {
		// Pokud jsme na developmentu tak natahujeme všecko zvlášť abychom nemuseli spouštět bundler
		// bundler se pouští pouze v případě VUE.js a to vyustí v bundle_js, samotné vue je zabaleno i v bundle.js

		// CSS
		wp_enqueue_media();
		wp_enqueue_style("bootstrap_min_css", $pluginUrl . "/assets/css/css_backend/src/main.css");
		wp_enqueue_style("jquery_ui_css", $pluginUrl . "/assets/css/css_backend/src/jquery-ui.css");
		wp_enqueue_style("confirmpopup_css", $pluginUrl . "/assets/css/css_backend/src/confirmPopup.less");
		wp_enqueue_style("filepond_css", $pluginUrl . "/assets/css/css_backend/src/filepond.css");

		// JS
		wp_enqueue_script("jquery_min_js", $pluginUrl . "/assets/js/js_backend/src/jquery-3.4.1.js", array(), VERSION_LINKS, true);
		wp_enqueue_script("popper_min_js", $pluginUrl . "/assets/js/js_backend/src/popper.min.js", array("jquery_min_js"), VERSION_LINKS, true);
		wp_enqueue_script("bootstrap_min_js", $pluginUrl . "/assets/js/js_backend/src/bootstrap.min.js", array("popper_min_js"), VERSION_LINKS, true);
		wp_enqueue_script("mdb_min_js", $pluginUrl . "/assets/js/js_backend/src/mdb.js", array("bootstrap_min_js"), VERSION_LINKS, true);
		wp_enqueue_script("base_js", $pluginUrl . "/assets/js/js_backend/src/main.js", array("jquery_min_js"), VERSION_LINKS, true);
		wp_enqueue_script("jquery_ui_js", $pluginUrl . "/assets/js/js_backend/src/jquery-ui.js", array("jquery_min_js"), VERSION_LINKS, true);
		wp_enqueue_script("bundle_js", $pluginUrl . "/assets/js/js_backend/dist/bundle.js", array("jquery"), VERSION_LINKS, true);
		wp_enqueue_script("filepond_js", $pluginUrl . "/assets/js/js_backend/src/filepond.js", array("jquery"), VERSION_LINKS, true);
	}

}

add_action("admin_enqueue_scripts", "adminHeaders");