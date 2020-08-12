<section class="reset-password">
    <div class="wrapper">
        <div class="reset-box rounded-b light-blue-bg text-center">
            <h2 class="sz-tit"><?php _e( "Změna hesla", "realsys" ); ?></h2>
            <p><?php _e( "Podařilo se nám Vás autorizovat. Nyní si můžete změnit heslo", "realsys" ); ?></p>
			<?php echo frontendError::getBackendErrors(); ?>
            <form class="js-validate-form" method="post">
                <div class="form-field">
                    <label for="heslo"><?php _e( "Zadejte nové heslo", "realsys" ); ?></label>
                    <input type="password" name="db_heslo" id="heslo">
                </div>
                <div class="form-field">
                    <label for="heslo2"><?php _e( "Potvrdťe nové heslo", "realsys" ); ?></label>
                    <input type="password" name="db_heslo2" id="heslo2">
                </div>
                <button class="btn" type="submit"><?php _e( "Resetovat heslo", "realsys" ); ?></button>
            </form>
        </div>
    </div>
</section>
