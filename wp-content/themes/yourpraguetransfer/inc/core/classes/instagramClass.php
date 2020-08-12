<?php


class instagramClass{

    protected $hash_id;
    protected $accessToken;
    protected $userid;

    protected $ig_today_data;
    protected $ig_new_data;


    public function __construct()
    {
        $this->accessToken = 'EAAFyjgcYBzQBACmx14ZAFAXt1JHPMWWoDshEOfBxlrgK5Bn6uI0TbBzLg3hro3soVXtS5JoDSE6NVBkCIEtftkWXV4ZCRUSJEBDxWFpfSCGGldluficPpYxCBzlB6c06QemUvdMtdVWAZAG9m2I9H2DKRZBmTlGdjZBYWomV41LspUtiUmVLZBhTR9hhQDyDIZD';
        $this->userid = '17841400022140455';
        $this->hash_id = '17882071498372694';
        trigger_error("Starting loading IG data");
    }


    public function loadIgData(){
        $url = 'https://graph.facebook.com/';
        $url .= $this->hash_id;
        $url .= '/recent_media?user_id=';
        $url .= $this->userid;
        $url .= '&fields=id,media_type,media_url,permalink,caption&access_token=';
        $url .= $this->accessToken;

        $response = self::file_get_content_curl($url);
        $ig_today_data = json_decode($response);
        if(is_object($ig_today_data) && property_exists($ig_today_data, "data")){
            $this->ig_today_data = $ig_today_data->data;
            return $this->ig_today_data;
        }else{
            trigger_error("Facebook result is wrong, missing data :: loadIgData");
            return false;
        }
    }

    public function filterIgData(){
        global $wpdb;
        $list = "";
        $index = 0;
        if($this->ig_today_data && is_array($this->ig_today_data)){
            foreach ($this->ig_today_data as $value){
                $list .= $value->id;
                $index++;
                if($index != count($this->ig_today_data)){
                    $list .= ',';
                }
            }

            $result = $wpdb->get_results("SELECT ig_id FROM " . fotografieClass::$publicTableName . " WHERE ig_id IN (" . $list . ")",OBJECT_K);

            $arrayOfIds = array();
            foreach ($result as $value){
                $arrayOfIds[] = $value->ig_id;
            }

            $filteredArray = array();
            foreach ($this->ig_today_data as $key => $value){
                if(array_search($value->id, $arrayOfIds) === false && $value->media_type == "IMAGE"){
                    $filteredArray[$key] = $value;
                }
            }

            $this->ig_new_data = $filteredArray;
            return $filteredArray;
        }else{
            trigger_error("Facebook token nejspíše vypršel, neočekávaný výsledek");
            $headers[] = 'From: Ceskeamoravskehrady.cz <info@ceskeamoravskehrady.cz>';
            wp_mail("info@studioseven.cz","Instagram token", "Token IG asi vypršel", $headers);
            die();
        }
    }

    public function createNewMedia(){
        foreach ($this->ig_new_data as $value){

            $autor_id = $this->createUserIfNotExist($value->caption);

            if(is_object($autor_id) && $autor_id instanceof autorClass){

                assetsFactory::createEntity("fotografieClass",
                    array(
                        "datum_nahrani" => time(),
                        "pocet_hlasu" => 0,
                        "url_big" => $value->media_url,
                        "url_small" => $value->media_url,
                        "soutez_id" => assetsFactory::dejAktualniSoutez(),
                        "ig_id" => $value->id,
                        "ig_permalink" => $value->permalink,
                        "autor_id" => $autor_id->getId(),
                        "ig_photo_assigned" => 0
                    ));
            }
        }
    }


    public function createUserIfNotExist($caption){
        $string = $caption;
        $pattern = '/[a-z0-9_\-\+\.]+@[a-z0-9\-]+\.([a-z]{2,4})(?:\.[a-z]{2})?/i';
        $matches = array();
        preg_match($pattern, $string, $matches);
        if(count($matches) > 0) {
            $email = $matches[0];
            echo $email;
            $possibleUsers = assetsFactory::getAllEntity("autorClass",
                array(
                    new filterClass("email", "=", "'" . $email ."'")
                ),
                0,
                1
            );

            if(count($possibleUsers) == 1){
                $uzivatel = array_shift($possibleUsers);
                echo globalUtils::writeDebug($uzivatel);
                return $uzivatel;
            }else {
                $caption =
                $uzivatel = assetsFactory::createEntity("autorClass",
                    array(
                        "email" => $email,
                        "jmeno" => "Uživatel",
                        "prijmeni" => "Instagramu",
                        "note" => $caption,
                    ));
                echo globalUtils::writeDebug($uzivatel);
                return $uzivatel;
            }
        }else {
            $uzivatel = assetsFactory::createEntity("autorClass",
                array(
                    "jmeno" => "Uživatel",
                    "prijmeni" => "Instagramu",
                    "note" => $caption,
                    "email" => "none"
                ));
            echo globalUtils::writeDebug($uzivatel);
            return $uzivatel;
        }
    }

    public static function file_get_content_curl($url){
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_FAILONERROR, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($curl);
        return $result;
    }



}
