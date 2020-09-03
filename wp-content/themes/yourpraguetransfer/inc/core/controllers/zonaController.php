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

            $polygons = array();
            foreach ($this->requestData as $key => $value){
                if(strpos($key, "polygon") !== false){
                    $polygons[] = json_decode(stripslashes($value));
                }
            }

            if(count($polygons) > 0){
                $creation_array = array(
                    "db_nazev" => $this->requestData['db_nazev'],
                    "db_zone_polygon" => $polygons
                );

                $id = false;

                $response = Tools::formProcessor(
                    array(
                        "db_nazev",
                        "db_zone_polygon"
                    ),
                    $creation_array,
                    'zonaClass',
                    'create'
                );
            }else{

            }
        }

        $allZones = assetsFactory::getAllEntity("zonaClass");
        $allPolygons = array();
        foreach ($allZones as $zone_key => $zone_value){
            foreach ($zone_value->db_zone_polygon as $polygon_index => $polygon_value){
                $allPolygons[] = $polygon_value;
            }
        }

        $this->viewData['all_polygons'] = $allPolygons;

        $this->setView( "vytvoritZonu" );
        $this->performView();
    }

    public function edit() {

        if ( Tools::checkPresenceOfParam( "id", $this->requestData ) ) {
            $id      = $this->requestData['id'];

            $allZones = assetsFactory::getAllEntity("zonaClass", array(new filterClass("id","!=", $id)));
            $allPolygons = array();
            foreach ($allZones as $zone_key => $zone_value){
                foreach ($zone_value->db_zone_polygon as $polygon_index => $polygon_value){
                    $allPolygons[] = $polygon_value;
                }
            }

            $this->viewData['all_polygons'] = $allPolygons;

            $zona = assetsFactory::getEntity( 'zonaClass', $id );
            if ( $zona !== false ) {
                $this->viewData['zona'] = $zona;
            }

            if ( Tools::checkPresenceOfParam( "ulozit", $this->requestData ) ) {
                $request_data = $this->requestData;

                $polygons = array();
                foreach ($this->requestData as $key => $value){
                    if(strpos($key, "polygon") !== false){
                        $polygons[] = json_decode(stripslashes($value));
                    }
                }

                if(count($polygons) > 0){
                    $creation_array = array(
                        "db_id" => $id,
                        "db_nazev" => $this->requestData['db_nazev'],
                        "db_zone_polygon" => $polygons
                    );
                }

                $response = Tools::formProcessor(
                    array(
                        "db_id",
                        "db_nazev",
                        "db_zone_polygon"
                    ),
                    $creation_array,
                    'zonaClass',
                    'edit'
                );
            }

        } else {
            frontendError::addMessage( "ID", ERROR, "Chybějící ID" );
        }


        $this->setView( "upravZonu" );
        $this->performView();
    }

}