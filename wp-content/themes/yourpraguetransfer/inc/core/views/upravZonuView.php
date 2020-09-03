
<div class="container">

    <!-- Material form register -->
    <div class="card p-0 mw-100">

        <h5 class="card-header info-color white-text text-center py-4">
            <strong>Vytvoření zóny</strong>
            <p class="mb-0 text-white">Vytvořte zónu k ceníku. Zóna specifikuje místo na mapě kam může vůz jet.</p>
            <a class="position-absolute admin-nav" href="<?php echo Tools::getRoute("zonaClass"); ?>"><i class="fas fa-bars"></i> Zpět na výpis</a>
        </h5>

        <!--Card content-->
        <div class="card-body px-lg-5 pt-0">

            <!-- Form -->
            <form class="text-center" style="color: #757575;" action="<?php Tools::getCurrentUrl(); ?>" method="POST">

                <input type="hidden" name="db_id" value="<?php echo $this->viewData['zona']->getId(); ?>">


                <?php echo Tools::simpleInput("db_nazev", $this->viewData['zona']->dejData('db_nazev'), "Název zóny", "text"); ?>


                <div class="app">
                    <Zonecreator
                        :prerender_zones="<?php echo Tools::prepareJsonToOutputHtmlAttr($this->viewData['all_polygons']); ?>"
                        :prerender_editable_zones="<?php echo Tools::prepareJsonToOutputHtmlAttr($this->viewData['zona']->db_zone_polygon); ?>"
                    ></Zonecreator>
                </div>

                <!-- Sign up button -->
                <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" name="ulozit" value="1" type="submit">Upravit</button>


            </form>
            <!-- Form -->

        </div>

    </div>
    <!-- Material form register -->

</div>