<section class="pt-3 pb-5 bg-light">
    <div class="s7_sw-sec mx-auto">
        <div class="wrapper">
			<?php echo frontendError::getFrontendErrors(); ?>
			<h2><?php echo __("Objednávka byla zaplacena", "realsys"); ?></h2>

			<p><?php echo __("Děkujeme za zaplacení objednávky, níže je její rekapitulace", "realsys"); ?></p>

			<ul>

                <li><strong><?php echo __("Cesta tam:", "realsys"); ?></strong> <?php echo $this->requestData['objednavka']->db_destinace_z; ?> <i class="fas fa-long-arrow-alt-right"></i> <?php echo $this->requestData['objednavka']->db_destinace_do; ?> <i class="fas fa-clock"></i> <?php echo Tools::formatTime($this->requestData['objednavka']->db_cas); ?></li>
                <?php if($this->requestData['objednavka']->db_cas_zpet != 0) : ?>
                    <li><strong><?php echo __("Cesta zpět:", "realsys"); ?></strong> <?php echo $this->requestData['objednavka']->db_destinace_do; ?> <i class="fas fa-long-arrow-alt-right"></i> <?php echo $this->requestData['objednavka']->db_destinace_z; ?> <i class="fas fa-clock"></i> <?php echo Tools::formatTime($this->requestData['objednavka']->db_cas_zpet); ?></li>
                <?php endif; ?>
                <li><strong><?php echo __("Počet osob:", "realsys"); ?></strong> <?php echo $this->requestData['objednavka']->db_pocet_osob; ?></li>
                <li><strong><?php echo __("Cena:", "realsys"); ?></strong> <?php echo Tools::convertCurrency($this->requestData['objednavka']->db_cena); ?></li>

			</ul>

			<a href="<?php echo home_url(); ?>" class="btn text-uppercase text-white"><?php echo __("Zpět na úvodní stránku", "realsys"); ?></a>
		</div>
	</div>
</section>