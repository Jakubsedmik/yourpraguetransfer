<?php
    require_once (__DIR__ . "/../configuration/vue-translations.php");
    $vypis_merged_translations = array_merge($vypis_translations, $servicebuy_translations, $watchdog_translations);
?>

<div class="app">
    <Vypis
            assetspath="<?php echo FRONTEND_IMAGES_PATH; ?>"
            apiurl="<?php echo AJAXURL . "?action=getInzeraty"; ?>"
            home_url="<?php echo home_url(); ?>"
            login_link="<?php echo Tools::getFERoute( "uzivatelClass", false, "login" ); ?>"
            payment_link="<?php echo Tools::getFERoute( "objednavkaClass" ); ?>"
            ajax_url="<?php echo AJAXURL; ?>"

            :filters="<?php echo $this->requestData['filter']; ?>"
            :filterpreset="<?php echo $this->requestData['filterPreset']; ?>"
            :user_logged="<?php echo ( uzivatelClass::getUserLoggedId() ) ? uzivatelClass::getUserLoggedId() : 'false'; ?>"
            :service="<?php global $cenik_sluzeb; echo Tools::prepareJsonToOutputHtmlAttr( $cenik_sluzeb[0] ); ?>"
            :translations="<?php echo Tools::prepareJsonToOutputHtmlAttr($vypis_merged_translations); ?>"
            <?php if(isset($this->requestData['location'])) : ?>
            :location="<?php echo Tools::prepareJsonToOutputHtmlAttr($this->requestData['location']); ?>"
            <?php endif; ?>
            v-cloak
    >
    </Vypis>
</div>

<?php Pixel::PixelSearch(); ?>