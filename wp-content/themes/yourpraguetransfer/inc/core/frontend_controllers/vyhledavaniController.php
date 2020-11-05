<?php

class vyhledavaniController extends frontendController
{

    public function beforeHeadersAction()
    {
        // TODO: Implement beforeHeadersAction() method.
    }

    public function action()
    {


        if(Tools::checkPresenceOfParam("destination_from", $this->requestData) && Tools::checkPresenceOfParam("destination_to",$this->requestData)){


            $kurz = Tools::getEURRatio();

            $destination_from = $this->requestData['destination_from'];
            $destination_to = $this->requestData['destination_to'];

            $lat_lng_from = Tools::geocodeAdress($destination_from);
            $lat_lng_to = Tools::geocodeAdress($destination_to);

            $this->workData['destination_from'] = $destination_from;
            $this->workData['destination_to'] = $destination_to;
            $this->workData['destination_from_lat_lng'] = $lat_lng_from;
            $this->workData['destination_to_lat_lng'] = $lat_lng_to;
            $this->workData['eur_ratio'] = $kurz;


            require_once (__DIR__. "/../configuration/vue-translations.php");
            $this->workData['vyhledavani_translations'] = $vyhledavani_translations;

            return true;

        }else{
            frontendError::addMessage(__("Destination","yourpraguetransfer"),ERROR, __("Chybějící parametry aplikace","yourpraguetransfer"));
            $this->setView("error");
            return false;
        }
    }
}