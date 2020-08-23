
<div class="container">

    <!-- Material form register -->
    <div class="card p-0 mw-100">

        <h5 class="card-header info-color white-text text-center py-4">
            <strong>Vytvoření ceníku</strong>
            <p class="mb-0 text-white">Vytvořte ceník k vozidlu specifikováním do jaké zóny může vozidlo zajet a jaký je možný počet osob</p>
            <a class="position-absolute admin-nav" href="<?php echo Tools::getRoute("vozidloClass"); ?>"><i class="fas fa-bars"></i> Zpět na výpis</a>
        </h5>

        <!--Card content-->
        <div class="card-body px-lg-5 pt-0">

            <!-- Form -->
            <form class="text-center" style="color: #757575;" action="<?php Tools::getCurrentUrl(); ?>" method="POST">

                <!-- Vozidlo -->
                <div class="md-form mt-3">
                    <?php echo Tools::getSelectBoxForEntities("vozidloClass",  $this->getPostData('db_vozidlo_id'), array('db_id', 'db_nazev'),'Vozidlo','db_vozidlo_id'); ?>
                </div>

                <!-- Zóna -->
                <div class="md-form mt-0">
                    <?php echo Tools::getSelectBoxForEntities("zonaClass",  $this->getPostData('db_zona_id'), array('db_id', 'db_nazev'),'Zóna','db_zona_id'); ?>
                </div>

                <div class="form-row">
                    <!-- Cena zpět -->
                    <div class="col">
                        <?php echo Tools::simpleInput("db_cena_zpet", $this, "Cena zpět", "number"); ?>
                    </div>

                    <!-- Cena tam -->
                    <div class="col">
                        <?php echo Tools::simpleInput("db_cena_tam", $this, "Cena tam", "number"); ?>
                    </div>
                </div>

                <div class="form-row">
                    <!-- Max osob -->
                    <div class="col">
                        <?php echo Tools::simpleInput("db_max_osob", $this, "Maximálně osob", "number"); ?>
                    </div>

                    <!-- Min osob -->
                    <div class="col">
                        <?php echo Tools::simpleInput("db_min_osob", $this, "Minimálně osob", "number"); ?>
                    </div>
                </div>


                <!-- Sign up button -->
                <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" name="vytvorit" value="1" type="submit">Vytvořit</button>


            </form>
            <!-- Form -->

        </div>

    </div>
    <!-- Material form register -->

</div>