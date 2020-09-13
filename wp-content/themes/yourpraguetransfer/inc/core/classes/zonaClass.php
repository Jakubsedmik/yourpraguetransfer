<?php


class zonaClass extends zakladniKamenClass
{

    protected $db_nazev;
    protected $db_zone_polygon;

    public function isVertexInside($vertex){

        require_once ("pointLocation.php");
        $loc = new pointLocation();
        $zone_polygon = $this->db_zone_polygon;

        foreach ($zone_polygon as $key => $value){
            $polygon = $value;
            if($loc->pointInPolygon($vertex, $polygon)){
                return true;
            }
        }

        return false;

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