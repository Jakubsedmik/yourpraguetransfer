<?php


class cenikController extends controller
{

    public function action()
    {
        $this->performView();
    }

    public function create() {

        if ( Tools::checkPresenceOfParam( "vytvorit", $this->requestData ) ) {
            $request_data = $this->requestData;
            $id           = false;


            $response = Tools::formProcessor(
                array(
                    "db_zona_id",
                    "db_nazev",
                    "db_cena_tam",
                    "db_cena_zpet",
                    "db_max_osob",
                    "db_min_osob",
                    "db_vozidlo_id",
                ),
                $request_data,
                'cenikClass',
                'create'
            );
        }

        $this->setView( "vytvoritCenik" );
        $this->performView();
    }


    public function edit() {

        if ( Tools::checkPresenceOfParam( "id", $this->requestData ) ) {
            $id      = $this->requestData['id'];
            $cenik = assetsFactory::getEntity( 'cenikClass', $id );
            if ( $cenik !== false ) {
                $this->viewData['cenik'] = $cenik;
            }

            if ( Tools::checkPresenceOfParam( "ulozit", $this->requestData ) ) {
                $request_data = $this->requestData;

                $response = Tools::formProcessor(
                    array(
                        "db_id",
                        "db_nazev",
                        "db_zona_id",
                        "db_cena_tam",
                        "db_cena_zpet",
                        "db_max_osob",
                        "db_min_osob",
                        "db_vozidlo_id"
                    ),
                    $request_data,
                    'cenikClass',
                    'edit'
                );
            }

        } else {
            frontendError::addMessage( "ID", ERROR, "Chybějící ID" );
        }
        $this->setView( "upravCenik" );
        $this->performView();
    }
}