<?php


class cenikClass extends zakladniKamenClass
{

    protected $db_zona_id;
    protected $db_nazev;
    protected $db_cena_tam;
    protected $db_cena_zpet;
    protected $db_max_osob;
    protected $db_min_osob;
    protected $db_vozidlo_id;



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
        return "s7_cenik";
    }

    public function getInterfaceTypes()
    {
        return array(
            "db_id" => "number",
            "db_nazev" => "string",
            "db_cena_tam" => "number",
            "db_cena_zpet" => "number",
            "db_max_osob" => "number",
            "db_min_osob" => "number"
        );
    }
}