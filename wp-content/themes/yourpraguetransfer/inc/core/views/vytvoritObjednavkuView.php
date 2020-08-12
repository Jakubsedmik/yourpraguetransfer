<div class="container">
	<!-- Material form register -->
	<div class="card p-0 mw-100">

		<h5 class="card-header blue-gradient white-text text-center py-4">
			<strong>Vytvoření objednávky</strong>
			<p class="mb-0 text-white">Zde můžete vytvořit objednávku</p>
            <a class="position-absolute admin-nav" href="<?php echo Tools::getRoute("objednavkaClass"); ?>"><i class="fas fa-bars"></i> Zpět na výpis</a>
		</h5>

		<!--Card content-->
		<div class="card-body px-lg-5 pt-0">

			<!-- Form -->
			<form class="text-center" style="color: #757575;" action="<?php Tools::getCurrentUrl(); ?>" method="POST">

				<!-- Cena-->
				<div class="md-form">
					<input type="number" id="db_cena" name="db_cena" class="form-control" value="<?php echo $this->getPostData('db_cena'); ?>">
					<label for="db_cena">Cena</label>
				</div>
				<!-- Množství -->
				<div class="md-form">
					<input type="number" id="db_mnozstvi" name="db_mnozstvi" class="form-control" value="<?php echo $this->getPostData('db_mnozstvi'); ?>">
					<label for="db_mnozstvi">Množství</label>
				</div>
				<!-- Připojený inzerát -->
                <?php echo Tools::getSelectBoxForEntities("uzivatelClass", $this->getPostData('db_uzivatel_id'), array('db_id', 'db_email'),'Uživatel','db_uzivatel_id'); ?>

				<!-- Stav objednávky -->
				<div class="md-form">
					<?php echo Tools::getSelectBoxForDials("objednavkaClass","stav", $this->getPostData('db_stav'), 'Stav objednávky', "db_stav"); ?>
				</div>

                <!-- Sign up button -->
				<button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" name="vytvorit" value="1" type="submit">Vytvořit</button>


			</form>
			<!-- Form -->

		</div>

	</div>
	<!-- Material form register -->

</div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDU9RxWxpRRoy9R-wAILv5Owb7GaXHLVaw"
        async defer></script>