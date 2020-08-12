<?php $uzivatel = $this->workData['uzivatel']; ?>

<section class="my-profile my-profile-edit">

	<?php echo frontendError::getBackendErrors(); ?>

	<div class="profileInfo-con">
		<div class="wrapper">

			<div class="section-title left-align">
				<h2><?php _e( "Hlavní informace", "realsys" ); ?></h2>
			</div>

			<form class="js-validate-form" method="post">
				<div class="row top-info">
					<div class="col-sm-2">
						<a href="#" class="edit-icon js-changeImage"><i class="fas fa-pen"></i></a>

						<div class="profile-img" style="background-image: url(<?php echo $uzivatel->dejData('db_avatar'); ?>)"></div>

					</div>

					<div class="col-sm-4">
						<div class="basic-info">
							<div class="form-row">
								<label><?php _e( "Jméno", "realsys" ); ?></label>
								<input type="text" placeholder="<?php _e( "Jméno", "realsys" ); ?>" value="<?php echo $uzivatel->dejData('db_jmeno'); ?>" name="db_jmeno">
							</div>
							<div class="form-row">
								<label><?php _e( "Příjmení", "realsys" ); ?></label>
								<input type="text" placeholder="<?php _e( "Příjmení", "realsys" ); ?>" value="<?php echo $uzivatel->dejData('db_prijmeni'); ?>" name="db_prijmeni">
							</div>

						</div>

					</div>
					<div class="col-sm-6">
						<div class="short-description form-message">
							<label><?php _e( "Popis", "realsys" ); ?></label>
							<textarea placeholder="<?php _e( "Popis", "realsys" ); ?>" name="db_popis"><?php echo $uzivatel->dejData('db_popis'); ?></textarea>
						</div>
					</div>
				</div>


				<div class="row">
					<div class="col-sm-6">

						<div class="form-row">
							<label><i class="fas fa-phone-alt"></i><?php _e( "Telefon", "realsys" ); ?></label>
							<input type="tel" placeholder="<?php echo _e( "Telefon", "realsys" );?>" value="<?php echo $uzivatel->dejData('db_telefon'); ?>" name="db_telefon">
						</div>
					</div>

					<div class="col-sm-6">
						<div class="form-row">
							<label><i class="fas fa-envelope"></i> <?php _e( "Email", "realsys" ); ?></label>
							<input type="email" placeholder="<?php _e( "Email", "realsys" );?>" value="<?php echo $uzivatel->dejData('db_email'); ?>" name="db_email_nocheck">
						</div>
					</div>

				</div>

				<button type="submit" class="btn submit-btn auto-w" name="action" value="changeUserDetails"><?php _e( "Potvrdit změny", "realsys" ); ?></button>
			</form>


			<div class="security-hint-box">
				<div class="security-hint-box-wrap">

					<div class="row">
						<div class="col-sm">
							<h3><?php _e( "Zabezpečení účtu", "realsys" );?></h3>
							<p><?php _e( "Nastavte si dostatečně silné heslo k vašemu účtu.", "realsys" );?></p>
						</div>

						<div class="col-sm">
							<div class="change-pass-form">
								<form class="js-validate-form" method="post">
									<div class="row">
										<div class="col-sm">
											<label><?php _e( "Nové heslo", "realsys" );?></label>
											<div class="form-field">
												<input type="password" placeholder="*****" name="db_heslo" id="heslo">
											</div>
										</div>
										<div class="col-sm">
											<label><?php _e( "Potvrďte heslo", "realsys" );?></label>
											<div class="form-field">
												<input type="password" placeholder="*****" name="db_heslo2">
											</div>
										</div>
									</div>
									<button type="submit" class="btn submit-btn" name="action" value="changePassword"><?php _e( "Změnit heslo", "realsys" );?></button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>


<div class="fullscreen-popup js-popup" id="addUserImage">
    <div class="fullscreen-popup--inner">
        <div class="fullscreen-popup--close js-closePopup"><i class="fas fa-times"></i> </div>
        <h2><?php _e( "Změna obrázku uživatele", "realsys" );?></h2>
        <div class="line-separator"></div>
        <p class="fullscreen-popup--paragraph"><?php _e( "Pro změnu obrázku nahrajte obrázek nový.", "realsys" );?></p>
        <div>
            <input type="hidden" name="uzivatel_id" id="uzivatel_id" value="<?php echo $uzivatel->getId(); ?>">
            <input type="file" class="my-pond" name="files"/>
        </div>
        <div class="js-uploadImageResult uploadImageResult">

        </div>
    </div>
</div>
