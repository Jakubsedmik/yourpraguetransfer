<?php


class zonaClass extends zakladniKamenClass
{

    protected $db_nazev;
    protected $db_zone_polygon;

    public function isVertexInside($vertex){
        require_once ("pointLocation.php");
        $loc = new pointLocation();

        foreach ($this->db_zone_polygon as $key => $value){
            var_dump($loc->pointInPolygon($vertex, $value));
            globalUtils::writeDebug($value);
        }

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