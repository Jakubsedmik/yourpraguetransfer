<div class="app">

    <search-component

        images_path="<?php echo FRONTEND_IMAGES_PATH; ?>"
        api_url="<?php echo AJAXURL; ?>"

        google_api_key="<?php echo GOOGLE_API_KEY; ?>"

        :destination_from_lat_lng="<?php echo Tools::prepareJsonToOutputHtmlAttr($this->workData['destination_from_lat_lng']); ?>"
        :destination_to_lat_lng="<?php echo Tools::prepareJsonToOutputHtmlAttr($this->workData['destination_to_lat_lng']); ?>"
        destination_to="<?php echo $this->workData['destination_to']; ?>"
        destination_from="<?php echo $this->workData['destination_from']; ?>"

    ></search-component>

</div>