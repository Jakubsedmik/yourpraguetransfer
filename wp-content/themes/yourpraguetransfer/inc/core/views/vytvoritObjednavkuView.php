<div class="container">
    <!-- Material form register -->
    <div class="card p-0 mw-100">

        <h5 class="card-header blue-gradient white-text text-center py-4">
            <strong>Vytvoření objednávky</strong>
            <p class="mb-0 text-white">Zde můžete vytvořit objednávku</p>
            <a class="position-absolute admin-nav" href="<?php echo Tools::getRoute("objednavkaClass"); ?>"><i class="fas fa-bars"></i> Zpět na výpis</a>
        </h5>

        <!--Card content-->
        <div class="card-body px-lg-5 pt-0">

            <!-- Form -->
            <form class="text-center" style="color: #757575;" action="<?php Tools::getCurrentUrl(); ?>" method="POST">


                <div class="form-row">
                    <div class="col-10">
                        <!-- Cena-->
                        <?php echo Tools::simpleInput("db_cena", $this->getPostData('db_cena'), "Cena", "number"); ?>
                    </div>
                    <div class="col-2">
                        <!-- Měna -->
                        <div class="md-form alone">
                            <?php echo Tools::getSelectBoxForDials("objednavkaClass","mena",$this->getPostData('db_mena'), 'Měna', "db_mena"); ?>
                        </div>
                    </div>


                </div>

                <!-- Připojené vozidlo-->
                <?php echo Tools::getSelectBoxForEntities("vozidloClass", $this->getPostData('db_vozidlo_id'), array('db_id', 'db_nazev'),'Vozidlo','db_vozidlo_id'); ?>

                <div class="form-row">
                    <div class="col-6">
                        <!-- Stav objednávky -->
                        <?php echo Tools::getSelectBoxForDials("objednavkaClass","stav",$this->getPostData('db_stav'), 'Stav objednávky', "db_stav"); ?>
                    </div>
                    <div class="col-6">
                        <!-- Typ platby -->
                        <?php echo Tools::getSelectBoxForDials("objednavkaClass","typ_platby",$this->getPostData('db_typ_platby'), 'Typ platby', "db_typ_platby"); ?>
                    </div>
                </div>


                <div class="form-row">
                    <div class="col">
                        <!-- Odkud -->
                        <?php echo Tools::simpleInput("db_destinace_z", $this->getPostData('db_destinace_z'), "Destinace z", "text"); ?>
                    </div>
                    <div class="col">
                        <!-- Kam -->
                        <?php echo Tools::simpleInput("db_destinace_do", $this->getPostData('db_destinace_do'), "Destinace do", "text"); ?>
                    </div>

                    <div class="col">
                        <?php echo Tools::simpleInput("db_pocet_osob", $this->getPostData('db_pocet_osob'), "Počet osob", "number"); ?>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col">
                        <!-- Jmeno -->
                        <?php echo Tools::simpleInput("db_jmeno", $this->getPostData('db_jmeno'), "Jméno", "text"); ?>
                    </div>
                    <div class="col">
                        <!-- Prijmeni -->
                        <?php echo Tools::simpleInput("db_prijmeni", $this->getPostData('db_prijmeni'), "Příjmení", "text"); ?>
                    </div>
                    <div class="col">
                        <!-- Email -->
                        <?php echo Tools::simpleInput("db_email", $this->getPostData('db_email'), "Email", "text"); ?>
                    </div>
                    <div class="col">
                        <!-- Telefon -->
                        <?php echo Tools::simpleInput("db_telefon", $this->getPostData('db_telefon'), "Telefon", "text"); ?>
                    </div>

                </div>

                <div class="form-row">
                    <div class="col">
                        <?php echo Tools::timePicker($this->getPostData('db_cas'), "db_cas", "Čas vyzvednutí", "Vyberte čas vyzvednutí"); ?>
                    </div>

                    <div class="col">

                        <?php
                            echo Tools::timePicker($this->getPostData('db_cas_zpet'), "db_cas_zpet", "Čas vyzvednutí zpátky", "Vyberte čas vyzvednutí zpátky");
                        ?>
                    </div>

                </div>

                <div class="form-row">
                    <div class="col">
                        <?php echo Tools::switcher("Ano","Ne", "Dětská sedačka", 1, 'db_detska_sedacka', $this->getPostData('db_detska_sedacka')); ?>
                    </div>

                    <div class="col">
                        <?php echo Tools::switcher("Ano","Ne", "Velká zavazadla", 1, 'db_velka_zavazadla', $this->getPostData('db_velka_zavazadla')); ?>
                    </div>
                </div>


                <?php echo Tools::simpleInput("db_znameni", $this->getPostData('db_znameni'), "Znamení", "text"); ?>

                <?php echo Tools::simpleInput("db_poznamka", $this->getPostData('db_poznamka'), "Poznámka", "text"); ?>


                <!-- Sign up button -->
                <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" name="vytvorit" value="1" type="submit">Vytvořit</button>


            </form>
            <!-- Form -->

        </div>

    </div>
    <!-- Material form register -->

</div>