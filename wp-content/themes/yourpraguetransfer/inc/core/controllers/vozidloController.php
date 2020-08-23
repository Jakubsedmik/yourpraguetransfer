<?php


class vozidloController extends controller {

    public function action() {
        $this->performView();
    }


    public function create() {

        if ( Tools::checkPresenceOfParam( "vytvorit", $this->requestData ) ) {
            $request_data = $this->requestData;
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
                'vozidloClass',
                'create'
            );

            if ( $response === true ) {
                $this->requestData             = array();
                $this->requestData['continue'] = Tools::getRoute( "vozidloClass", "edit", Tools::$last_created->getId() ) . "#addImages";
            }
        }

        $this->setView( "vytvoritVozidlo" );
        $this->performView();
    }

    public function edit() {

        if ( Tools::checkPresenceOfParam( "id", $this->requestData ) ) {
            $id      = $this->requestData['id'];
            $vozidlo = assetsFactory::getEntity( 'vozidloClass', $id );
            if ( $vozidlo !== false ) {
                $this->viewData['vozidlo'] = $vozidlo;
            }

            if ( Tools::checkPresenceOfParam( "ulozit", $this->requestData ) ) {
                $request_data = $this->requestData;

                $response = Tools::formProcessor(
                    array(
                        "db_id",
                        "db_nazev",
                        "db_trida",
                        "db_max_zavazadel",
                        "db_max_osob",
                        "db_hvezdy",
                        "db_cena_za_jednotku",
                        "db_jednotka",
                        "db_top",
                        "db_datum_zalozeni"
                    ),
                    $request_data,
                    'vozidloClass',
                    'edit'
                );
            }

        } else {
            frontendError::addMessage( "ID", ERROR, "Chybějící ID" );
        }
        $this->setView( "upravVozidlo" );
        $this->performView();
    }

}