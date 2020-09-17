
<div class="container">
    <?php if(isset($this->requestData['continue'])) : ?>
        <a href="<?php echo $this->requestData['continue']; ?>" class="btn btn-secondary mt-2 mb-2"><i class="fas fa-upload mr-2"></i> Pokračovat k nahrání fotografií k vozidlu</a>
    <?php endif; ?>
    <!-- Material form register -->
    <div class="card p-0 mw-100">

        <h5 class="card-header info-color white-text text-center py-4">
            <strong>Vytvoření vozidla</strong>
            <p class="mb-0 text-white">Zde můžete vytvořit nové vozidlo. Nejdříve vozidlo vytvořte a až poté můžete připojit k vozidlu fotografie pomocí úpravy vozidla.</p>
            <a class="position-absolute admin-nav" href="<?php echo Tools::getRoute("vozidloClass"); ?>"><i class="fas fa-bars"></i> Zpět na výpis</a>
        </h5>

        <!--Card content-->
        <div class="card-body px-lg-5 pt-0">

            <!-- Form -->
            <form class="text-center" style="color: #757575;" action="<?php Tools::getCurrentUrl(); ?>" method="POST">

                <div class="form-row">

                    <!-- Název -->
                    <div class="col">
                        <?php echo Tools::simpleInput("db_nazev", $this, "Název", "text"); ?>
                    </div>

                    <!-- Letištní transfer -->
                    <div class="col">
                        <?php echo Tools::simpleInput("db_letistni_transfer", $this, "Rychlá cena - letištní transfer", "number"); ?>
                    </div>
                </div>

                <!-- Popis -->
                <?php echo Tools::simpleInput("db_popis", $this, "Popis", "textarea"); ?>


                <!-- Třída -->
                <div class="md-form mt-0">
                    <?php echo Tools::getSelectBoxForDials('vozidloClass', 'trida', $this->getPostData('db_trida'),'Třída vozidla', 'db_trida'); ?>
                </div>

                <div class="form-row">

                    <!-- Max zavazadel -->
                    <div class="col">
                        <?php echo Tools::simpleInput("db_max_zavazadel", $this, "Max. zavazadel", "number"); ?>
                    </div>

                    <!-- Max osob -->
                    <div class="col">
                        <?php echo Tools::simpleInput("db_max_osob", $this, "Max. osob", "number"); ?>
                    </div>

                    <!-- Počet hvězd -->
                    <div class="col">
                        <?php echo Tools::simpleInput("db_hvezdy", $this, "Počet hvězd", "number"); ?>
                    </div>
                </div>



                <div class="form-row">

                    <!-- Cena za jednotku -->
                    <div class="col">
                        <?php echo Tools::simpleInput("db_cena_za_jednotku", $this, "Cena za jednotku", "number"); ?>
                    </div>

                    <!-- Jednotka -->
                    <div class="col">
                        <?php echo Tools::getSelectBoxForDials('vozidloClass', 'jednotka', $this->getPostData('db_jednotka'),'Jednotka', 'db_jednotka'); ?>
                    </div>

                </div>

                <div class="form-row">
                    <div class="col">
                        <?php echo Tools::switcher("Ano","Ne", "Top", 1, 'db_top', $this->getPostData('db_top')); ?>
                    </div>

                    <div class="col">
                        <?php echo Tools::switcher("Ano","Ne", "Wifi na palubě", 1, 'db_wifi',$this->getPostData('db_wifi')); ?>
                    </div>

                    <div class="col">
                        <?php echo Tools::switcher("Ano","Ne", "Voda zdarma", 1, 'db_voda', $this->getPostData('db_voda')); ?>
                    </div>

                    <div class="col">
                        <?php echo Tools::switcher("Ano","Ne", "Vyzvednutí v hale", 1, 'db_vyzvednuti', $this->getPostData('db_vyzvednuti')); ?>
                    </div>

                    <div class="col">
                        <?php echo Tools::switcher("Ano","Ne", "Klimatizace", 1, 'db_klimatizace', $this->getPostData('db_klimatizace')); ?>
                    </div>

                    <div class="col">
                        <?php echo Tools::switcher("Ano","Ne", "Voucher na turistiku", 1, 'db_voucher', $this->getPostData('db_voucher')); ?>
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