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
}
