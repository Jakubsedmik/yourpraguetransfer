<?php


class zonaClass extends zakladniKamenClass
{

    protected $db_nazev;
    protected $db_administrative_area_level_1;
    protected $db_administrative_area_level_2;
    protected $db_administrative_area_level_3;
    protected $db_administrative_area_level_4;
    protected $db_administrative_area_level_5;
    protected $db_locality;
    protected $db_neighborhood;
    protected $db_political;
    protected $db_postal_code;
    protected $db_sublocality;
    protected $db_sublocality_level_1;
    protected $db_sublocality_level_2;
    protected $db_sublocality_level_3;
    protected $db_sublocality_level_4;
    protected $db_sublocality_level_5;

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
}