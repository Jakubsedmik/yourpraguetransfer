<div class="border p-5 mr-3">
    <div class="container-fluid">
        <h1>
            <i class="fas fa-home"></i> Výpis referencí
        </h1>
        <p class="lead">
            Kompletní výpis referencí. Reference můžete upravovat,smazat či filtrovat.
        </p>
    </div>
    <div class="app">
        <inzeraty
            api_url="<?php echo AJAXURL; ?>"
            base_url="<?php echo ADMIN_BASE_URL; ?>" model="referenceClass"
            item_controller="reference"
            sub_params="?action=getElements"
            home_url="<?php echo home_url() ?>"
        ></inzeraty>
    </div>
    <div class="container-fluid">
        <a href="<?php echo ADMIN_BASE_URL;?>" class="btn btn-amber mt-3"><i class="fas fa-chevron-left mr-1"></i> Zpět na rozcestník</a>
        <a href="<?php echo Tools::getRoute('referenceClass','create'); ?>" class="btn btn-success mt-3"><i class="fas fa-plus-circle"></i> Vytvořit referenci</a>
    </div>
</div>