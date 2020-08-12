<?php
	$inzerat = $this->requestData['inzerat'];
	$link = Tools::getFERoute("inzeratClass",$inzerat->getId(),"detail");

    Pixel::PixelCreateProduct();
	Tools::jsRedirect($link, 2500, "Přesměrování", "Probíhá přesměrování na nový inzerát");
?>
<section>
	<div class="add-inz-con">
		<div class="wrapper">
			<h2><?php _e("Inzerát byl vytvořen", "realsys"); ?></h2>
            <p><?php _e("Děkujeme za vytvoření inzerátu. Na inzerát budete přesměrováni. Nebo klikněte na tlačítko níže.", "realsys"); ?></p>
            <!-- TODO prozatímní redirect na přidání inzerátu, po spuštění musí být na profil-->
			<a href="<?php echo $link; ?>" class="btn"><?php _e("Detail inzerátu","realsys"); ?></a>
		</div>
	</div>
</section>
