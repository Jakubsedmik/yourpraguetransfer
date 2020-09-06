<div class="container">

    <!-- Material form register -->
    <div class="card p-0 mw-100">

        <h5 class="card-header info-color white-text text-center py-4">
            <strong>Upravení ceníku</strong>
            <p class="mb-0 text-white">Upravte ceník k vozidlu specifikováním do jaké zóny může vozidlo zajet a jaký je možný počet osob</p>
            <a class="position-absolute admin-nav" href="<?php echo Tools::getRoute("cenikClass"); ?>"><i class="fas fa-bars"></i> Zpět na výpis</a>
        </h5>

        <!--Card content-->
        <div class="card-body px-lg-5 pt-0">

            <!-- Form -->
            <form class="text-center" style="color: #757575;" action="<?php Tools::getCurrentUrl(); ?>" method="POST">

                <input type="hidden" name="db_id" value="<?php echo $this->viewData['cenik']->getId(); ?>">

                <?php echo Tools::simpleInput("db_nazev", $this->viewData['cenik']->dejData('db_nazev'), "Název", "text"); ?>

                <!-- Vozidlo -->
                <div class="md-form mt-3">
                    <?php echo Tools::getSelectBoxForEntities("vozidloClass",  $this->viewData['cenik']->dejData('db_vozidlo_id'), array('db_id', 'db_nazev'),'Vozidlo','db_vozidlo_id'); ?>
                </div>

                <!-- Zóna -->
                <div class="md-form mt-0">
                    <?php echo Tools::getSelectBoxForEntities("zonaClass",  $this->viewData['cenik']->db_zona_id, array('db_id', 'db_nazev'),'Zóna','db_zona_id', "Vyhledávání", true); ?>
                </div>

                <div class="form-row">
                    <!-- Cena zpět -->
                    <div class="col">
                        <?php echo Tools::simpleInput("db_cena_zpet", $this->viewData['cenik']->dejData('db_cena_zpet'), "Cena zpět", "number"); ?>
                    </div>

                    <!-- Cena tam -->
                    <div class="col">
                        <?php echo Tools::simpleInput("db_cena_tam", $this->viewData['cenik']->dejData('db_cena_tam'), "Cena tam", "number"); ?>
                    </div>
                </div>

                <div class="form-row">
                    <!-- Max osob -->
                    <div class="col">
                        <?php echo Tools::simpleInput("db_max_osob", $this->viewData['cenik']->dejData('db_max_osob'), "Maximálně osob", "number"); ?>
                    </div>

                    <!-- Min osob -->
                    <div class="col">
                        <?php echo Tools::simpleInput("db_min_osob", $this->viewData['cenik']->dejData('db_min_osob'), "Minimálně osob", "number"); ?>
                    </div>
                </div>


                <!-- Sign up button -->
                <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" name="ulozit" value="1" type="submit">Upravit</button>


            </form>
            <!-- Form -->

        </div>

        <div class="mt-3 mb-2 userAdsContainer app">

            <div class="p-3 text-center border-top">
                <h3>Zóny vozidla</h3>
                <p class="mb-0">Zde vidíte ceníky vozidla. Můžete je upravit nebo smazat.</p>
            </div>

            <?php
                $zones =  $this->viewData['cenik']->db_zona_id;
                $zony = implode("|", $zones);
            ?>
            <inzeraty
                api_url="<?php echo AJAXURL ?>"
                base_url="<?php echo ADMIN_BASE_URL ?>" model="zonaClass"
                item_controller="zona"
                home_url="<?php echo home_url() ?>"
                sub_params="?action=getElements&db_id=<?php echo $zony; ?>"
            ></inzeraty>

        </div>

    </div>
    <!-- Material form register -->

</div>