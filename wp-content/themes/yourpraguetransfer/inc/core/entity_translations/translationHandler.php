<?php

// LANGUAGES
$languages = array(
    0 => array(
        'code' => 'en_US',
        'label' => "Anglicky",
        'label_image' => get_template_directory_uri() . "/assets/images/images_frontend/english.jpg",
        'prefered_currency' => 'EUR'
    ),
    1 => array(
        'code' => 'cs_CZ',
        'label' => "Česky",
        'label_image' => get_template_directory_uri() . "/assets/images/images_frontend/czech.jpg",
        'prefered_currency' => 'CZK'
    )
);

power_up_translations();

function power_up_translations () {
    global $languages;
    $prefered_currency = false;

    if(isset($_GET['lang'])){
        $language_exist = false;
        foreach ($languages as $key => $value){
            if($_GET['lang'] == $value['code']){
                $language_exist = $key;
            }
        }

        if(is_numeric($language_exist) && $language_exist!== false){
            $_SESSION['language_fe'] = $_GET['lang'];
            if(isset($languages[$language_exist]['prefered_currency'])){
                $prefered_currency = $languages[$language_exist]['prefered_currency'];
            }
        }
    }

    if($prefered_currency !== false){
        define("PREFERED_CURRENCY_CODE", $prefered_currency);
        define("PREFERED_CURRENCY", $prefered_currency);
    }

    if(isset($_SESSION['language_fe'])){
        switch_to_locale($_SESSION['language_fe']);
    }else{
        switch_to_locale("cs_CZ");
    }

}
