
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBLIBdR0G1-KMTJDEmHeLdI87qAItL7zyw&libraries=places&callback=initAutocomplete"
        async defer></script>

<div class="container">

    <!-- Material form register -->
    <div class="card p-0 mw-100">

        <h5 class="card-header info-color white-text text-center py-4">
            <strong>Vytvoření zóny</strong>
            <p class="mb-0 text-white">Vytvořte zónu k ceníku. Zóna specifikuje místo na mapě kam může vůz jet.</p>
            <a class="position-absolute admin-nav" href="<?php echo Tools::getRoute("vozidloClass"); ?>"><i class="fas fa-bars"></i> Zpět na výpis</a>
        </h5>

        <!--Card content-->
        <div class="card-body px-lg-5 pt-0">

            <!-- Form -->
            <form class="text-center" style="color: #757575;" action="<?php Tools::getCurrentUrl(); ?>" method="POST">



                <?php echo Tools::simpleInput("db_nazev", $this, "Název zóny", "text"); ?>


                <?php echo Tools::simpleInput("map_place", $this, "Místo, oblast, město", "text", array("js-autocomplete")); ?>


                <!-- Sign up button -->
                <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" name="vytvorit" value="1" type="submit">Vytvořit</button>


            </form>
            <!-- Form -->

        </div>

    </div>
    <!-- Material form register -->

</div>