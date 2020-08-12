<section>
    <div class="kredity-con">
        <div class="wrapper">
	        <?php echo frontendError::getBackendErrors(); ?>
          <button onclick="goBack()" class="back-to-page"><span class="icon-arrow rotate"></span><span><?php _e("Zpět", "realsys"); ?></span></button>

            <div class="section-title">
                <h1 class="title"><?php _e("Kredity", "realsys"); ?></h1>
                <p><?php _e("KredityPopis", "realsys"); ?></p>
            </div>

            <div class="section-form">
                <form class="js-validate-form" method="post">
                    <div class="inbox-form">
                        <div class="col-md-12 col-first form-field">
                            <h3>
	                            <?php _e("Kolik chcete zakoupit kreditů?", "realsys"); ?>
                            </h3>
                            <?php
                                global $cenik;
                                $i = 1;
                                foreach ($cenik as $key => $value) :
                            ?>
                                <label>
                                    <input type="radio" name="credits" value="<?php echo $key; ?>" required class="jcf-ignore">
                                    <div class="credits-div">
                                        <div class="credits-amount">
                                            <img src="<?php echo FRONTEND_IMAGES_PATH; ?>/ikony/kredity_<?php echo $i; $i++; ?>.png">
                                            <strong><?php echo $key; ?> </strong>&nbsp;<?php _e("Kreditů", "realsys"); ?>
                                        </div>
                                        <div class="credits-cost">
                                            <?php echo $value; ?> <?php echo CURRENCY; ?>
                                        </div>
                                    </div>
                                </label>
                            <?php endforeach; ?>
                            <?php if(isset($this->workData['customService'])): $customService = $this->workData['customService']; ?>
                                <label>
                                    <input type="radio" name="credits" value="<?php echo $customService['ammount']; ?>" required class="jcf-ignore">
                                    <div class="credits-div">
                                        <div class="credits-amount">
                                            <img src="<?php echo FRONTEND_IMAGES_PATH; ?>/ikony/kredity_1.png">
                                            <strong><?php echo $customService['ammount'] ?></strong>&nbsp;<?php _e("Kreditů", "realsys"); ?>
                                            <strong><?php _e("Služba:", "realsys"); ?>&nbsp;<?php echo $customService['name'] ?></strong>
                                        </div>
                                        <div class="credits-cost">
				                            <?php echo $customService['price']; ?> <?php echo CURRENCY; ?>
                                        </div>
                                    </div>
                                </label>
                                <p class="sluzba-popis"><?php echo $customService['message'] ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-12 col-last form-field">
                            <h3>
	                            <?php _e("Výběr platby", "realsys"); ?>
                            </h3>
                            <label>
                                <input type="radio" name="payment" value="visa" required class="jcf-ignore">
                                <div class="credits-div">
                                    <div class="credits-amount">
                                        <img src="<?php echo FRONTEND_IMAGES_PATH; ?>/ikony/mc.png">
                                        <div class="credits-cost"><?php _e("Visa / mastercard", "realsys"); ?></div>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>
                    <div class="section-btn">
                        <input type="hidden" name="action" value="processPayment">
                        <button type="submit" class="btn">
	                        <?php _e("Potvrdit objednávku", "realsys"); ?>
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</section>
