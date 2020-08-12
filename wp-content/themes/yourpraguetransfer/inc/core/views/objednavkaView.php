<div class="border p-5 mr-3">
	<div class="container-fluid">
		<h1>
			<i class="fas fa-home"></i> Výpis objednávek
		</h1>
		<p class="lead">
			Kompletní výpis objednávek. Uživatele můžete upravovat,smazat či filtrovat.
		</p>
	</div>
	<div class="app">
		<inzeraty
                api_url="<?php echo AJAXURL ?>"
                base_url="<?php echo ADMIN_BASE_URL ?>" model="objednavkaClass"
                item_controller="objednavka"
                sub_params="?action=getElements"
                home_url="<?php echo home_url() ?>"
		></inzeraty>
	</div>
	<div class="container-fluid">
		<a href="<?php echo ADMIN_BASE_URL;?>" class="btn btn-amber mt-3"><i class="fas fa-chevron-left mr-1"></i> Zpět na rozcestník</a>
        <a href="<?php echo Tools::getRoute("objednavkaClass","create") ?>" class="btn btn-success mt-3"><i class="fas fa-plus-circle"></i> Vytvořit objednávku</a>
	</div>
</div>