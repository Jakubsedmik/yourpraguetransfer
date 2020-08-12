<div class="container">
	<!-- Material form register -->
	<div class="card p-0 mw-100">

		<h5 class="card-header peach-gradient white-text text-center py-4">
			<strong>Vytvoření uživatele</strong>
			<p class="mb-0 text-white">Zde můžete vytvořit uživatele</p>
			<a class="position-absolute admin-nav" href="<?php echo Tools::getRoute("uzivatelClass"); ?>"><i class="fas fa-bars"></i> Zpět na výpis</a>
		</h5>

		<!--Card content-->
		<div class="card-body px-lg-5 pt-0">

			<!-- Form -->
			<form class="text-center" style="color: #757575;" action="<?php Tools::getCurrentUrl(); ?>" method="POST">

				<div class="form-row mt-5">

					<div class="col-4 js-change-image-container">
						<figure class="pr-3">
							<input type="hidden" name="db_avatar" value="<?php echo $this->getPostData('db_avatar'); ?>" class="js-change-image-value">
							<?php $obr = $this->getPostData('db_avatar'); ?>
							<?php if(strlen($obr) > 0): ?>
								<img src="<?php echo $obr; ?>" class="img-fluid js-change-image-img">
							<?php else: ?>
								<img src="<?php echo home_url() . ASSETS_PATH . 'images/images_backend/default_profile.jpg'; ?>" class="img-fluid js-change-image-img">
							<?php endif; ?>
						</figure>
						<button type="button" class="btn btn-primary btn-sm js-change-image">Upravit Avatar</button>
					</div>


					<div class="col-8">
						<!-- Titulek -->
						<div class="md-form">
							<input type="text" id="db_jmeno" name="db_jmeno" class="form-control" value="<?php echo $this->getPostData('db_jmeno'); ?>">
							<label for="db_jmeno">Jméno</label>
						</div>
						<!--Popisek-->
						<div class="md-form">
							<input type="text" id="db_prijmeni" name="db_prijmeni" class="form-control" value="<?php echo $this->getPostData('db_prijmeni'); ?>">
							<label for="db_prijmeni">Příjmení</label>
						</div>
						<!--Email-->
						<div class="md-form">
							<input type="text" id="db_email" name="db_email" class="form-control" value="<?php echo $this->getPostData('db_email'); ?>">
							<label for="db_email">Email</label>
						</div>
						<!--Telefon-->
						<div class="md-form">
							<input type="text" id="db_telefon" name="db_telefon" class="form-control" value="<?php echo $this->getPostData('db_telefon'); ?>">
							<label for="db_telefon">Telefon</label>
						</div>
					</div>


				</div>

				<!--Popisek-->
				<div class="md-form">
					<textarea id="db_popis" name="db_popis" class="md-textarea form-control"><?php echo $this->getPostData('db_popis'); ?></textarea>
					<label for="db_popis">Popis</label>
				</div>

				<!--Fb id-->
				<div class="md-form">
					<input type="text" id="db_fbid" name="db_fbid" class="form-control" value="<?php echo $this->getPostData('db_fbid'); ?>">
					<label for="db_fbid">FB ID</label>
				</div>

				<!--Google id-->
				<div class="md-form">
					<input type="text" id="db_gmid" name="db_gmid" class="form-control" value="<?php echo $this->getPostData('db_gmid'); ?>">
					<label for="db_gmid">Google ID</label>
				</div>

				<?php echo Tools::switcher("Ano","Ne", "Stav", 1, "db_stav", $this->getPostData('db_stav')); ?>


				<!-- Sign up button -->
				<button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" name="vytvorit" value="1" type="submit">Vytvořit</button>


			</form>
			<!-- Form -->

		</div>

	</div>
	<!-- Material form register -->

</div>