<div class="container">
	<!-- Material form register -->
	<div class="card p-0 mw-100">

		<h5 class="card-header purple-gradient white-text text-center py-4 position-relative">
			<strong>Editace obrázku</strong>
			<p class="mb-0 text-white">Zde můžete upravit obrázek</p>
			<a class="position-absolute admin-nav" href="<?php echo Tools::getRoute("obrazekClass"); ?>"><i class="fas fa-bars"></i> Zpět na výpis</a>
		</h5>

		<!--Card content-->
		<div class="card-body px-lg-5 pt-0">

			<!-- Form -->
			<form class="text-center" style="color: #757575;" action="<?php Tools::getCurrentUrl(); ?>" method="POST">
				<input type="hidden" name="db_id" value="<?php echo $this->viewData['obrazek']->getId(); ?>">


				<?php
				$obr = $this->viewData['obrazek']->dejData('db_url');
				?>
				<div class="form-row mt-4">
					<div class="col-5">
						<figure class="pr-3">
                            <div class="js-singleFileUploader fileUploader pr-3" data-api-url="<?php echo AJAXURL ?>" data-property-name="db_url" data-secondary-property-name="db_kod">
                                <input type="hidden" name="db_url" value="<?php echo $obr ?>">
                                <input type="hidden" name="db_kod" value="<?php echo $obr ?>">
                                <?php if($obr != null): ?>
                                    <img src="<?php echo home_url() . $obr; ?>" class="img-fluid js-singleFileUploaderImage">
                                <?php else: ?>
                                    <img src="<?php echo BASE_URL . ASSETS_PATH . 'images/images_backend/default_profile.jpg'; ?>" class="img-fluid js-singleFileUploaderImage">
                                <?php endif; ?>
                                <div class="mt-2">
                                    <input type="file" name="files">
                                </div>
                            </div>
						</figure>



					</div>

					<div class="col-7">
						<!-- Titulek -->
						<div class="md-form">
							<input type="text" id="db_titulek" name="db_titulek" class="form-control" value="<?php echo $this->viewData['obrazek']->dejData('db_titulek'); ?>">
							<label for="db_titulek">Titulek</label>
						</div>
						<!--Popisek-->
						<div class="md-form">
							<input type="text" id="db_popisek" name="db_popisek" class="form-control" value="<?php echo $this->viewData['obrazek']->dejData('db_popisek'); ?>">
							<label for="db_popisek">Popisek</label>
						</div>
						<!--Email-->
						<div class="md-form">
							<input type="text" id="db_kod" name="db_kod" class="form-control" value="<?php echo $this->viewData['obrazek']->dejData('db_kod'); ?>">
							<label for="db_kod">Kód názvu</label>
						</div>
                        <div class="form-row js-detail-button">
                            <div class="col-10">
						        <?php echo Tools::getSelectBoxForEntities("inzeratClass", $this->viewData['obrazek']->db_inzerat_id, array('db_id', 'db_titulek'),'Inzerát','db_inzerat_id'); ?>
                            </div>
                            <div class="col-2">
                                <a href="<?php echo Tools::getRoute("inzeratClass","edit",$this->viewData['obrazek']->db_inzerat_id) ?>" class="btn btn-secondary btn-sm">Detail</a>
                            </div>
                        </div>
						<div>
							<?php echo Tools::switcher("Ano","Ne", "Je Front", 1, "db_front", $this->viewData['obrazek']->db_front); ?>
						</div>
					</div>

				</div>


				<div class="form-row">
					<div class="col">
						<div class="md-form">
							<?php
							$datumUpravy =  $this->viewData['obrazek']->db_datum_upravy;
							$datumUpravy = date("d.m.Y H:i:s", $datumUpravy);
							?>
							<input placeholder="Vyberte datum" type="text" id="db_datum_upravy" name="db_datum_upravy" class="form-control" disabled value="<?php echo $datumUpravy; ?>">
							<label for="db_datum_upravy">Datum a čas úpravy</label>
						</div>

					</div>
					<div class="col">
						<div class="md-form">
							<?php
							$mdbTime = Tools::getMdbNotationDate($this->viewData['obrazek']->db_datum_zalozeni);
							?>
							<input placeholder="Vyberte datum" type="text" id="db_datum_zalozeni" name="datum_zalozeni" class="form-control datepicker" data-value="<?php echo $mdbTime; ?>">
							<label for="db_datum_zalozeni">Datum vytvoření</label>
						</div>
					</div>
				</div>

				<!-- Sign up button -->
				<button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" name="ulozit" value="1" type="submit">Upravit</button>
                <a href="<?php echo Tools::getRoute("obrazekClass","regenerateImages", $this->viewData['obrazek']->getId());?>" class="btn btn-blue-grey mt-3">Regenerovat obrázek <i class="far fa-image"></i></a>

			</form>
			<!-- Form -->

		</div>

	</div>
	<!-- Material form register -->

</div>