<?php
	$pes = $this->requestData['pes'];
?>

<section>
	<div class="hlidacipes-wrapper">
		<div class="wrapper">
			<h1><?php echo __("Název:","realsys"); ?> <?php echo $pes->db_jmeno_psa; ?></h1>
			<p><?php echo __("Podívejte se jaké Vám hlídací pes pohlídal nové inzeráty.","realsys"); ?></p>
			<?php
				echo $pes->zobrazInzeraty();
				$pes->obnovInzeraty();
			?>
		</div>
	</div>
</section>
