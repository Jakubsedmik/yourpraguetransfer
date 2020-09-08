<?php

    $vehicles = assetsFactory::getAllEntity("vozidloClass");
    foreach ($vehicles as $key => $value){
        $value->loadRelatedObjects("obrazekClass");
        $value->writeDials();
    }

?>

<!-- Vehicle park -->
<section id="vozovy-park" class="container-fluid">
    <div class="s7_vozovy-park-sw w-100 mx-auto">
        <h2 class="s7_underlink position-relative font-weight-bold text-center text-uppercase"><?php echo get_theme_mod( "vozovy_park_title" ); ?></h2>
        <p class="s7_vozovy-park-text text-center"><?php echo get_theme_mod( "vozovy_park_subtitle" ); ?></p>
        <div class="row">
            <?php foreach ($vehicles as $key => $value) : ?>
            <?php

                $obrazky = $value->subobjects['obrazekClass'];
                $front_img = "";
                $obrazky = array_filter($obrazky , function ($val) use (&$front_img){
                    if($val->db_front == 1){
                        $front_img = $val;
                        return false;
                    }
                    return true;
                });

            ?>
            <div class="s7_vozovy-park-auto col-lg-4 col-md-6 col-12">
                <div class="s7_vozovy-park-content">
                    <figure class="position-relative mb-0 <?php echo ($value->db_top == 1) ? "top" : '' ?>">
                        <img src="<?php echo home_url() . "" . $front_img->db_url; ?>" alt="" class="s7_car-img img-fluid w-100">
                    </figure>
                    <div class="d-flex align-items-center">
                        <h3 class="font-weight-bold"><?php echo $value->dejData("db_trida"); ?></h3>
                        <div class="sz_vozovy-park-start">
                            <?php for($i=0; $i<$value->db_hvezdy; $i++): ?>
                                <i class="fas fa-star"></i>
                            <?php endfor; ?>
                        </div>
                    </div>
                    <div class="s7_vozovy-park-typ-auto font-italic"><?php echo $value->dejData("db_nazev"); ?></div>
                    <p class="s7_vozovy-park-popis"><?php echo Tools::getTextPart($value->dejData("db_popis"),160); ?></p>
                    <div class="s7_vozovy-park-cena d-flex align-items-center">
                        <i class="fas fa-taxi mr-2"></i><span><strong><?php echo $value->dejData("db_cena_za_jednotku"); ?> </strong><?php echo CURRENCY ?>/<?php echo $value->dejData("db_jednotka");  ?></span>
                        <div class="s7_vozovy-park-dot mx-2"></div>
                        <span><strong><?php echo $value->dejData("db_letistni_transfer") . ' ' . CURRENCY; ?> </strong>/letištní transport</span>
                    </div>
                    <a href="#" class="btn w-100 border-0 rounded-0 text-uppercase font-weight-bold text-white">Spočítat cestu</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <!--a href="#" class="s7_btn-all-cars font-weight-bold d-flex mx-auto align-items-center justify-content-between w-100">
            <span class="text-uppercase"><?php echo get_theme_mod( "vsechny_vozy" ); ?></span>
            <i class="fas fa-chevron-right"></i>
        </a-->
    </div>
</section>