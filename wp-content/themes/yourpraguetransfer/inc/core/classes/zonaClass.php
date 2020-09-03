<?php


class zonaClass extends zakladniKamenClass
{

    protected $db_nazev;
    protected $db_zone_polygon;

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