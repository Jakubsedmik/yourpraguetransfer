
<?php
	$item->loadRelatedObjects("obrazekClass");
?>

<div class="col-lg-4 col-md-6 col-sm-12 nemovitost">
	<div class="nemovitost-wrapper">
		<?php
			$front_img = "";
			foreach ($item->subobjects['obrazekClass'] as $value) {
				if($value->db_front){
					$front_img = $value->db_url;
				}
			}
		?>
		<div class="nemovitost-image" style="background-image: url(<?php echo home_url() . $front_img; ?>); "></div>
		<div class="nemovitost-text">
			<h3><?php echo $item->db_titulek . ', ' . $item->db_pocet_mistnosti . ', ' . $item->db_podlahova_plocha; ?> m<sup>2</sup></h3>
			<p><?php echo $item->db_popis; ?></p>

			<div class="price-bar">
				<h4 class="price"><?php echo Tools::convertCurrency($item->db_cena); ?></h4>
				<a href="<?php echo Tools::getFERoute("inzeratClass", $item->getId()); ?>" class="btn more"><?php echo get_theme_mod("top_nemovitosti_nem_button_text"); ?></a>
			</div>
		</div>
	</div>
</div>
