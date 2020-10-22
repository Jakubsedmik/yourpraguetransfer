<?php


class referenceController extends controller
{

    public function action() {
        $this->performView();
    }


    public function create() {

        if ( Tools::checkPresenceOfParam( "vytvorit", $this->requestData ) ) {
            $request_data = $this->requestData;
            $id           = false;

            $response = Tools::formProcessor(
                array(
                    "db_jmeno",
                    "db_pozice",
                    "db_reference"
                ),
                $request_data,
                'referenceClass',
                'create'
            );

            generateNewStrings();

            if ( $response === true ) {
                $this->requestData = array();
            }
        }

        $this->setView( "vytvoritReferenci" );
        $this->performView();
    }


    public function edit() {

        if ( Tools::checkPresenceOfParam( "id", $this->requestData ) ) {
            $id      = $this->requestData['id'];
            $reference = assetsFactory::getEntity( 'referenceClass', $id );
            if ( $reference !== false ) {
                $this->viewData['reference'] = $reference;
            }

            if ( Tools::checkPresenceOfParam( "ulozit", $this->requestData ) ) {
                $request_data = $this->requestData;

                $response = Tools::formProcessor(
                    array(
                        "db_id",
                        "db_jmeno",
                        "db_pozice",
                        "db_reference",
                        "db_datum_zalozeni"
                    ),
                    $request_data,
                    'referenceClass',
                    'edit'
                );

                generateNewStrings();
            }

        } else {
            frontendError::addMessage( "ID", ERROR, "Chybějící ID" );
        }
        $this->setView( "upravitReferenci" );
        $this->performView();
    }
}