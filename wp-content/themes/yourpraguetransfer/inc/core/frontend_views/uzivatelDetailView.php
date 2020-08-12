<?php

	$uzivatel = $this->workData['uzivatel'];
	$inzeraty  = $uzivatel->subobjects['inzeratClass'];
	$inzeraty = array_filter($inzeraty, function ($value, $key){
	    return $value->db_stav_inzeratu == 1;
    },ARRAY_FILTER_USE_BOTH);
	if(!is_array($inzeraty)) $inzeraty = array();

?>





<section class="profil">
<?php invisibleRecaptchaClass::generateRecaptchaListeners(); ?>
	<div class="wrapper">
		<div class="row">
			<div class="col-lg-3">
				<div class="profile-main-info text-center rounded-b shadow-sm p-20">
					<div class="profile-img-wrap" style="background-image: url(<?php echo $uzivatel->db_avatar; ?>)"></div>
					<h2 class="sz-tit mb-2"><?php echo $uzivatel->getFullName(); ?></h2>



					<p class="prof-kvalita"><?php _e("Kvalita profilu ", "realsys"); ?><span class="prof-kvalit-value">100%</span></p>

				</div>
				<div class="profile-menu-wrap">
					<nav class="profile-menu">
						<ul>
							<li><a id="tab1" class="profile-menu-link active"><?php _e("Profil uživatele", "realsys"); ?></a></li>
							<li><a id="tab3" class="profile-menu-link"><?php _e("Inzeráty uživatele", "realsys"); ?></a></li>
						</ul>
					</nav>
				</div>

			</div>
			<div class="col-lg-9">
				<div class="content-wrap rounded-b shadow-sm p-20 tab-sl-content" id="tab1C">
					<h1 class="sz-tit text-center mb-3 mt-3"><?php _e("Profil uživatele ", "realsys"); ?></h1>

					<!-- start profil view -->
					<div class="profil-view profil-main-content">
						<div class="row">
							<div class="col-sm-3 profil-form-desc">
								<span class="input-desc sz-tip-desc"><?php _e("Szukamdom Tip:", "realsys"); ?></span>
							</div>
							<div class="col-sm-9 profil-form-content">
								<p class="sz-tip-txt"><?php _e("Čím viac informácii o sebe vyplníte, tým väčšia zaujímavejší je Váš profil pre tých, s ktorými ste v kontakte.", "realsys"); ?></p>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-3 profil-form-desc">
								<span class="input-desc"><?php _e("Základní údaje:", "realsys"); ?></span>
							</div>
							<div class="col-sm-9 profil-form-content">
								<div class="row">
									<div class="col-sm-6 correct"><?php _e("Jméno:", "realsys"); ?> <span class="profil-val"><?php echo $uzivatel->getFullName(); ?></span></div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-3 profil-form-desc">
								<span class="input-desc"><?php _e("Další informace:", "realsys"); ?></span>
							</div>
							<div class="col-sm-9 profil-form-content">
								<div class="row">
									<div class="col-sm-6 correct"><?php _e("E-mail:", "realsys"); ?> <span class="profil-val"><?php echo $uzivatel->db_email; ?></span></div>
									<div class="col-sm-6 correct"><?php _e("Telefon:", "realsys"); ?> <span class="profil-val"><?php echo Tools::formatPhone($uzivatel->db_telefon); ?></span></div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-3 profil-form-desc">
								<span class="input-desc"><?php _e("Krátke bio:", "realsys"); ?></span>
							</div>
							<div class="col-sm-9 profil-form-content">
								<div class="row">
									<div class="col correct"><?php echo $uzivatel->db_popis; ?> </div>
								</div>
							</div>
						</div>

					</div>
					<!-- end profil view -->

				</div>

				<div class="content-wrap rounded-b shadow-sm p-20 tab-sl-content" id="tab3C">
					<h1 class="sz-tit text-center mb-4 mt-3"><?php _e("Inzeráty uživatele", "realsys"); ?></h1>
					<?php if(count($inzeraty)>0) : ?>
						<section>
							<div class="top-nemovitosti">
								<div class="wrapper">
									<div class="nemovitost-rows-wrap app">

										<div class="section-title sides-align">
											<h3><?php _e( "Nemovitosti uživatele", "realsys" ); ?></h3>
											<a class="btn" href="<?php echo Tools::getFERoute("inzeratClass",false, "add") ?>">
                                                <?php _e( "Vložit inzerát", "realsys" );?>
                                            </a>
										</div>

										<?php
                                            $walker = new assetWalkerClass(
                                                "inzeratClass",
                                                "nem_item.php",
                                                1,
                                                6,
                                                'div',
                                                'row',
                                                false,
                                                'top',
                                                "DESC",
                                                $inzeraty

                                            );
                                            $walker->walk(true);
                                            ?>
									</div>
								</div>
							</div>
						</section>
					<?php endif; ?>
				</div>

			</div>
		</div>
	</div>
	</div>
</section>
