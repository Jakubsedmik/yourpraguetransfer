<?php


class referenceClass extends zakladniKamenClass
{

    protected $db_jmeno;
    protected $db_pozice;
    protected $db_reference;

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
        return "s7_reference";
    }
}