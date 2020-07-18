<?php include "header.php"; ?>
   
   <!-- Main slider -->
    <section id="main-slider" class="container-fluid">
        <div class="s7_main-slider-sw s7_sw-sec mx-auto">
            <h1 class="text-center text-white text-uppercase pb-2 mb-4">Přeprava na zavolanou</h1>
            <p class="s7_slider-under-title-text text-center text-white">Jednoduše Zvolte odkud pojedete a kam to bude a získejte okamžik nabídky</p>
            <form action="" class="s7_ftw text-center w-100 mx-auto">
                <div class="s7_slider-inputs d-flex align-items-center justify-content-between">
                    <input type="text" placeholder="Z místa (např. Letiště Václava ..." class="w-100 border-0 px-3 py-0">
                    <div class="s7_ftw-arrown">
                        <i class="fas fa-caret-right active mr-2 text-white"></i>
                        <i class="fas fa-caret-right mr-2 text-white"></i>
                        <i class="fas fa-caret-right mr-2 text-white"></i>
                        <i class="fas fa-caret-right mr-2 text-white"></i>
                        <i class="fas fa-caret-right mr-2 text-white"></i>
                        <i class="fas fa-caret-right text-white"></i>
                    </div>
                    
                    <input type="text" placeholder="Do místa (např. centrum Praha)" class="w-100 border-0 px-3 py-0">
                </div>
                <button type="submit" class="btn mx-auto border-0 rounded-0 font-weight-bold d-flex justify-content-between align-items-center w-100 py-3 mb-4">
                    <span class="text-white text-uppercase">Vyhledat</span>
                    <i class="fas fa-chevron-right text-white"></i>
                </button>
            </form>
            <p class="text-center text-white font-italic mb-5">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus tristique posuere <br>
                mi vitae venenatis. Suspendisse viverra ligula diam, sed pellentesque <br>
                nunc luctus at. Phasellus pulvinar sagittis
            </p>
            <div class="row">
                <div class="s7_slider-ico col text-center">
                    <img src="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/drink.png" alt="láhev vody" class="s7_slider-ico-img">
                    <p class="s7_slider-ico-text text-white text-uppercase font-weight-bold">Pití zdarma</p>
                </div>
                <div class="s7_slider-ico col text-center">
                    <img src="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/pay-cards.png" alt="platební karty" class="s7_slider-ico-img">
                    <p class="s7_slider-ico-text text-white text-uppercase font-weight-bold">Platba online</p>
                </div>
                <div class="s7_slider-ico col text-center">
                    <img src="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/Safety.png" alt="štít" class="s7_slider-ico-img">
                    <p class="s7_slider-ico-text text-white text-uppercase font-weight-bold">Bezpečnost</p>
                </div>
                <div class="s7_slider-ico col text-center">
                    <img src="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/wifi.png" alt="wifi" class="s7_slider-ico-img">
                    <p class="s7_slider-ico-text text-white text-uppercase font-weight-bold">Wifi na palubě</p>
                </div>
                <div class="s7_slider-ico col text-center">
                    <img src="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/24-7-ico.png" alt="nonstop" class="s7_slider-ico-img">
                    <p class="s7_slider-ico-text text-white text-uppercase font-weight-bold">Nonstop 24/7</p>
                </div>
            </div>
            <div class="text-center">
                <a href="#" class="s7_slider-covid d-flex mx-auto w-100 align-items-center justify-content-center"><img src="../yourpraguetransfer/wp-content/themes/yourpraguetransfer/assets/images/virus.png" alt="virus" class="s7_virus-img w-100 mr-2"><span class="s7_slider-covid-text text-white text-uppercase"><strong class="text-white">Covid19 </strong>opatření</span></a>
            </div>
        </div>
    </section>
    
    <!-- Vehicle park -->
    <section id="vozovy-park" class="container-fluid"> 
        <div class="s7_vozovy-park-sw w-100 mx-auto">
            <h2 class="s7_underlink position-relative font-weight-bold text-center text-uppercase">Náš <span class="font-weight-light">vozový</span> park</h2>
            <p class="s7_vozovy-park-text text-center">Podívejte se, jakými vozy se u nás můžete svést. Vyberte si z naší nabídky přímo na míru.</p>
            <div class="row">
                <div class="s7_vozovy-park-auto col-lg-4 col-md-6 col-12">
                    <div class="s7_vozovy-park-content">
                        <figure class="position-relative mb-0"><img src="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/skoda.jpg" alt="" class="s7_car-img img-fluid w-100"></figure>
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
                            <i class="fas fa-taxi mr-2 pt-1"></i><span><strong>45 </strong>eur/km</span>
                            <div class="s7_vozovy-park-dot mx-2"></div>
                            <span><strong>45 </strong>eur/letištní transport</span>
                        </div>
                        <a href="#" class="btn w-100 border-0 rounded-0 text-uppercase font-weight-bold text-white">Spočítat cestu</a>
                    </div>
                </div>
                <div class="s7_vozovy-park-auto col-lg-4 col-md-6 col-12">
                    <div class="s7_vozovy-park-content">
                        <figure class="position-relative mb-0"><img src="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/skoda.jpg" alt="" class="s7_car-img img-fluid w-100"></figure>
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
                            <i class="fas fa-taxi mr-2 pt-1"></i><span><strong>45 </strong>eur/km</span>
                            <div class="s7_vozovy-park-dot mx-2"></div>
                            <span><strong>45 </strong>eur/letištní transport</span>
                        </div>
                        <a href="#" class="btn w-100 border-0 rounded-0 text-uppercase font-weight-bold text-white">Spočítat cestu</a>
                    </div>
                </div>
                <div class="s7_vozovy-park-auto col-lg-4 col-md-6 col-12">
                    <div class="s7_vozovy-park-content">
                        <figure class="position-relative mb-0"><img src="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/skoda.jpg" alt="" class="s7_car-img img-fluid w-100"></figure>
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
                            <i class="fas fa-taxi mr-2 pt-1"></i><span><strong>45 </strong>eur/km</span>
                            <div class="s7_vozovy-park-dot mx-2"></div>
                            <span><strong>45 </strong>eur/letištní transport</span>
                        </div>
                        <a href="#" class="btn w-100 border-0 rounded-0 text-uppercase font-weight-bold text-white">Spočítat cestu</a>
                    </div>
                </div>
            </div>
            <a href="#" class="s7_btn-all-cars font-weight-bold d-flex mx-auto align-items-center justify-content-between w-100">
                <span class="text-uppercase">Všechny vozy</span>
                <i class="fas fa-chevron-right"></i>
            </a>
        </div>
    </section>
    
    <!-- References -->
    <section id="references" class="container-fluid">
        <div class="s7_ref-slider s7_sw-sec mx-auto">
            <h2 class="text-center font-weight-bold text-white text-uppercase">Klientské <span class="font-weight-light text-white">reference</span></h2>
            <p class="s7_reference-undertitle text-center text-white">Nejste si jistí? Naše reference to řeknou za nás.</p>
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" data-interval="false">
                <div class="carousel-inner">
                    <div class="carousel-item text-center active">
                        <img src="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/ref-person.png" alt="" class="s7_references-person-img">
                        <p class="s7_references-slider-name font-weight-bold text-white">Petr David - Busines Manager - Praha</p>
                        <p class="s7_references-slider-text bg-white w-100 mx-auto px-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel
                        </p>
                        <a href="#" class="btn rounded-0 w-100 text-white text-uppercase font-weight-bold">Google reference</a>
                    </div>
                    <div class="carousel-item text-center">
                        <img src="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/ref-person.png" alt="" class="s7_references-person-img">
                        <p class="s7_references-slider-name font-weight-bold text-white">Petr David - Busines Manager - Praha</p>
                        <p class="s7_references-slider-text bg-white w-100 mx-auto px-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel
                        </p>
                        <a href="#" class="btn rounded-0 w-100 text-white text-uppercase font-weight-bold">Google reference</a>
                    </div>
                    <div class="carousel-item text-center">
                        <img src="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/ref-person.png" alt="" class="s7_references-person-img">
                        <p class="s7_references-slider-name font-weight-bold text-white">Petr David - Busines Manager - Praha</p>
                        <p class="s7_references-slider-text bg-white w-100 mx-auto px-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel
                        </p>
                        <a href="#" class="btn rounded-0 w-100 text-white text-uppercase font-weight-bold">Google reference</a>
                    </div>
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
        </div>
    </section>
    
    <!-- Number one -->
    <section id="number-one" class="container-fluid position-relative">
        <div class="s7_sw-sec mx-auto text-center">
            <img src="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/medaile.png" alt="" class="w-100">
            <h4 class="text-uppercase text-center font-weight-bold position-relative">Jsme jednička na trhu</h4>
            <p class="s7_number-one-text text-center font-weight-light w-100 mx-auto">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam risus nunc, pellentesque in venenatis sed, fermentum vitae nibh. Aliquam convallis pulvinar massa in rutrum</p>
        </div>
    </section>
    <section id="contact" class="s7_sw-sec mx-auto"> <!-- Contact -->
        <h2 class="text-center text-uppercase font-weight-bold">Kontakt</h2>
        <p class="s7_contact-text text-center">Rezervujte si jízdu přímo na našem dispečinku. Neváhejte zavolat.</p>
        <div class="row">
            <div class="s7_contact-col col-lg-6 col-12">
                <div class="s7_contact-phone d-flex align-items-center">
                    <img src="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/phone.png" alt="phone" class="s7_contact-ico-img w-100">
                    <a href="tel:+420 722 855 989" class="s7_contact-ico-text font-weight-bold text-decoration-none">+420 722 855 989</a>
                </div>
                <div class="s7_contact-envelope d-flex align-items-center">
                    <img src="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/envelope.png" alt="phone" class="s7_contact-ico-img w-100">
                    <a href="mailto:info@yourpraguetransfers.cz" class="s7_contact-ico-text font-weight-bold text-decoration-none">info@yourpraguetransfers.cz</a>
                </div>
                <div class="s7_contact-map d-flex align-items-center">
                    <img src="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/map-mark.png" alt="phone" class="s7_contact-ico-img w-100">
                    <span class="s7_contact-ico-text font-weight-bold">Evropská 27, 247 89, Praha 6</span>
                </div>
                <p class="s7_contact-bigger-text font-weight-bold">Něco o onás</p>
                <p class="s7_contact-info">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida.</p>
                <a href="#" class="btn rounded-0 text-uppercase text-white font-weight-bold w-100">Více o nás</a>
            </div>
            <div class="col-lg-6 col-12">
                <div class="s7_map-col h-100">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4305.254201713477!2d14.410114404675351!3d50.08779469261575!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x470b953c6dd8f6f5%3A0x4ddc99278a5a57f3!2sEvropsk%C3%A1%2027%2C%20160%2000%20Praha%206-Dejvice!5e0!3m2!1scs!2scz!4v1594397883917!5m2!1scs!2scz" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0" class="w-100 h-100"></iframe>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Justified gallery -->
    <section id="fp-gallery" class="container-fluid p-0">
        <div id="car-gallery-fp">
            <a href="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/bmw.jpg" target="_blank">
                <img src="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/bmw.jpg" alt="car-1">
            </a>
            <a href="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/vw.jpg" target="_blank">
                <img src="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/vw.jpg" alt="car-2">
            </a>
            <a href="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/kia.jpg" target="_blank">
                <img src="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/kia.jpg" alt="car-3">
            </a>
            <a href="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/vw-t.jpg" target="_blank">
                <img src="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/vw-t.jpg" alt="car-4">
            </a>
            <a href="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/skoda-gal.jpg" target="_blank">
                <img src="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/skoda-gal.jpg" alt="car-5">
            </a>
            <a href="../yourpraguetransfer/wp-content/themes/yourpraguetransfer/assets/images/bmw-2.jpg" target="_blank">
                <img src="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/bmw-2.jpg" alt="car-6">
            </a>
        </div>
        
         <!-- JS with setting for the Justified gallery -->
        <script>
    jQuery(document).ready(function() { 
		jQuery("#car-gallery-fp").justifiedGallery({
			rowHeight: 295,
            maxRowHeight: 100,
			captions : false, 
			margins : 0,
			waitThumbnailsLoad: false,
		}); 
	});

        </script>
    </section>
<?php include "footer.php"; ?>