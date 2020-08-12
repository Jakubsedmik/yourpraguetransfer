<div class="container">
	<!-- Material form register -->
	<div class="card p-0 mw-100">

		<h5 class="card-header blue-gradient white-text text-center py-4">
			<strong>Editace transakce</strong>
			<p class="mb-0 text-white">Zde můžete upravit transakci</p>
			<a class="position-absolute admin-nav" href="<?php echo Tools::getRoute("transakceClass"); ?>"><i class="fas fa-bars"></i> Zpět na výpis</a>
		</h5>

		<!--Card content-->
		<div class="card-body px-lg-5 pt-0">

			<!-- Form -->
			<form class="text-center" style="color: #757575;" action="<?php Tools::getCurrentUrl(); ?>" method="POST">
				<input type="hidden" name="db_id" value="<?php echo $this->viewData['transakce']->getId(); ?>">

				<!-- Množství -->
				<div class="md-form">
					<input type="number" id="db_mnozstvi" name="db_mnozstvi" class="form-control" value="<?php echo $this->viewData['transakce']->dejData('db_mnozstvi'); ?>">
					<label for="db_cena">Množství</label>
				</div>

				<!-- Název služby -->
				<div class="md-form">
					<input type="text" id="db_nazev_sluzby" name="db_nazev_sluzby" class="form-control" value="<?php echo $this->viewData['transakce']->dejData('db_nazev_sluzby'); ?>">
					<label for="db_nazev_sluzby">Název služby</label>
				</div>

				<!-- Odesílatel -->
				<div class="form-row">
					<div class="col-10">
						<?php echo Tools::getSelectBoxForEntities("uzivatelClass", $this->viewData['transakce']->db_id_odesilatel, array('db_id', 'db_email'),'Uživatel','db_id_odesilatel'); ?>
					</div>
					<div class="col-2">
						<a href="<?php echo Tools::getRoute("uzivatelClass", "edit",$this->viewData['transakce']->db_id_odesilatel) ?>" class="btn-sm btn-block btn-secondary btn">Detail</a>
					</div>
				</div>

				<!-- Příjemce -->
				<div class="form-row">
					<div class="col-10">
						<?php echo Tools::getSelectBoxForEntities("uzivatelClass", $this->viewData['transakce']->db_id_prijemce, array('db_id', 'db_email'),'Uživatel','db_id_prijemce'); ?>
					</div>
					<div class="col-2">
						<a href="<?php echo Tools::getRoute("uzivatelClass", "edit",$this->viewData['transakce']->db_id_prijemce) ?>" class="btn-sm btn-block btn-secondary btn">Detail</a>
					</div>
				</div>

				<!-- Stav transakce -->

				<?php echo Tools::switcher("Ano","Ne", "Zaúčtováno", 1, "db_accept", $this->viewData['transakce']->db_accept); ?>


				<br>

				<div class="form-row">
					<div class="col">
						<div class="md-form">
							<?php
							$datumUpravy =  $this->viewData['transakce']->db_datum_upravy;
							$datumUpravy = date("d.m.Y H:i:s", $datumUpravy);
							?>
							<input placeholder="Vyberte datum" type="text" id="db_datum_upravy" name="db_datum_upravy" class="form-control" disabled value="<?php echo $datumUpravy; ?>">
							<label for="db_datum_upravy">Datum a čas úpravy</label>
						</div>

					</div>
					<div class="col">
						<div class="md-form">
							<?php
							$mdbTime = Tools::getMdbNotationDate($this->viewData['transakce']->db_datum_zalozeni);
							?>
							<input placeholder="Vyberte datum" type="text" id="db_datum_zalozeni" name="datum_zalozeni" class="form-control datepicker" data-value="<?php echo $mdbTime; ?>">
							<label for="db_datum_zalozeni">Datum vytvoření</label>
						</div>
					</div>
				</div>

				<!-- Sign up button -->
				<button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" name="ulozit" value="1" type="submit">Upravit</button>


			</form>
			<!-- Form -->

		</div>

	</div>
	<!-- Material form register -->

</div>
