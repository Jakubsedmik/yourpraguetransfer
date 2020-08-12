<header class="main-menu-top">
    <div class="full-menu">
        <div class="main-header">
            <div class="wrapper">
                <div class="logo">
					<?php
					if ( function_exists( 'the_custom_logo' ) ) {
						the_custom_logo();
					}
					?>
                </div>
				<?php if ( has_nav_menu( 'cms_header_menu' ) ) : ?>
                    <nav class="menu">
						<?php
						$menu_args = array(
							'theme_location' => 'cms_header_menu',
							'walker'         => new Realsys_menu(),
							'container'      => ""
						);
						wp_nav_menu( $menu_args );
						?>
                    </nav>
				<?php endif; ?>




				<?php if ( uzivatelClass::getUserLoggedId() !== false ) : ?>
					<?php $uzivatel = assetsFactory::getEntity( "uzivatelClass", uzivatelClass::getUserLoggedId() ); ?>
                    <div class="user-logged">


						<?php if ( ! $uzivatel->dejData( "db_avatar" ) ) : ?>
                            <a class="logged">
                                <span class="icon-user ico"></span>
                                <div class="mess-counter">2</div>
                            </a>
						<?php else: ?>
                            <a class="logged"
                               href="<?php echo Tools::getFERoute( "uzivatelClass", UzivatelClass::getUserLoggedId() ) ?>">
                                <span class="avatar icon-user ico"
                                      style="background-image:url('<?php echo $uzivatel->db_avatar; ?>');"></span>
                            </a>
						<?php endif; ?>


                        <div class="user-login-block shadow-sm rounded light-blue-bg ">
                            <div class="user-info">
                                <div class="user-info-wrap">
                                    <div class="avatar"><img src="<?php echo $uzivatel->db_avatar; ?>" alt=""></div>
                                    <div>
                                        <h4 class="user-name"><?php echo $uzivatel->getFullName(); ?></h4>
                                        <span class="user-email"><?php echo $uzivatel->db_email; ?></span>
                                    </div>
                                </div>
                                <div class="user-credits">
                                    <span><?php echo _e( "Moje kredity:", "realsys" ); ?></span><span
                                            class="credits-num"><?php echo $uzivatel->getUserBillance(); ?></span></div>
                            </div>
                            <div class="user-menu">
                                <a href="<?php echo Tools::getFERoute( "uzivatelClass", UzivatelClass::getUserLoggedId() ) ?>"><?php _e( "Můj profil", "realsys" ); ?></a>
                                <a href="<?php echo Tools::getFERoute( "uzivatelClass", UzivatelClass::getUserLoggedId(), "detail", "editUser" ); ?>"><?php _e( "Upravit profil", "realsys" ); ?></a>
                                <a href="<?php echo Tools::getFERoute( "uzivatelClass", UzivatelClass::getUserLoggedId(), "detail", "logOut" ); ?>"><?php _e( "Odhlásit se", "realsys" ); ?></a>
                            </div>
                        </div>
                    </div>
				<?php else : ?>

                    <div class="user-login">
                        <a href="<?php echo Tools::getFERoute( "uzivatelClass", false, "login" ); ?>"
                           class="logged"><span class="icon-user ico"></span></a>
                    </div>
				<?php endif; ?>


            </div>
        </div>
        <!--<div class="menu-bar">
            <div class="wrapper">

                <nav class="menu">
                <?php if ( has_nav_menu( 'category_header_menu' ) ) :

			$menu_args = array(
				'theme_location' => 'category_header_menu',
				'container'      => ""
			);
			wp_nav_menu( $menu_args );

		else :

			$ciselnik = assetsFactory::getAllDials( "inzeratClass", "typ_nemovitosti" ); ?>
                        <ul id="menu-kategorie" class="menu">

                            <?php foreach ( $ciselnik as $key => $val ) : ?>
                                <li class="menu-item menu-item-type-custom menu-item-object-custom">
                                    <a href="#">
                                        <?php echo $val->db_translation; ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>

                <?php endif; ?>
                </nav>

            </div>
        </div>-->
    </div>

    <div class="mobile-menu">
        <div class="logo">
			<?php
			if ( function_exists( 'the_custom_logo' ) ) {
				the_custom_logo();
			}
			?>
        </div>
        <div id="nav-icon3" class="burger-menu-icon">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>

        <div class="menu-wrap">
            <div class="mob-menu-btns">
                <a href="<?php echo Tools::getFERoute( "inzeratClass", false, "add" ); ?>"
                   class="btn"><?php _e( "Přidat inzerát", "realsys" ); ?></a>
                <a href="#" class="btn" style="display:none"><?php _e( "Hledat inzerát", "realsys" ); ?></a>
            </div>
            <div class="mob-menu-nav" style="display:none">
				<?php
				$menu_args = array(
					'theme_location' => 'cms_header_menu',
					'walker'         => new Realsys_menu(),
					'container'      => ""
				);
				wp_nav_menu( $menu_args );
				?>
            </div>

            <div class="mob-user-wrap">
				<?php if ( uzivatelClass::getUserLoggedId() !== false ) : ?>
                    <div class="mob-user">
                        <ul class="mob-user-logout">
                            <li>
                                <a href="<?php echo Tools::getFERoute( "uzivatelClass", UzivatelClass::getUserLoggedId(), "detail", "logOut" ); ?>"><?php _e( "Odhlásit se", "realsys" ); ?></a>
                            </li>
                        </ul>
                        <div class="mob-user-profile">
                            <div class="mob-user-info">
                                <h2><?php echo $uzivatel->getFullName(); ?></h2>
                                <span class="profil-kvalita" style="display:none;">Kvalita profilu <span
                                            class="kvalita-data">100%</span></span>
                            </div>
                            <div class="mob-user-avatar"
                                 style="background-image: url(<?php echo FRONTEND_IMAGES_PATH; ?>/avatar.png)"></div>
                        </div>
                    </div>
				<?php else : ?>
                    <ul class="mob-user-sign">
                        <li>
                            <a href="<?php echo Tools::getFERoute( "uzivatelClass", false, "login" ) ?>"><?php _e( "Přihlášení", "realsys" ); ?></a>
                        </li>
                        <li>
                            <a href="<?php echo Tools::getFERoute( "uzivatelClass", false, "login" ) ?>"><?php _e( "Registrace", "realsys" ); ?></a>
                        </li>
                    </ul>
				<?php endif; ?>


            </div>

        </div>
    </div>
</header>
