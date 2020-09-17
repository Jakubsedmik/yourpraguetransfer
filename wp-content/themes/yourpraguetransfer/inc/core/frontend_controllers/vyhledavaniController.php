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


            $posledniUpdate = get_option("kurz_cas");
            $nyni = time();

            if($posledniUpdate){
                $rozdil = $nyni - $posledniUpdate;
                if(($rozdil/60/60/24) <= 1){
                    $kurz = get_option("kurz");
                }else{
                    $kurz = Tools::getEURRatio();
                    add_option("kurz_cas", time());
                    add_option("kurz", $kurz);
                }
            }else{
                $kurz = Tools::getEURRatio();
                add_option("kurz_cas", time());
                add_option("kurz", $kurz);
            }

            $destination_from = $this->requestData['destination_from'];
            $destination_to = $this->requestData['destination_to'];

            $lat_lng_from = Tools::geocodeAdress($destination_from);
            $lat_lng_to = Tools::geocodeAdress($destination_to);

            $this->workData['destination_from'] = $destination_from;
            $this->workData['destination_to'] = $destination_to;
            $this->workData['destination_from_lat_lng'] = $lat_lng_from;
            $this->workData['destination_to_lat_lng'] = $lat_lng_to;
            $this->workData['eur_ratio'] = $kurz-1;
            return true;

        }else{
            frontendError::addMessage("Destination",ERROR, "Chybějící parametry aplikace");
            $this->setView("error");
            return false;
        }
    }
}