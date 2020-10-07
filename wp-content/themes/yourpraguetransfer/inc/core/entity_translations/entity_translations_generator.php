<?php


function generateNewStrings(){
    $entities = array(
        'vozidloClass' => array(
            'db_nazev',
            'db_popis'
        ),
        'referenceClass' => array(
            'db_pozice',
            'db_reference'
        ),
        'ciselnikClass' => array(
            'db_translation'
        )
    );

    $totalString = "<?php\r\n";

    foreach ($entities as $key => $value){
        $allEntities = assetsFactory::getAllEntity($key);
        foreach ($allEntities as $key1 => $value1){
            foreach ($value as $key2 => $value2){
                if(property_exists($value1, $value2)){
                    $totalString .= "__('" . $value1->$value2 . "','yourpraguetransfer');\r\n ";
                }
            }

        }
    }


    $totalString.= "\r\n ?>";

    $fp = fopen(__DIR__ . "/entity_translations.php", "w");
    fwrite($fp, $totalString);
}


