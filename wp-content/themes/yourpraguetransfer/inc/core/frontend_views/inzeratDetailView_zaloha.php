<?php

$inzerat   = $this->workData['inzerat'];
$uzivatel  = $inzerat->subobjects['uzivatelClass'];
$obrazky   = $inzerat->subobjects['obrazekClass'];
$front_obr = "test";
$obrazky   = array_filter( $obrazky, function ( $val ) use ( &$front_obr ) {
	if ( $val->db_front == 1 ) {
		$front_obr = $val;

		return false;
	}

	return true;
} );

?>

<section>
    <div class="slider_sub">
        <div class="wrapper">
            <div class="slider-content">
                <div class="slider-title-second">
                    <h1><strong><?php echo $inzerat->getConnectedName(); ?></strong></h1>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="detail-nemovitosti">
        <div class="wrapper">
            <?php echo frontendError::getFrontendErrors(); ?>
            <div class="row">
                <div class="col-sm nemovitost-detail">
                    <div class="nemovitost-wrapper">
                        <div class="row">
                            <div class="col-sm-8">
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
                            <div class="col-sm-4">
                                <div class="nemovitost-text">
                                    <h3><?php echo $inzerat->db_titulek; ?></h3>
                                    <h4><?php echo $inzerat->getAerialName(); ?></h4>
                                    <p><?php echo Tools::getTextPart( $inzerat->db_popis ); ?></p>


                                    <h4><?php echo _e( "Základní informace", "realsys" ); ?></h4>
                                    <div class="metaInfo-bar">
                                        <div class="infoIco location">
                                            <img src="<?php echo FRONTEND_IMAGES_PATH; ?>/ikony/location.png" alt=""/>
                                            <span class="metaTxt"><?php echo $inzerat->db_mesto; ?></span>
                                        </div>
                                        <div class="infoIco size">
                                            <img src="<?php echo FRONTEND_IMAGES_PATH; ?>/ikony/size.png" alt=""/>
                                            <span class="metaTxt"><?php echo $inzerat->getAerial(); ?></span>
                                        </div>
                                    </div>


                                    <h4><?php echo _e( "Cena nemovitosti", "realsys" ); ?></h4>
                                    <div class="price-bar">
                                        <h3 class="price"><?php echo Tools::convertCurrency( $inzerat->db_cena ); ?></h3>
                                        <span> / měsíčně</span>
                                    </div>


                                    <h4><?php echo _e( "Kontaktujte prodejce", "realsys" ); ?></h4>
                                    <div class="contactBar">
                                        <a href="tel:<?php echo $uzivatel->db_telefon; ?>" class="phone"><?php echo Tools::formatPhone($uzivatel->db_telefon); ?></a>
                                        <span class="mail"><?php echo $uzivatel->db_email; ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-8">
                                <div class="nem-detail-desc">
                                    <h3><?php echo _e( "Popis nemovitosti", "realsys" ); ?></h3>
                                    <p>
										<?php echo $inzerat->dejData( "db_popis" ); ?>
                                    </p>
                                </div>

                                <div class="nem-detail-table">

                                    <div class="nem-detail-desc">
                                        <h3><?php echo _e( "Parametry nemovitosti", "realsys" ); ?></h3>
                                        <table class="table" style="border-collapse: initial;">
                                            <tbody>
                                            <tr>
                                                <th><?php echo _e( "Dispozice", "realsys" ); ?>:</th>
                                                <td><?php echo $inzerat->db_pocet_mistnosti; ?></td>
                                            </tr>
                                            <tr>
                                                <th><?php echo _e( "Podlahová plocha", "realsys" ); ?>:</th>
                                                <td><?php echo $inzerat->getAerial(); ?></td>
                                            </tr>
                                            <tr>
                                                <th><?php echo _e( "Pozemková plocha", "realsys" ); ?>:</th>
                                                <td><?php echo $inzerat->getTotalAerial(); ?></td>
                                            </tr>
                                            <tr>
                                                <th><?php echo _e( "Cena", "realsys" ); ?>:</th>
                                                <td><?php echo Tools::convertCurrency($inzerat->db_cena);?></td>
                                            </tr>
                                            <tr>
                                                <th><?php echo _e( "Cena poznámka", "realsys" ); ?>:</th>
                                                <td><?php echo $inzerat->db_cena_poznamka;?></td>
                                            </tr>
                                            <tr>
                                                <th><?php echo _e( "Město", "realsys" ); ?>:</th>
                                                <td><?php echo $inzerat->db_mesto; ?></td>
                                            </tr>
                                            <tr>
                                                <th><?php echo _e( "Městská část", "realsys" ); ?>:</th>
                                                <td><?php echo $inzerat->db_mestska_cast; ?></td>
                                            </tr>
                                            <tr>
                                                <th><?php echo _e( "PSČ", "realsys" ); ?>:</th>
                                                <td><?php echo $inzerat->db_psc; ?></td>
                                            </tr>
                                            <tr>
                                                <th><?php echo _e( "Ulice", "realsys" ); ?>:</th>
                                                <td><?php echo $inzerat->db_ulice . " " . $inzerat->db_cp; ?></td>
                                            </tr>
                                            <tr>
                                                <th><?php echo _e( "Typ vlastnictví", "realsys" ); ?>:</th>
                                                <td><?php echo $inzerat->db_typ_vlastnictvi; ?></td>
                                            </tr>
                                            <tr>
                                                <th><?php echo _e( "Typ budovy", "realsys" ); ?>:</th>
                                                <td><?php echo $inzerat->db_material; ?></td>
                                            </tr>
                                            <tr>
                                                <th><?php echo _e( "PENB", "realsys" ); ?>:</th>
                                                <td><?php echo $inzerat->db_penb; ?></td>
                                            </tr>
                                            <tr>
                                                <th><?php echo _e( "Vybavenost", "realsys" ); ?>:</th>
                                                <td><?php echo $inzerat->db_vybavenost; ?></td>
                                            </tr>
                                            <tr>
                                                <th><?php echo _e( "Podlaží", "realsys" ); ?>:</th>
                                                <td><?php echo $inzerat->db_patro; ?></td>
                                            </tr>
                                            <tr>
                                                <th><?php echo _e( "Balkón", "realsys" ); ?>:</th>
                                                <td><?php echo Tools::translateBinaryValue($inzerat->db_balkon); ?></td>
                                            </tr>
                                            <tr>
                                                <th><?php echo _e( "Terasa", "realsys" ); ?>:</th>
                                                <td><?php echo Tools::translateBinaryValue($inzerat->db_terasa); ?></td>
                                            </tr>
                                            <tr>
                                                <th><?php echo _e( "Výtah", "realsys" ); ?>:</th>
                                                <td><?php echo Tools::translateBinaryValue($inzerat->db_vytah); ?></td>
                                            </tr>
                                            <tr>
                                                <th><?php echo _e( "Garáž", "realsys" ); ?>:</th>
                                                <td><?php echo Tools::translateBinaryValue($inzerat->db_garaz); ?></td>
                                            </tr>

                                            <tr>
                                                <th><?php echo _e( "Parkovací místo", "realsys" ); ?>:</th>
                                                <td><?php echo Tools::translateBinaryValue($inzerat->db_parkovaci_misto); ?></td>
                                            </tr>

                                            <tr>
                                                <th><?php echo _e( "Garáž", "realsys" ); ?>:</th>
                                                <td><?php echo Tools::translateBinaryValue($inzerat->db_garaz); ?></td>
                                            </tr>
                                            </tbody>
                                        </table>

                                    </div>

                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="banner-place"></div>
                            </div>
                        </div>


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

            </div>
        </div>
</section>

<?php
    $similar = $inzerat->getSimilar(4);
    if(count($similar) > 0) :
?>
    <section>
        <div class="podobne-nemovitosti">
            <div class="wrapper">
                <div class="section-title">
                    <h2>Podobné inzeráty</h2>
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
                $walker->walk(true);
                ?>

            </div>
        </div>
    </section>
<?php endif; ?>

<?php get_template_part( "templates/page", "cta" ); ?>

