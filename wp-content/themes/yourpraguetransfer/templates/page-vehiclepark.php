<!-- Vehicle park -->
<section id="vozovy-park" class="container-fluid">
    <div class="s7_vozovy-park-sw w-100 mx-auto">
        <h2 class="s7_underlink position-relative font-weight-bold text-center text-uppercase"><?php echo get_theme_mod( "vozovy_park_title" ); ?></h2>
        <p class="s7_vozovy-park-text text-center"><?php echo get_theme_mod( "vozovy_park_subtitle" ); ?></p>
        <div class="row">
            <?php for($i=0; $i<3; $i++) : ?>
            <div class="s7_vozovy-park-auto col-lg-4 col-md-6 col-12">
                <div class="s7_vozovy-park-content">
                    <figure class="position-relative mb-0"><img src="<?php echo FRONTEND_IMAGES_PATH; ?>/skoda.jpg" alt="" class="s7_car-img img-fluid w-100"></figure>
                    <div class="d-flex align-items-center">
                        <h3 class="font-weight-bold">High Class</h3>
                        <div class="sz_vozovy-park-start">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <div class="s7_vozovy-park-typ-auto font-italic">Škoda Superb Laurint Clement</div>
                    <p class="s7_vozovy-park-popis">Etiam aliquam, arcu tristique ultrices vestibulum, augue erat convallis dui, a sodales quam augue ut ligula.</p>
                    <div class="s7_vozovy-park-cena d-flex align-items-center">
                        <i class="fas fa-taxi mr-2"></i><span><strong>45 </strong>eur/km</span>
                        <div class="s7_vozovy-park-dot mx-2"></div>
                        <span><strong>45 </strong>eur/letištní transport</span>
                    </div>
                    <a href="#" class="btn w-100 border-0 rounded-0 text-uppercase font-weight-bold text-white">Spočítat cestu</a>
                </div>
            </div>
            <?php endfor; ?>
        </div>
        <a href="#" class="s7_btn-all-cars font-weight-bold d-flex mx-auto align-items-center justify-content-between w-100">
            <span class="text-uppercase"><?php echo get_theme_mod( "vsechny_vozy" ); ?></span>
            <i class="fas fa-chevron-right"></i>
        </a>
    </div>
</section>