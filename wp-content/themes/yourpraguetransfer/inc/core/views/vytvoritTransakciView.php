<div class="container">
	<!-- Material form register -->
	<div class="card p-0 mw-100">

		<h5 class="card-header blue-gradient white-text text-center py-4">
			<strong>Vytvoření transakce</strong>
			<p class="mb-0 text-white">Zde můžete vytvořit transakci</p>
			<a class="position-absolute admin-nav" href="<?php echo Tools::getRoute("transakceClass"); ?>"><i class="fas fa-bars"></i> Zpět na výpis</a>
		</h5>

		<!--Card content-->
		<div class="card-body px-lg-5 pt-0">

			<!-- Form -->
			<form class="text-center" style="color: #757575;" action="<?php Tools::getCurrentUrl(); ?>" method="POST">

				<!-- Množství -->
				<div class="md-form">
					<input type="number" id="db_mnozstvi" name="db_mnozstvi" class="form-control" value="<?php echo $this->getPostData('db_mnozstvi'); ?>">
					<label for="db_cena">Množství</label>
				</div>

				<!-- Název služby -->
				<div class="md-form">
					<input type="text" id="db_nazev_sluzby" name="db_nazev_sluzby" class="form-control" value="<?php echo $this->getPostData('db_nazev_sluzby'); ?>">
					<label for="db_nazev_sluzby">Název služby</label>
				</div>

				<!-- Odesílatel -->
				<div class="form-row">
					<div class="col-10">
						<?php echo Tools::getSelectBoxForEntities("uzivatelClass", $this->getPostData('db_id_odesilatel'), array('db_id', 'db_email'),'Odesílatel','db_id_odesilatel'); ?>
					</div>
					<div class="col-2">
						<a href="<?php echo Tools::getRoute("uzivatelClass", "edit",$this->getPostData('db_id_odesilatel')) ?>" class="btn-sm btn-block btn-secondary btn">Detail</a>
					</div>
				</div>

				<!-- Příjemce -->
				<div class="form-row">
					<div class="col-10">
						<?php echo Tools::getSelectBoxForEntities("uzivatelClass", $this->getPostData('db_id_prijemce'), array('db_id', 'db_email'),'Příjemce','db_id_prijemce'); ?>
					</div>
					<div class="col-2">
						<a href="<?php echo Tools::getRoute("uzivatelClass", "edit",$this->getPostData('db_id_prijemce')) ?>" class="btn-sm btn-block btn-secondary btn">Detail</a>
					</div>
				</div>

				<!-- Stav transakce -->

				<?php echo Tools::switcher("Ano","Ne", "Zaúčtováno", 1, "db_accept", $this->getPostData('db_accept')); ?>


				<!-- Sign up button -->
				<button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" name="ulozit" value="1" type="submit">Uložit</button>


			</form>
			<!-- Form -->

		</div>

	</div>
	<!-- Material form register -->

</div>
