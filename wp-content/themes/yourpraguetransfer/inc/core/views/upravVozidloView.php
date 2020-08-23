
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

                <!-- Název -->
                <?php echo Tools::simpleInput("db_nazev", $this->viewData['vozidlo']->dejData('db_nazev'), "Název", "text"); ?>


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
                        <?php echo Tools::getSelectBoxForDials('vozidloClass', 'jednotka', $this->viewData['vozidlo']->dejData('db_jednotka'),'Jednotka', 'db_jednotka'); ?>
                    </div>

                    <div class="col">
                        <?php echo Tools::switcher("Ano","Ne", "Top", 1, 'db_top', $this->viewData['vozidlo']->dejData('db_top')); ?>
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

    </div>
    <!-- Material form register -->

</div>


<div class="app" id="addImages">
    <Obrazky
        entity_id="<?php echo $this->viewData['vozidlo']->getId(); ?>"
        api_link="<?php echo AJAXURL; ?>"
        edit_link="<?php echo Tools::getRoute("obrazekClass","edit"); ?>"
        entity_class="vozidloClass"
    ></Obrazky>
</div>
