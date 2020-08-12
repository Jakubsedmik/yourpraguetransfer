<?php

    require_once (__DIR__ . "/../configuration/vue-translations.php");
    $options = new stdClass();
    global $celkem_podlazi_options, $patra_options, $dispozice_options;


    $typ_inzeratu = assetsFactory::getAllDials( "inzeratClass", "typ_inzeratu" );
    $typ_stavby = assetsFactory::getAllDials( "inzeratClass", "typ_stavby" );
    $vybavenost = assetsFactory::getAllDials( "inzeratClass", "vybavenost" );
    $stav_objektu = assetsFactory::getAllDials( "inzeratClass", "stav_objektu" );
    $typ_vlastnictvi = assetsFactory::getAllDials( "inzeratClass", "typ_vlastnictvi" );
    $material = assetsFactory::getAllDials( "inzeratClass", "material" );
    $penb = assetsFactory::getAllDials( "inzeratClass", "penb" );


    $options->typ_inzeratu = $typ_inzeratu;
    $options->typ_stavby = $typ_stavby;
    $options->vybavenost = $vybavenost;
    $options->stav_objektu = $stav_objektu;
    $options->typ_vlastnictvi = $typ_vlastnictvi;
    $options->material = $material;
    $options->penb = $penb;
    $options->patro = $patra_options;
    $options->celkem_podlazi = $celkem_podlazi_options;
    $options->dispozice = $dispozice_options;
?>

<section>
    <div class="app">
        <Pridatinzerat
                :options="<?php echo Tools::prepareJsonToOutputHtmlAttr($options); ?>"
                :uzivatelid="<?php echo uzivatelClass::getUserLoggedId(); ?>"
                :translations="<?php echo Tools::prepareJsonToOutputHtmlAttr($pridat_inzerat_translations); ?>"
                ajax_url="<?php echo AJAXURL; ?>"
                frontend_images_path="<?php echo FRONTEND_IMAGES_PATH; ?>"
                currency_code="<?php echo CURRENCY_CODE; ?>"
                lang_code="<?php echo LANG_CODE; ?>"
                currency="<?php echo CURRENCY; ?>"
                v-cloak
        ></Pridatinzerat>
    </div>

</section>
