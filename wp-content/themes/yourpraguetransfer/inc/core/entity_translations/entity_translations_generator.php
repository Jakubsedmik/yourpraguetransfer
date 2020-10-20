<?php


function generateNewStrings(){
    global $translation_entities;

    $totalString = "<?php\r\n";

    foreach ($translation_entities as $key => $value){
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


