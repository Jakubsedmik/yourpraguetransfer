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
                    "db_pocet_hvezd",
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
                $this->requestData['continue'] = Tools::getRoute( "inzeratClass", "edit", Tools::$last_created->getId() ) . "#addImages";
            }
        }

        $this->setView( "vytvoritVozidlo" );
        $this->performView();
    }

}