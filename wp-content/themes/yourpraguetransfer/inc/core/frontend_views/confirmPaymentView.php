<section>
	<div class="payment-con">
		<div class="wrapper">
			<?php echo frontendError::getFrontendErrors(); ?>
			<h2><?php echo __("Objednávka byla zaplacena", "realsys"); ?></h2>

			<p><?php echo __("Děkujeme za zaplacení objednávky, níže je její rekapitulace", "realsys"); ?></p>

			<ul>
				<li><?php echo __("Počet kreditů:", "realsys"); ?> <?php echo $this->requestData['objednavka']->db_mnozstvi; ?></li>
				<li><?php echo __("Cena:", "realsys"); ?> <?php echo Tools::convertCurrency($this->requestData['objednavka']->db_cena); ?></li>
				<li><?php echo __("Ve prospěch účtu:", "realsys"); ?> <?php echo $this->requestData['uzivatel']->getFullName(); ?></li>
			</ul>

			<a href="<?php echo Tools::getFERoute("uzivatelClass",uzivatelClass::getUserLoggedId()); ?>" class="btn"><?php echo __("Zpět na svůj účet", "realsys"); ?></a>
		</div>
	</div>
</section>