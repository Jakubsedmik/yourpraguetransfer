<?php

// RELATIONS
$relationships = array(
    "inzeratClass" => array(
        'db_uzivatel_id' => array(
            'class' => 'uzivatelClass',
        )
    ),
    "obrazekClass" => array(
        'db_entity_id' => array(
            'class' => 'vozidloClass',
        )
    ),
    "hlidacipesClass" => array(
        'db_uzivatel_id' => array(
            'class' => 'uzivatelClass'
        )
    ),
    "objednavkaClass" => array(
        'db_uzivatel_id' => array(
            'class' => 'uzivatelClass'
        )
    ),
    "transakceClass" => array(
        'db_id_odesilatel' => array(
            'class' => 'uzivatelClass'
        ),
        'db_id_prijemce' => array(
            'class' => 'uzivatelClass'
        )
    )
);