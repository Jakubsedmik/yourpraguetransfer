
<div class="container">

    <!-- Material form register -->
    <div class="card p-0 mw-100">

        <h5 class="card-header info-color white-text text-center py-4">
            <strong>Vytvoření reference</strong>
            <p class="mb-0 text-white">Zde můžete vytvořit novou referenci.</p>
            <a class="position-absolute admin-nav" href="<?php echo Tools::getRoute("referenceClass"); ?>"><i class="fas fa-bars"></i> Zpět na výpis</a>
        </h5>

        <!--Card content-->
        <div class="card-body px-lg-5 pt-0">

            <!-- Form -->
            <form class="text-center" style="color: #757575;" action="<?php Tools::getCurrentUrl(); ?>" method="POST">

                <div class="form-row">

                    <!-- Název -->
                    <div class="col">
                        <?php echo Tools::simpleInput("db_jmeno", $this, "Jméno", "text"); ?>
                    </div>

                    <!-- Pozice -->
                    <div class="col">
                        <?php echo Tools::simpleInput("db_pozice", $this, "Pozice", "text"); ?>
                    </div>
                </div>

                <!-- Reference -->
                <?php echo Tools::simpleInput("db_reference", $this, "Text reference", "textarea"); ?>


                <!-- Sign up button -->
                <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" name="vytvorit" value="1" type="submit">Vytvořit</button>


            </form>
            <!-- Form -->

        </div>

    </div>
    <!-- Material form register -->

</div>