<div class="container">
	<!-- Material form register -->
	<div class="card p-0 mw-100">

		<h5 class="card-header blue-gradient white-text text-center py-4">
			<strong>Editace objednávky</strong>
			<p class="mb-0 text-white">Zde můžete upravit objednávku</p>
            <a class="position-absolute admin-nav" href="<?php echo Tools::getRoute("objednavkaClass"); ?>"><i class="fas fa-bars"></i> Zpět na výpis</a>
		</h5>

		<!--Card content-->
		<div class="card-body px-lg-5 pt-0">

			<!-- Form -->
			<form class="text-center" style="color: #757575;" action="<?php Tools::getCurrentUrl(); ?>" method="POST">
				<input type="hidden" name="db_id" value="<?php echo $this->viewData['objednavka']->getId(); ?>">

				<!-- Cena-->
				<div class="md-form">
					<input type="number" id="db_cena" name="db_cena" class="form-control" value="<?php echo $this->viewData['objednavka']->dejData('db_cena'); ?>">
					<label for="db_cena">Cena</label>
				</div>
				<!-- Množství -->
				<div class="md-form">
					<input type="number" id="db_mnozstvi" name="db_mnozstvi" class="form-control" value="<?php echo $this->viewData['objednavka']->dejData('db_mnozstvi'); ?>">
					<label for="db_mnozstvi">Množství</label>
				</div>
				<!-- Připojený uživatel -->
                <div class="form-row">
                    <div class="col-10">
	                    <?php echo Tools::getSelectBoxForEntities("uzivatelClass", $this->viewData['objednavka']->db_uzivatel_id, array('db_id', 'db_email'),'Uživatel','db_uzivatel_id'); ?>
                    </div>
                    <div class="col-2">
                        <a href="<?php echo Tools::getRoute("uzivatelClass", "edit",$this->viewData['objednavka']->db_uzivatel_id) ?>" class="btn-sm btn-block btn-secondary btn">Detail</a>
                    </div>
                </div>

				<!-- Stav objednávky -->
				<div class="md-form">
					<?php echo Tools::getSelectBoxForDials("objednavkaClass","stav",$this->viewData['objednavka']->db_stav, 'Stav objednávky', "db_stav"); ?>
				</div>

				<div class="form-row">
					<div class="col">
						<div class="md-form">
							<?php
							$datumUpravy =  $this->viewData['objednavka']->db_datum_upravy;
							$datumUpravy = date("d.m.Y H:i:s", $datumUpravy);
							?>
							<input placeholder="Vyberte datum" type="text" id="db_datum_upravy" name="db_datum_upravy" class="form-control" disabled value="<?php echo $datumUpravy; ?>">
							<label for="db_datum_upravy">Datum a čas úpravy</label>
						</div>

					</div>
					<div class="col">
						<div class="md-form">
							<?php
							$mdbTime = Tools::getMdbNotationDate($this->viewData['objednavka']->db_datum_zalozeni);
							?>
							<input placeholder="Vyberte datum" type="text" id="db_datum_zalozeni" name="datum_zalozeni" class="form-control datepicker" data-value="<?php echo $mdbTime; ?>">
							<label for="db_datum_zalozeni">Datum vytvoření</label>
						</div>
					</div>
				</div>


				<?php
					$invoice_id = $this->viewData['objednavka']->db_invoice_id;
					$invoice_link = $this->viewData['objednavka']->db_invoice_link;
				?>

                <p>Pro zregenrování faktury stačí tuto objednávku přepnout do stavu zaplacená a znovu uložit.</p>
				<?php if($invoice_id !== -1 && $invoice_link !== '') : ?>
					<div class="form-row">
						<div class="col">
							<div class="md-form">
								<input placeholder="Fakturoid ID" type="text" id="db_invoice_id" name="db_invoice_id" class="form-control" disabled value="<?php echo $invoice_id; ?>">
								<label for="db_datum_upravy">Fakturoid ID</label>
							</div>

						</div>
						<div class="col">
							<div class="md-form">
								<a href="<?php echo $invoice_link; ?>" target="_blank" class="btn btn-small btn-icon btn-amber"><i class="fas fa-file-invoice mr-2"></i> Faktura</a>
							</div>
						</div>
					</div>
				<?php endif; ?>
				<!-- Sign up button -->
				<button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" name="ulozit" value="1" type="submit">Upravit</button>


			</form>
			<!-- Form -->

		</div>

	</div>
	<!-- Material form register -->

</div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDU9RxWxpRRoy9R-wAILv5Owb7GaXHLVaw"
        async defer></script>