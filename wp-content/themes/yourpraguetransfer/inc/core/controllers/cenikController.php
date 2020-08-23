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
                'cenikClass',
                'create'
            );
        }

        $this->setView( "vytvoritCenik" );
        $this->performView();
    }
}