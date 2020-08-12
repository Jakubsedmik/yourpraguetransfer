<?php
    $gatewayUrl = $this->requestData['gopayParameters']["gatewayUrl"];
    $embedJs = $this->requestData['gopayParameters']["embedJs"];
?>

<section>
    <div class="payment-con">
        <div class="wrapper">
            <?php echo frontendError::getFrontendErrors();?>
            <h2><?php echo __("Pokračujte do platební brány","realsys"); ?></h2>
            <p><?php echo __("Úspěšně jsme pro Vás připravili platební bod - prosím pokračuje do platební brány","realsys"); ?></p>
            <form action="<?php echo $gatewayUrl; ?>" method="post" id="gopay-payment-button">
              <button name="pay" type="submit" class="btn"><?php echo __("Zaplatit platební kartou","realsys"); ?></button>
              <script type="text/javascript" src="<?php echo $embedJs; ?>"></script>
            </form>

        </div>
    </div>
</section>

<?php Pixel::PixelPayment(); ?>