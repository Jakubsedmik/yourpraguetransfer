<?php
require_once( __DIR__ . "/../configuration/vue-translations.php" );
$inzerat   = $this->workData['inzerat'];
$uzivatel  = $inzerat->subobjects['uzivatelClass'];
$obrazky   = $inzerat->subobjects['obrazekClass'];
$front_obr = "";
$obrazky   = array_filter( $obrazky, function ( $val ) use ( &$front_obr ) {
	if ( $val->db_front == 1 ) {
		$front_obr = $val;

		return false;
	}

	return true;
} );

$transactionid = - 1;
if ( Tools::checkPresenceOfParam( "transactionid", $this->requestData ) ) {
	$transactionid = $this->requestData['transactionid'];
}

?>

<section>
    <div class="wrapper">
        <div class="slider-content">
            <a href="<?php echo Tools::getFERoute( "inzeratClass", false, "listing" ) ?>" class="back-to-page">
                <span class="icon-arrow rotate"></span><span><?php _e( "Zpět na výpis", "realsys" ); ?></span>
            </a>
        </div>
    </div>
</section>

<section class="">
    <div class="detail-nemovitosti full-bg">
        <div class="wrapper">
			<?php echo frontendError::getFrontendErrors(); ?>
            <div class="row app">
                <div class="col-sm nemovitost-detail">
                    <div class="nemovitost-wrapper">
                        <div class="row">
                            <div class="col-sm-7">
                                <div class="nemovitost-image">
                                    <img src="<?php echo home_url() . $front_obr->db_url; ?>">
                                </div>
                                <div class="nemovitost-miniatury">
									<?php
									foreach ( $obrazky as $value ) :
										$sizes = $value->getImageDimensions();
										?>
                                        <div class="miniatura">
                                            <a href="<?php echo home_url() . $sizes['default']; ?>">
                                                <img src="<?php echo home_url() . $sizes['gallery']; ?>">
                                            </a>
                                        </div>
									<?php
									endforeach;
									?>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="nemovitost-text rounded-b">
                                    <h3 class="sz-tit"><?php echo $inzerat->getAerialName(); ?> <?php echo $inzerat->db_titulek; ?></h3>


                                    <table class="basic-table th-row" style="border-collapse: initial;">
                                        <tbody>
                                        <tr>
                                            <th><?php _e( "Dispozice", "realsys" ); ?>:</th>
                                            <td><?php echo $inzerat->db_pocet_mistnosti; ?></td>
                                        </tr>
                                        <tr>
                                            <th><?php _e( "Podlahová plocha", "realsys" ); ?>:</th>
                                            <td><span><?php echo $inzerat->getAerial(); ?></span></td>
                                        </tr>
                                        <tr>
                                            <th><?php _e( "Cena", "realsys" ); ?>:</th>
                                            <td><?php echo Tools::convertCurrency( $inzerat->db_cena ); ?></td>
                                        </tr>
                                        <tr>
                                            <th><?php _e( "Cena poznámka", "realsys" ); ?>:</th>
                                            <td><?php echo $inzerat->db_cena_poznamka; ?></td>
                                        </tr>
                                        <tr>
                                            <th><?php _e( "Město", "realsys" ); ?>:</th>
                                            <td><?php echo $inzerat->db_mesto; ?></td>
                                        </tr>
                                        <tr>
                                            <th><?php _e( "Městská část", "realsys" ); ?>:</th>
                                            <td><?php echo $inzerat->db_mestska_cast; ?></td>
                                        </tr>
                                        <tr>
                                            <th><?php _e( "Ulice", "realsys" ); ?>:</th>
                                            <td><?php echo $inzerat->db_ulice . " " . $inzerat->db_cp; ?></td>
                                        </tr>
                                        <tr>
                                            <th><?php _e( "Podlaží", "realsys" ); ?>:</th>
                                            <td><?php echo $inzerat->db_patro; ?>
                                                z <?php echo $inzerat->db_celkem_podlazi; ?></td>
                                        </tr>
                                        <tr>
                                            <th><?php _e( "Balkón", "realsys" ); ?>:</th>
                                            <td><?php echo Tools::translateBinaryValue( $inzerat->db_balkon ); ?></td>
                                        </tr>
                                        </tbody>
                                    </table>

                                    <div class="contact-bar-new">
                                        <a class="btn btn-outline btn-small scroll-vice"
                                           href="#vice"><?php echo _e( "Viac informacií", "realsys" ); ?></a>

                                        <Zobrazkontakt
                                                :user_logged="<?php echo ( uzivatelClass::getUserLoggedId() ) ? uzivatelClass::getUserLoggedId() : "false"; ?>"
                                                :service="<?php global $cenik_sluzeb;
												echo Tools::prepareJsonToOutputHtmlAttr( $cenik_sluzeb[2] ); ?>"
                                                :inzerat_id="<?php echo $inzerat->getId(); ?>"
                                                :translations="<?php echo Tools::prepareJsonToOutputHtmlAttr( array_merge( $zobrazkontakt_translations, $servicebuy_translations ) ); ?>"
                                                :transaction_id="<?php echo $transactionid; ?>"

                                                home_url="<?php echo home_url(); ?>"
                                                login_link="<?php echo Tools::getFERoute( "uzivatelClass", false, "login" ); ?>"
                                                payment_link="<?php echo Tools::getFERoute( "objednavkaClass" ); ?>"
                                                quick_payment_link="<?php echo Tools::getFERoute( "gopay", false, "quickpayment" ); ?>"
                                                ajax_url="<?php echo AJAXURL; ?>"
                                                currency="<?php echo CURRENCY; ?>"
                                                assets_path="<?php echo FRONTEND_IMAGES_PATH; ?>"
                                                user_name="<?php echo $uzivatel->getFullName(); ?>"
                                                user_avatar="<?php echo $uzivatel->db_avatar; ?>"

                                        ></Zobrazkontakt>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="nem-detail-desc" id="vice">
                                    <h3><?php echo $inzerat->getAerialName(); ?></h3>
                                    <p>
										<?php echo $inzerat->dejData( "db_popis" ); ?>
                                    </p>
                                </div>

                                <div class="nem-detail-table shadow-big rounded-b">

                                    <div class="">
                                        <h3 class="text-center"><?php _e( "Podrobné informácie", "realsys" ); ?></h3>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <table class="basic-table th-row" style="border-collapse: initial;">
                                                    <tbody>
                                                    <tr>
                                                        <th><?php _e( "Dispozice", "realsys" ); ?>:</th>
                                                        <td><?php echo $inzerat->db_pocet_mistnosti; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th><?php _e( "Podlahová plocha", "realsys" ); ?>:</th>
                                                        <td><?php echo $inzerat->getAerial(); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th><?php _e( "Pozemková plocha", "realsys" ); ?>:</th>
                                                        <td><?php echo $inzerat->getTotalAerial(); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th><?php _e( "Cena", "realsys" ); ?>:</th>
                                                        <td><?php echo Tools::convertCurrency( $inzerat->db_cena ); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th><?php _e( "Cena poznámka", "realsys" ); ?>:</th>
                                                        <td><?php echo $inzerat->db_cena_poznamka; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th><?php _e( "Město", "realsys" ); ?>:</th>
                                                        <td><?php echo $inzerat->db_mesto; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th><?php _e( "Městská část", "realsys" ); ?>:</th>
                                                        <td><?php echo $inzerat->db_mestska_cast; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th><?php _e( "PSČ", "realsys" ); ?>:</th>
                                                        <td><?php echo $inzerat->db_psc; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th><?php _e( "Ulice", "realsys" ); ?>:</th>
                                                        <td><?php echo $inzerat->db_ulice . " " . $inzerat->db_cp; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th><?php _e( "Datum přidání", "realsys" ); ?>:</th>
                                                        <td><?php echo Tools::formatTime( $inzerat->db_datum_zalozeni ); ?></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-sm-6">
                                                <table class="basic-table th-row" style="border-collapse: initial;">
                                                    <tbody>
                                                    <tr>
                                                        <th><?php _e( "Typ vlastnictví", "realsys" ); ?>:</th>
                                                        <td><?php echo $inzerat->db_typ_vlastnictvi; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th><?php _e( "Typ budovy", "realsys" ); ?>:</th>
                                                        <td><?php echo $inzerat->db_material; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th><?php _e( "PENB", "realsys" ); ?>:</th>
                                                        <td><?php echo $inzerat->db_penb; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th><?php _e( "Vybavenost", "realsys" ); ?>:</th>
                                                        <td><?php echo $inzerat->db_vybavenost; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th><?php _e( "Podlaží", "realsys" ); ?>:</th>
                                                        <td><?php echo $inzerat->db_patro; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th><?php _e( "Balkón", "realsys" ); ?>:</th>
                                                        <td><?php echo Tools::translateBinaryValue( $inzerat->db_balkon ); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th><?php _e( "Terasa", "realsys" ); ?>:</th>
                                                        <td><?php echo Tools::translateBinaryValue( $inzerat->db_terasa ); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th><?php _e( "Výtah", "realsys" ); ?>:</th>
                                                        <td><?php echo Tools::translateBinaryValue( $inzerat->db_vytah ); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th><?php _e( "Garáž", "realsys" ); ?>:</th>
                                                        <td><?php echo Tools::translateBinaryValue( $inzerat->db_garaz ); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th><?php _e( "Parkovací místo", "realsys" ); ?>:</th>
                                                        <td><?php echo Tools::translateBinaryValue( $inzerat->db_parkovaci_misto ); ?></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="text-center mt-5">
                                            <div class="contact-bar-new">
                                                <button class="btn btn-small js-transfer-from-click">Chci bydlet</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>


                </div>

            </div>
        </div>
    </div>

    <div class="mapa-cont">
        <div class="wrapper">
            <div class="row">
                <div class="col-sm">
                    <div class="mapa">
                        <div
                                class="google-map"
                                data-lat="<?php echo $inzerat->db_lat; ?>"
                                data-lng="<?php echo $inzerat->db_lng; ?>"
                                data-content="<?php echo $inzerat->getConnectedName(); ?>"

                        ></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

<?php
$similar = $inzerat->getSimilar( 4 );
if ( count( $similar ) > 0 ) :
	?>
    <section>
        <div class="podobne-nemovitosti">
            <div class="wrapper">
                <div class="section-title">
                    <h2><?php _e( "Podobné inzeráty", "realsys" ); ?></h2>
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
					$similar

				);
				$walker->walk( true );
				?>

            </div>
        </div>
    </section>
<?php endif; ?>

<?php Pixel::PixelBuy(true); ?>
