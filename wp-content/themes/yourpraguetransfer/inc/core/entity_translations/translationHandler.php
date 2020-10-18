<?php

// LANGUAGES
$languages = array(
    0 => array(
        'code' => 'en_US',
        'label' => "Anglicky",
        'label_image' => get_template_directory_uri() . "/assets/images/images_frontend/english.jpg"
    ),
    1 => array(
        'code' => 'cs_CZ',
        'label' => "Česky",
        'label_image' => get_template_directory_uri() . "/assets/images/images_frontend/czech.jpg"
    )
);

power_up_translations();

function power_up_translations () {
    global $languages;

    if(isset($_GET['lang'])){
        $_SESSION['language_fe'] = $_GET['lang'];
    }

    if(isset($_SESSION['language_fe'])){
        switch_to_locale($_SESSION['language_fe']);
    }else{
        switch_to_locale("cs_CZ");
    }

}
