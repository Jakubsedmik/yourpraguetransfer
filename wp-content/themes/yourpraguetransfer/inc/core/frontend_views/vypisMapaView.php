<?php
require_once( __DIR__ . "/../configuration/vue-translations.php" );
?>

<script src="https://unpkg.com/@google/markerclustererplus@4.0.1/dist/markerclustererplus.min.js"></script>

<div class="app">
    <VyhledavaniMapa

            assetspath="<?php echo FRONTEND_IMAGES_PATH; ?>"
            apiurl="<?php echo AJAXURL . "?action=getInzeraty"; ?>"
            home_url="<?php echo home_url(); ?>"
            login_link="<?php echo Tools::getFERoute( "uzivatelClass", false, "login" ); ?>"
            payment_link="<?php echo Tools::getFERoute( "objednavkaClass" ); ?>"
            ajax_url="<?php echo AJAXURL; ?>"

            :filters="<?php echo $this->requestData['filter']; ?>"
            :filterpreset="<?php echo $this->requestData['filterPreset']; ?>"
            :user_logged="<?php echo ( uzivatelClass::getUserLoggedId() ) ? uzivatelClass::getUserLoggedId() : 'false'; ?>"
            :service="<?php global $cenik_sluzeb;
			echo Tools::prepareJsonToOutputHtmlAttr( $cenik_sluzeb[0] ); ?>"
            :translations="<?php echo Tools::prepareJsonToOutputHtmlAttr( array_merge($vypis_translations, $watchdog_translations, $servicebuy_translations)); ?>"

            v-cloak
    ></VyhledavaniMapa>
</div>
