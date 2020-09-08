
<div class="container">

    <!-- Material form register -->
    <div class="card p-0 mw-100">

        <h5 class="card-header info-color white-text text-center py-4">
            <strong>Upravení reference</strong>
            <p class="mb-0 text-white">Zde můžete upravit již vytvořenou referenci.</p>
            <a class="position-absolute admin-nav" href="<?php echo Tools::getRoute("referenceClass"); ?>"><i class="fas fa-bars"></i> Zpět na výpis</a>
        </h5>

        <!--Card content-->
        <div class="card-body px-lg-5 pt-0">

            <!-- Form -->
            <form class="text-center" style="color: #757575;" action="<?php Tools::getCurrentUrl(); ?>" method="POST">

                <input type="hidden" name="db_id" value="<?php echo $this->viewData['reference']->getId(); ?>">

                <div class="form-row">

                    <!-- Název -->
                    <div class="col">
                        <?php echo Tools::simpleInput("db_jmeno",  $this->viewData['reference']->dejData('db_jmeno'), "Jméno", "text"); ?>
                    </div>

                    <!-- Pozice -->
                    <div class="col">
                        <?php echo Tools::simpleInput("db_pozice",  $this->viewData['reference']->dejData('db_pozice'), "Pozice", "text"); ?>
                    </div>
                </div>

                <!-- Reference -->
                <?php echo Tools::simpleInput("db_reference",  $this->viewData['reference']->dejData('db_reference'), "Text reference", "textarea"); ?>

                <div class="form-row">

                    <div class="col">
                        <div class="md-form">
                            <?php
                            $datumUpravy =  $this->viewData['reference']->db_datum_upravy;
                            $datumUpravy = date("d.m.Y H:i:s", $datumUpravy);
                            ?>
                            <input placeholder="Vyberte datum" type="text" id="db_datum_upravy" name="db_datum_upravy" class="form-control" disabled value="<?php echo $datumUpravy; ?>">
                            <label for="db_datum_upravy">Datum a čas úpravy</label>
                        </div>

                    </div>
                    <div class="col">
                        <div class="md-form">
                            <?php
                            $mdbTime = Tools::getMdbNotationDate($this->viewData['reference']->db_datum_zalozeni);
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