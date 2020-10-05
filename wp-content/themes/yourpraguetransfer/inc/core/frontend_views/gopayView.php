<?php
    $gatewayUrl = $this->requestData['gopayParameters']["gatewayUrl"];
    $embedJs = $this->requestData['gopayParameters']["embedJs"];
?>

<section class="pt-3 pb-5 bg-light">
    <div class="s7_sw-sec mx-auto">
        <div class="wrapper">
            <?php echo frontendError::getFrontendErrors();?>

            <h2><?php echo __("Pokračujte do platební brány","realsys"); ?></h2>
            <p><?php echo __("Úspěšně jsme pro Vás připravili platební bod - prosím pokračuje do platební brány","realsys"); ?></p>
            <form action="<?php echo $gatewayUrl; ?>" method="post" id="gopay-payment-button">
                <button name="pay" type="submit" class="btn"><?php echo __("Zaplatit platební kartou","realsys"); ?></button>
                <!-- pokud není embed JS tak udělejme automatické placení, tzn rovnou redirect -->
                <?php
                    if(!isset($_SERVER['HTTPS'])) {
                        Tools::jsRedirect($gatewayUrl,0, "Přesměrování na platební bránu");
                    }
                ?>
                <script type="text/javascript" src="<?php echo $embedJs; ?>"></script>
            </form>

        </div>
    </div>
</section>

<?php Pixel::PixelPayment(); ?>