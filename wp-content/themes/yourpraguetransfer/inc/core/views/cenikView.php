<div class="border p-5 mr-3">
    <div class="container-fluid">
        <h1>
            <i class="fas fa-home"></i> Výpis ceníků
        </h1>
        <p class="lead">
            Kompletní výpis všech ceníků vozidel. Ceníky můžete upravovat,smazat či filtrovat.
        </p>
    </div>
    <div class="app">
        <inzeraty
            api_url="<?php echo AJAXURL; ?>"
            base_url="<?php echo ADMIN_BASE_URL; ?>" model="cenikClass"
            item_controller="cenik"
            sub_params="?action=getElements"
            home_url="<?php echo home_url() ?>"
        ></inzeraty>
    </div>

    <div class="container-fluid">
        <a href="<?php echo ADMIN_BASE_URL;?>" class="btn btn-amber mt-3"><i class="fas fa-chevron-left mr-1"></i> Zpět na rozcestník</a>
        <a href="<?php echo Tools::getRoute('cenikClass','create'); ?>" class="btn btn-success mt-3"><i class="fas fa-plus-circle"></i> Vytvořit ceník</a>
    </div>
</div>