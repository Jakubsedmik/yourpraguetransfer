

<!-- References -->
<section id="references" class="container-fluid">
    <div class="s7_ref-slider s7_sw-sec mx-auto">
        <h2 class="text-center font-weight-bold text-white text-uppercase"><?php echo get_theme_mod( "klientske_reference_title" ); ?></h2>
        <p class="s7_reference-undertitle text-center text-white"><?php echo get_theme_mod( "klientske_reference_subtitle" ); ?></p>
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" data-interval="false">
            <div class="carousel-inner">
                <?php for($i=0; $i<5; $i++) : ?>
                    <div class="carousel-item text-center <?php if($i==0) echo 'active'; ?>">
                        <img src="<?php echo FRONTEND_IMAGES_PATH; ?>/ref-person.png" alt="" class="s7_references-person-img">
                        <p class="s7_references-slider-name font-weight-bold text-white">Petr David - Busines Manager - Praha</p>
                        <p class="s7_references-slider-text bg-white w-100 mx-auto px-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel
                        </p>
                    </div>
                <?php endfor; ?>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"><i class="fas fa-chevron-left text-white"></i></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"><i class="fas fa-chevron-right text-white"></i></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <div class="text-center"><a href="#" class="btn rounded-0 w-100 text-white text-uppercase font-weight-bold">Google reference</a></div>
    </div>
</section>