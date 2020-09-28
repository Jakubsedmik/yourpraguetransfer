<?php


class vozidloClass extends zakladniKamenClass
{

    protected $db_nazev;
    protected $db_popis;
    protected $db_letistni_transfer;
    protected $db_trida;
    protected $db_hvezdy;

    protected $db_top;
    protected $db_wifi;
    protected $db_voda;
    protected $db_vyzvednuti;
    protected $db_klimatizace;
    protected $db_voucher;

    protected $db_max_osob;
    protected $db_max_zavazadel;
    protected $db_cena_za_jednotku;
    protected $db_jednotka;

    protected function zakladniVypis()
    {
        // TODO: Implement zakladniVypis() method.
    }

    protected function zakladniHtmlVypis()
    {
        // TODO: Implement zakladniHtmlVypis() method.
    }

    public function getTableName()
    {
        return "s7_vozidlo";
    }

    public function getInterfaceTypes() {
        return array(
            "db_id" => "number",
            "db_nazev" => "string",
            "db_trida" => "string",

        );
    }


    public static function calculateComplexPrice($car_id, $destination_from, $destination_to, $persons, $way_option, $duration, $distance, $currency){

        $response = new stdClass();
        $car = assetsFactory::getEntity("vozidloClass", $car_id);

        $lat_lng_from = Tools::geocodeAdress($destination_from);
        $lat_lng_to = Tools::geocodeAdress($destination_to);

        if($car){
            if($car->db_max_osob >= $persons){

                $res = zonaClass::isVertexOnAirport(array($lat_lng_to, $lat_lng_from));
                if (count($res->belongToAirport)>0 && count($res->notBelongToAirport)>0){

                    $destination = array_pop($res->notBelongToAirport);

                    $ceniky = $car->getSubobject("cenik");
                    $ceniky_belonging = array();
                    if($ceniky && count($ceniky) > 0){

                        foreach ($ceniky as $key => $value){
                            foreach ($value->db_zona_id as $key1 => $value1){

                                $zona = assetsFactory::getEntity("zonaClass",$value1);

                                // zkontroluj zdali je vertex inside
                                if($zona->isVertexInside($destination)){

                                    // zkontroluj zdali sedí počet osob
                                    if($value->db_max_osob >= $persons && $value->db_min_osob <= $persons){
                                        $ceniky_belonging[] = $value;
                                    }
                                }

                            }
                        }

                        // pole následně seřad dle ceny a vezmi nejdražší
                        $ceniky_belonging = cenikClass::sortCeniky($ceniky_belonging);

                        if(count($ceniky_belonging) > 0){
                            $cenik = array_pop($ceniky_belonging);

                            $response->message = "Ceníky a jejich zóny souhlasí s destinací";
                            $response->status = 1;

                            // zkontroluj zdali je cesta zpět nebo jen tam
                            if($way_option){
                                $response->payload = array(
                                    "final_price" => $cenik->db_cena_zpet
                                );
                            }else{
                                $response->payload = array(
                                    "final_price" => $cenik->db_cena_tam
                                );
                            }
                        }else{
                            $response = self::calculateBasicPrice($car, $distance, $duration, $way_option);
                        }
                    }else{
                        $response = self::calculateBasicPrice($car, $distance, $duration, $way_option);
                    }
                }else{
                    $response = self::calculateBasicPrice($car, $distance, $duration, $way_option);
                }
            }else{
                $response->status = -1;
                $response->message = "Pozor, zadal jste příliš velký počet osob, toto vozidlo není dimenzováno pro takový počet osob";
            }

        }else{
            $response->status = 0;
            $response->message = "Vozidlo nebylo nalezeno";
        }

        if($currency == 1){
            $kurz = Tools::getEURRatio();
            $response->payload['final_price'] = ceil($response->payload['final_price'] / $kurz);
        }

        return $response;
    }


    public static function calculateBasicPrice($car, $distance, $duration, $selected_way_option){
        $response = new stdClass();

        $price_per_unit = $car->db_cena_za_jednotku;
        $unit = $car->db_jednotka;

        if($unit == 0){
            $final_price = $price_per_unit * $distance;
        }else{
            $final_price = $price_per_unit * ceil($duration / 1000 / 60 / 60);
        }

        $response->status = 1;
        $response->message = "Zóny nenalezeny, vracím ceny za jednodku";
        if($selected_way_option){
            $response->payload = array(
                'final_price' => $final_price * 2,
            );
        }else{
            $response->payload = array(
                'final_price' => $final_price,
            );
        }
        return $response;
    }
}
