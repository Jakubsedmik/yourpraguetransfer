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

            $destination_from = $this->requestData['destination_from'];
            $destination_to = $this->requestData['destination_to'];

            $lat_lng_from = Tools::geocodeAdress($destination_from);
            $lat_lng_to = Tools::geocodeAdress($destination_to);

            $this->workData['destination_from'] = $destination_from;
            $this->workData['destination_to'] = $destination_to;
            $this->workData['lat_lng_from'] = $lat_lng_from;
            $this->workData['lat_lng_to'] = $lat_lng_to;
            return true;

        }else{
            frontendError::addMessage("Destination",ERROR, "Chybějící parametry aplikace");
            $this->setView("error");
            return false;
        }
    }
}