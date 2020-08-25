<?php


class zonaController extends controller
{

    public function action()
    {
        $this->performView();
    }


    public function create() {

        if ( Tools::checkPresenceOfParam( "vytvorit", $this->requestData ) ) {
            $request_data = $this->requestData;

            if(Tools::checkPresenceOfParam("map_json",$this->requestData)){

                $map_json = $this->requestData['map_json'];
                $map_json = stripslashes($map_json);
                $map_json = json_decode($map_json);

                $available_types = array(
                    "db_administrative_area_level_1" => "*",
                    "db_administrative_area_level_2" => "*",
                    "db_administrative_area_level_3" => "*",
                    "db_administrative_area_level_4" => "*",
                    "db_administrative_area_level_5" => "*",
                    "db_locality" => "*",
                    "db_neighborhood" => "*",
                    "db_sublocality" => "*",
                    "db_sublocality_level_1" => "*",
                    "db_sublocality_level_2" => "*",
                    "db_sublocality_level_3" => "*",
                    "db_sublocality_level_4" => "*",
                    "db_sublocality_level_5" => "*"
                );

                $final_arr = $available_types;

                foreach ($map_json as $component_index => $component){
                    foreach ($available_types as $type_index => $type){
                        $new_type = str_replace("db_","", $type_index);
                        if(array_search($new_type, $component->types) !== false){
                            $final_arr[$type_index] = $component->long_name;
                        }
                    }
                }

                globalUtils::writeDebug($final_arr);


            }

            $id           = false;

            $response = Tools::formProcessor(
                array(
                    "db_nazev",
                    "db_trida",
                    "db_max_zavazadel",
                    "db_max_osob",
                    "db_hvezdy",
                    "db_cena_za_jednotku",
                    "db_jednotka",
                    "db_top",
                ),
                $request_data,
                'zonaClass',
                'create'
            );
        }

        $this->setView( "vytvoritZonu" );
        $this->performView();
    }

}