<section class="reset-password">
	<div class="wrapper">
		<div class="reset-box rounded-b light-blue-bg text-center">
			<h2 class="sz-tit"><?php _e("Žádost o reset hesla", "realsys"); ?></h2>
			<p><?php _e("Zde můžete zažádat o resetování hesla", "realsys"); ?></p>
			<?php echo frontendError::getBackendErrors(); ?>
		    <form class="js-validate-form" method="post" action="<?php echo Tools::getFERoute("uzivatelClass",false, "login") ?>">
			    <div class="form-field reset-field">
				    <label for="email"><?php _e("Zadejte emailovou adresu", "realsys"); ?></label>
				    <input type="email" name="db_email_nocheck" placeholder="<?php _e("Váš e-mail", "realsys"); ?>" id="email">
			    </div>
			    <button class="btn" type="submit" name="action" value="resetPassword"><?php _e("Resetovat heslo", "realsys"); ?></button>
		    </form>
		</div>
	</div>
</section>
