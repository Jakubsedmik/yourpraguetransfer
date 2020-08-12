<div class="container">
	<!-- Material form register -->
	<div class="card p-0 mw-100">

		<h5 class="card-header purple-gradient white-text text-center py-4 position-relative">
			<strong>Vytvoření stavu</strong>
			<p class="mb-0 text-white">Zde můžete vytvořit stav</p>
			<a class="position-absolute admin-nav" href="<?php echo Tools::getRoute("ciselnikClass"); ?>"><i class="fas fa-bars"></i> Zpět na výpis</a>
		</h5>

		<!--Card content-->
		<div class="card-body px-lg-5 pt-0">

			<!-- Form -->
			<form class="text-center" style="color: #757575;" action="<?php Tools::getCurrentUrl(); ?>" method="POST">

				<?php
					global $classes;
					echo Tools::getSelectBoxForCustom($classes, 'db_domain', $this->getPostData('db_domain'),"Doména","db_domain");

					global $dictionary;
					echo Tools::getSelectBoxForCustom($dictionary, 'db_property', $this->getPostData('db_property'), 'Vlastnost', 'db_property','Vyhledávání', 'db_');
					?>
				<!--Email-->
				<div class="md-form">
					<input type="number" id="db_value" name="db_value" class="form-control" value="<?php echo $this->getPostData('db_value'); ?>">
					<label for="db_value">Hodnota</label>
				</div>

				<!--Email-->
				<div class="md-form">
					<input type="text" id="db_translation" name="db_translation" class="form-control" value="<?php echo $this->getPostData('db_translation'); ?>">
					<label for="db_translation">Překlad</label>
				</div>


				<!-- Sign up button -->
				<button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" name="vytvorit" value="1" type="submit">Vytvořit</button>


			</form>
			<!-- Form -->

		</div>

	</div>
	<!-- Material form register -->

</div>