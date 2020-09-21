
<div class="container">

    <!-- Material form register -->
    <div class="card p-0 mw-100">

        <h5 class="card-header info-color white-text text-center py-4">
            <strong>Upravení vozidla</strong>
            <p class="mb-0 text-white">Zde můžete upravit vozidlo a veškeré jeho parametry.</p>
            <a class="position-absolute admin-nav" href="<?php echo Tools::getRoute("vozidloClass"); ?>"><i class="fas fa-bars"></i> Zpět na výpis</a>
        </h5>

        <!--Card content-->
        <div class="card-body px-lg-5 pt-0">

            <!-- Form -->
            <form class="text-center" style="color: #757575;" action="<?php Tools::getCurrentUrl(); ?>" method="POST">

                <input type="hidden" name="db_id" value="<?php echo $this->viewData['vozidlo']->getId(); ?>">

                <div class="form-row">

                    <!-- Název -->
                    <div class="col">
                        <?php echo Tools::simpleInput("db_nazev", $this->viewData['vozidlo']->dejData('db_nazev'), "Název", "text"); ?>
                    </div>

                    <!-- Letištní transfer -->
                    <div class="col">
                        <?php echo Tools::simpleInput("db_letistni_transfer", $this->viewData['vozidlo']->dejData('db_letistni_transfer'), "Rychlá cena - letištní transfer", "number"); ?>
                    </div>
                </div>

                <!-- Popis -->
                <?php echo Tools::simpleInput("db_popis", $this->viewData['vozidlo']->dejData('db_popis'), "Popis", "textarea"); ?>


                <!-- Třída -->
                <div class="md-form mt-0">
                    <?php echo Tools::getSelectBoxForDials('vozidloClass', 'trida', $this->viewData['vozidlo']->dejData('db_trida'),'Třída vozidla', 'db_trida'); ?>
                </div>

                <div class="form-row">

                    <!-- Max zavazadel -->
                    <div class="col">
                        <?php echo Tools::simpleInput("db_max_zavazadel", $this->viewData['vozidlo']->dejData('db_max_zavazadel'), "Max. zavazadel", "number"); ?>
                    </div>

                    <!-- Max osob -->
                    <div class="col">
                        <?php echo Tools::simpleInput("db_max_osob", $this->viewData['vozidlo']->dejData('db_max_osob'), "Max. osob", "number"); ?>
                    </div>

                    <!-- Počet hvězd -->
                    <div class="col">
                        <?php echo Tools::simpleInput("db_hvezdy", $this->viewData['vozidlo']->dejData('db_hvezdy'), "Počet hvězd", "number"); ?>
                    </div>
                </div>



                <div class="form-row">

                    <!-- Cena za jednotku -->
                    <div class="col">
                        <?php echo Tools::simpleInput("db_cena_za_jednotku", $this->viewData['vozidlo']->dejData('db_cena_za_jednotku'), "Cena za jednotku", "number"); ?>
                    </div>

                    <!-- Jednotka -->
                    <div class="col">
                        <label>Jednotka</label>
                        <?php echo Tools::getSelectBoxForDials('vozidloClass', 'jednotka', $this->viewData['vozidlo']->dejData('db_jednotka'),'Jednotka', 'db_jednotka'); ?>
                    </div>

                </div>


                <div class="form-row">
                    <div class="col">
                        <?php echo Tools::switcher("Ano","Ne", "Top", 1, 'db_top', $this->viewData['vozidlo']->dejData('db_top')); ?>
                    </div>

                    <div class="col">
                        <?php echo Tools::switcher("Ano","Ne", "Wifi na palubě", 1, 'db_wifi', $this->viewData['vozidlo']->dejData('db_wifi')); ?>
                    </div>

                    <div class="col">
                        <?php echo Tools::switcher("Ano","Ne", "Voda zdarma", 1, 'db_voda', $this->viewData['vozidlo']->dejData('db_voda')); ?>
                    </div>

                    <div class="col">
                        <?php echo Tools::switcher("Ano","Ne", "Vyzvednutí v hale", 1, 'db_vyzvednuti', $this->viewData['vozidlo']->dejData('db_vyzvednuti')); ?>
                    </div>

                    <div class="col">
                        <?php echo Tools::switcher("Ano","Ne", "Klimatizace", 1, 'db_klimatizace', $this->viewData['vozidlo']->dejData('db_klimatizace')); ?>
                    </div>

                    <div class="col">
                        <?php echo Tools::switcher("Ano","Ne", "Voucher na turistiku", 1, 'db_voucher', $this->viewData['vozidlo']->dejData('db_voucher')); ?>
                    </div>
                </div>

                <div class="form-row">

                    <div class="col">
                        <div class="md-form">
                            <?php
                            $datumUpravy =  $this->viewData['vozidlo']->db_datum_upravy;
                            $datumUpravy = date("d.m.Y H:i:s", $datumUpravy);
                            ?>
                            <input placeholder="Vyberte datum" type="text" id="db_datum_upravy" name="db_datum_upravy" class="form-control" disabled value="<?php echo $datumUpravy; ?>">
                            <label for="db_datum_upravy">Datum a čas úpravy</label>
                        </div>

                    </div>
                    <div class="col">
                        <div class="md-form">
                            <?php
                            $mdbTime = Tools::getMdbNotationDate($this->viewData['vozidlo']->db_datum_zalozeni);
                            ?>
                            <input placeholder="Vyberte datum" type="text" id="db_datum_zalozeni" name="datum_zalozeni" class="form-control datepicker" data-value="<?php echo $mdbTime; ?>">
                            <label for="db_datum_zalozeni">Datum vytvoření</label>
                        </div>
                    </div>

                </div>


                <!-- Sign up button -->
                <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" name="ulozit" value="1" type="submit">Upravit</button>


            </form>
            <!-- Form -->

        </div>

        <div class="mt-3 mb-2 userAdsContainer app">

            <div class="p-3 text-center border-top">
                <h3>Obrázky vozidla</h3>
                <p class="mb-0">Zde vidíte obrázky vozidla</p>
            </div>

            <Obrazky
                entity_id="<?php echo $this->viewData['vozidlo']->getId(); ?>"
                api_link="<?php echo AJAXURL; ?>"
                edit_link="<?php echo Tools::getRoute("obrazekClass","edit"); ?>"
                entity_class="vozidloClass"
                home_url="<?php echo home_url(); ?>"
            ></Obrazky>

            <div class="p-3 text-center border-top">
                <h3>Ceníky vozidla</h3>
                <p class="mb-0">Zde vidíte ceníky vozidla. Můžete je upravit nebo smazat.</p>
            </div>

            <inzeraty
                api_url="<?php echo AJAXURL ?>"
                base_url="<?php echo ADMIN_BASE_URL ?>" model="cenikClass"
                item_controller="cenik"
                home_url="<?php echo home_url() ?>"
                sub_params="?action=getElements&db_vozidlo_id=<?php echo $this->viewData['vozidlo']->getId(); ?>"
            ></inzeraty>

        </div>

    </div>
    <!-- Material form register -->

</div>


