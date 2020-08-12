<div class="border p-5 mr-3">
	<div class="container-fluid">
		<h1>
            <i class="fas fa-images"></i> Výpis obrázků
		</h1>
		<p class="lead">
			Kompletní výpis obrázků. Obrázky můžete upravovat,smazat či filtrovat.
		</p>
	</div>
	<div class="app">
		<inzeraty
                api_url="<?php echo AJAXURL ?>"
                base_url="<?php echo ADMIN_BASE_URL ?>" model="obrazekClass"
                sub_params="?action=getElements"
                item_controller="obrazek"
                home_url="<?php echo home_url() ?>"
		></inzeraty>
	</div>


    <div class="container-fluid mt-4">
        <div class="js-fileUploader fileUploader" data-api-url="<?php echo AJAXURL ?>">
            <input type="file" name="files">
        </div>

    </div>


	<div class="container-fluid">
		<a href="<?php echo ADMIN_BASE_URL;?>" class="btn btn-amber mt-3"><i class="fas fa-chevron-left mr-1"></i> Zpět na rozcestník</a>
        <a href="<?php echo Tools::getRoute("obrazekClass","regenerateImages")?>" class="btn btn-blue-grey mt-3">Regenerovat všechny obrázky <i class="far fa-image"></i></a>
        <a href="<?php echo Tools::getRoute("obrazekClass","cleanImages")?>" class="btn btn-mdb-color mt-3">Odstranit neasociované obrázky <i class="fas fa-trash-alt"></i></a>
	</div>
</div>