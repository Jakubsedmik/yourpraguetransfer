<section>
	<div class="payment-con">
		<div class="wrapper">
			<?php echo frontendError::getFrontendErrors(); ?>
			<h2><?php echo __("Došlo k chybě při úhradě objednávky","realsys"); ?></h2>
			<p><?php echo __("Objednávka nebyla zaplacena.","realsys"); ?></p>
			<a href="<?php echo Tools::getFERoute("gopay", $this->requestData['orderid'], 'payment') ?>" class="btn"><?php echo __("Znovu k platbě","realsys"); ?></a>
		</div>
	</div>
</section>