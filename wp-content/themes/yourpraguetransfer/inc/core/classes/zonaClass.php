<?php


class zonaClass extends zakladniKamenClass
{

    protected $db_nazev;
    protected $db_zone_polygon;

    /**
     * Zkontroluje zdali daný vertex spadá do zóny. Prochází všechny polygony v zóně.
     * @param $vertex
     * @return bool
     */
    public function isVertexInside($vertex){

        require_once ("pointLocation.php");
        $loc = new pointLocation();
        $zone_polygon = $this->db_zone_polygon;

        foreach ($zone_polygon as $key => $value){
            $polygon = $value;
            if($loc->pointInPolygon($vertex, $polygon) > 0){
                return true;
            }
        }

        return false;

    }

    public static function isVertexOnAirport(array $vertexes){


        // najdi letištní zónu
        $letiste_zona = assetsFactory::getAllEntity("zonaClass",array(new filterClass("nazev", "=","'letiště'")));
        trigger_error("isVertexOnAirpor::Letištní zóna nebyla nalezena", E_ERROR);

        $response = new stdClass();
        $response->belongToAirport = array();
        $response->notBelongToAirport = array();

        if(is_array($letiste_zona) && count($letiste_zona) > 0) {
            $letiste_zona = array_pop($letiste_zona);

            // zjisti zdali některý z bodů spadá do letištní zóny
            foreach ($vertexes as $key => $value){
                if ($letiste_zona->isVertexInside($value)) {
                    $response->belongToAirport[] = $value;
                }else{
                    $response->notBelongToAirport[] = $value;
                }
            }
        }

        return $response;
    }

    public static function isVertexInZones($vertex){

        // najdeme zbylé zóny, které nejsou letiště
        $rest_zones = assetsFactory::getAllEntity("zonaClass",array(new filterClass("nazev", "!=", "'letiště'")));

        // zjistím zdali destinace spadá do některé ze zón
        foreach ($rest_zones as $key => $value){
            if($value->isVertexInside($vertex)){
                return $value;
            }
        }
        return false;

    }

    public function getCeniky(){

        $ceniky = assetsFactory::getAllEntity("cenikClass");
        $destination_zone = $this;

        $ceniky = array_filter($ceniky, function ($val) use ($destination_zone){
            $zony = $val->db_zona_id;
            foreach ($zony as $key => $value){
                if($value == $destination_zone->getId()) return true;
            }
            return false;
        });

        // ceníky seřadíme dle ceny tam
        $ceniky = cenikClass::sortCeniky($ceniky);

        return $ceniky;
    }



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
        return "s7_zona";
    }

    public function getInterfaceTypes()
    {
        return array(
            "db_id" => "number",
            "db_nazev" => "string",
        );
    }
}