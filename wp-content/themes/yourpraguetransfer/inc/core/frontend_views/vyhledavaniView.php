<div class="app">

    <search-component

        images_path="<?php echo FRONTEND_IMAGES_PATH; ?>"
        api_url="<?php echo AJAXURL; ?>"
        home_url="<?php echo home_url(); ?>"
        google_api_key="<?php echo GOOGLE_API_KEY; ?>"
        kurz_eur="<?php echo $this->workData['eur_ratio']; ?>"

        :destination_from_lat_lng="<?php echo Tools::prepareJsonToOutputHtmlAttr($this->workData['destination_from_lat_lng']); ?>"
        :destination_to_lat_lng="<?php echo Tools::prepareJsonToOutputHtmlAttr($this->workData['destination_to_lat_lng']); ?>"
        destination_to="<?php echo $this->workData['destination_to']; ?>"
        destination_from="<?php echo $this->workData['destination_from']; ?>"

    ></search-component>

</div>