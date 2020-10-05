<section class="pt-3 pb-5 bg-light">
    <div class="s7_sw-sec mx-auto">
        <div class="wrapper">
			<?php echo frontendError::getFrontendErrors(); ?>
			<h2><?php echo __("Došlo k chybě při úhradě objednávky","realsys"); ?></h2>
			<p><?php echo __("Objednávka nebyla zaplacena.","realsys"); ?></p>
			<a href="<?php echo Tools::getFERoute("gopay", $this->requestData['orderid'], 'payment'); ?>" class="btn text-white text-uppercase"><?php echo __("Znovu k platbě","realsys"); ?></a>
            <a href="<?php echo Tools::getFERoute("objednavkaClass", $this->requestData['orderid']); ?>" class="btn text-white text-uppercase"><?php echo __("Zpět k objednávce","realsys"); ?></a>
		</div>
	</div>
</section>