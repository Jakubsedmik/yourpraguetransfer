<?php

/*
 * Užitečné funkce, slouží např. ke kontrole dat apod.
 */

/**
 * Description of Tools
 *
 * @author Uzivatel
 */
class Tools {

    public static $last_created = false;
    
    /*
     * Kontroluje existenci proměné $what v poli $where
     */
    public static function checkPresenceOfParam($what, $where){
        return (isset($where[$what]) && (strlen($where[$what]) > 0 || is_array($where[$what])))? true : false;
    }
    

    /*
     * Metoda převzatá z THMP, je podobná fieldChecker
     * do metody vchází $arr které disponuje daty
     * do metody vchází také rules který má následující strukturu
     * $rules = array( 'neco' => array('type'=>'str', 'required' => false))
     * pokud je nastaveno advanced na true vrací jen zdali je pole v pořádku zdali nikoli
     * pokud je advanced nastaveno na false vrací pole chyb
     */
    public static function postChecker($arr, $rules, $advanced = false){
            $arrOfWrong = array();

            foreach ($rules as $key => $value) {
                $type = $value['type'];
                $required = $value['required'];
                if(isset($arr[$key])){
	                $val = $arr[$key];
                }else{
	                $val = null;
                }

                $type_checker = new typeClass($key, $val, $required, $type);


                if(!$type_checker->getStatus()){
                    $arrOfWrong[$key] = $type_checker;
                }else{
                    $arr[$key] = Tools::transformType($type, $val);
                }
            }

            if($advanced){
                return (count($arrOfWrong) == 0);
            }

            return $arrOfWrong;
    }

    public static function transformArr($arr, $rules){
	    foreach ($rules as $key => $value) {
		    $type = $value['type'];
		    if(isset($arr[$key])){
			    $val = $arr[$key];
			    $arr[$key] = Tools::transformType($type, $val);
		    }
        }
	    return $arr;
    }
    
    
    /*
     * Metoda, která kontroluje zda da daná hodnota $value odpovídá danému typu $type
     * pokud ano vrací true, pokud ne vrací false
     */
    public static function fieldChecker($value, $type){
        switch ($type){
            case "text" :
                if(is_string($value) && strlen($value)){
                    return true;
                }
                return "Hodnota není text";
                break;
            case "number" :
                if(ctype_digit($value)){
                    return true;
                }
                return "Hodnota není číslo";
                break;
            case "url" :
                if(filter_var($value, FILTER_VALIDATE_URL)){
                    return true;
                }
                return "Hodnota není url";
                break;
            case "array" :
                if(is_array($value)){
                    return true;
                }
                return "Nesprávná manipulace";
                break;
            case "link" : 
                if(is_numeric($value)){
                    return true;
                }
                return "Nesprávná manipulace";
                break;
            case "time" : 
                if(preg_match('/^\d{1,2}:\d{1,2}$/m', $value)){
                    return true;
                }
                return "Čas je v nesprávném formátu. Doporučený formát hh:mm.";
                break;
            case "bool" : 
                if(is_bool($value) || $value==1 || $value==0){
                    return true;
                }
                return "Není logická hodnota.";
                break;
                
        }
        
    }
    
    
    
    /*
     * Metoda, která připravuje danou hodnotu na výstup na frontend
     * je použita v mnoha případech (již implementována na mnoha místech) a tím je možné ji použít jako filtr a
     * ošetřit tím nějaké výstupy na frontendu
     */
    public static function fieldPrepare($value){
        if(is_array($value)){
            return maybe_serialize($value);
        }
        if($value == "true"){
            return 1;
        }
        if($value == "false"){
            return 0;
        }
        return $value;
    }
    
    
    /*
     * Připraví json ouput pro zařazení např. do data-neco atributu v HTML značce
     */
    public static function prepareJsonToOutputHtmlAttr($object){
        if($object){
            return str_replace('"',"'",json_encode($object));
        }else {
            return "[]";
        }
        
    }

    public static function getPathTillFolder($folder, $path){
        $path = str_replace("\\", "/", $path);
        $pathobject = explode("/", $path);
        $newpath = array();
        foreach ($pathobject as $key => $value){
            if($value == $folder){
                $newpath[] = $value;
                break;
            }
            $newpath[] = $value;
        }
        return implode("/", $newpath) . "/";

    }

    public static function isValidUrl($url)
    {
        $new_url = $url;
        if(strstr($url,"http")==FALSE){
            $new_url = 'http://example.com' . $url;
        }
        $new_url = str_replace("http://localhost/", "http://example.com/", $new_url);
        if (parse_url($new_url, PHP_URL_SCHEME) != '') {
            return !(filter_var($new_url, FILTER_VALIDATE_URL) === false);
        }

        return false;
    }

    public static function getCurrentUrl(){
        $actual_link = "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
        return $actual_link;
    }

    public static function getCleanUrl(){
        $dis_url = $_SERVER['REQUEST_URI'];
        $uri = trim(strtok($dis_url, '?'));
        return $uri;
    }

    public static function getUserIP()
    {
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = $_SERVER['REMOTE_ADDR'];

        if(filter_var($client, FILTER_VALIDATE_IP))
        {
            $ip = $client;
        }
        elseif(filter_var($forward, FILTER_VALIDATE_IP))
        {
            $ip = $forward;
        }
        else
        {
            $ip = $remote;
        }

        return $ip;
    }

    public static function jsRedirect($url, $delay=2000, $description = "", $subdescription = ""){
        ?>

        <style>
            .loader{
                position: fixed;
                top: 0px;
                left: 0px;
                right: 0px;
                display: flex;
                justify-content: center;
                align-items: center;
                bottom: 0px;
                background-color: #ffffffd4;
                z-index: 999;
                visibility: hidden;
                flex-direction: column;
            }

            .loader.loading{
                visibility: visible;
            }
        </style>

        <div class="loader" id="loader">
            <h2 class="redirectInfo" id="loaderDescription"><?php _e("Probíhá přesměrování", "realsys"); ?></h2>
            <p class="loaderSubdescription" id="loaderSubdescription"><?php _e("Po úspěšné akci probíhá přesměrování", "realsys"); ?></p>
            <img src="<?php echo FRONTEND_IMAGES_PATH ?>/loading.gif">
        </div>


        <script>
            document.addEventListener('DOMContentLoaded', (event) => {
                setTimeout(function () {
                    document.getElementById("loader").classList.add("loading");
                    <?php if(strlen($description) && strlen($subdescription)): ?>
                        document.getElementById("loaderDescription").innerHTML = "<?php echo $description; ?>";
                        document.getElementById("loaderSubdescription").innerHTML = "<?php echo $subdescription; ?>";
                    <?php endif; ?>
                    window.location.href = '<?php echo $url; ?>';
                },<?php echo $delay; ?>);
            })

        </script>
        <?php
    }


    public static function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }


    /*
     * Metoda slouží k procesování formuláře
     * Nejdříve na základě pole allowed prochází source a vyfiltruje jen povolené data
     * následně zkontroluje zdali data odpovídají rules
     * následně vyfiltruje jen ta data která mají db prefix
     * následně se rozhodně zdali bude editovat či zakládat entitu
     * pokud editovat tak na základě id načte objekt a pak ho zedituje
     * pokud vytvářet tak vytvoří nový objekt a předá mu nová data
     * na konci zavolá buď successCallback nebo failCallback
     */

    public static function formProcessor(
            $allowed,
            $source,
            $className,
            $action,
	        $format = null,
            $callbackSuccess="",
            $callbackFail="",
            $editOnlyAllowed = false
	        ){

	    if(!class_exists($className)){
	        trigger_error("formProcessor::Zadaná třída neexistuje nebo není potomkem zakladního kamene");
	        return false;
        }

	    $newsource = array();
	    foreach ($allowed as $val){
	        if(isset($source[$val])){
	            $newsource[$val] = $source[$val];
            }
        }


	    if($format == null) {
	        global $field_rules;
	        if(isset($field_rules[$className])){
	            $format = $field_rules[$className];
            }else{
	            trigger_error("formProcessor:: Formát nebyl poskytnut a v zásobníku fieldRules k dané třídě neexistují pravidla -> není co ověřovat");
	            return false;
            }
        }

	    if($editOnlyAllowed){
	        $new_format = array();
	        foreach ($format as $key => $value){
	            if(key_exists($key, $newsource)){
	                $new_format[$key] = $value;
                }
            }
	        $format = $new_format;
        }




        $result = self::postChecker($newsource, $format, true);
	    $newsource = self::transformArr($newsource, $format);

        if($result){
            $db_properties = globalUtils::filterOnlyDbProperties($newsource);


            if($action == 'edit'){
                if(Tools::checkPresenceOfParam("db_id", $db_properties)){
                    $id = $db_properties['db_id'];
                    unset($db_properties['db_id']);

                    $entity = assetsFactory::getEntity($className,$id);
                    if($entity){
                        foreach ($db_properties as $key => $value){
                            $entity->set_not_update($key, $value);
                        }
	                    $entity->aktualizovat();
                    }
                    if(is_callable($callbackSuccess)){
	                    call_user_func($callbackSuccess,$entity, $source);
                    }
                    frontendError::addMessage(__("Úspěch", "realsys"), SUCCESS, __("Úspěšně uloženo","realsys"));
                    return true;

                }else{
                    trigger_error("formProcessor::ID není dostupné");
                    frontendError::addMessage("ID", ERROR, __("Došlo k chybě!","realsys"));
	                if(is_object($callbackFail) || function_exists($callbackFail)){
		                $callbackFail($source);
                    }
                    return false;
                }
            }
            if($action == 'create'){
                $entity = assetsFactory::createEntity($className, $db_properties);
                self::$last_created = $entity;
	            if(is_callable($callbackSuccess)){
		            call_user_func($callbackSuccess,$entity, $source);
	            }
	            frontendError::addMessage(__("Úspěch", "realsys"), SUCCESS, __("Úspěšně vytvořeno","realsys"));
                return true;

            }
        }

        return false;
    }


    /*
     * tato metoda by měla umět vytvořit normalizovaný formulář na základě zadaných parametrů
     * měla by ho vracet jako html
     * TODO dodělat normalizovaný formulář který umí odychytávat i sám sebe respektive pracuje s metodou processform
     */
    public static function createForm(
            $propsTypesValuesPlaceholders,
            $inputClasses,
            $wrapperClasses,
            $buttonText,
            $hiddenField,
            $className,
            $action
    ){


    }

    /* metoda sloužící k transformaci proměnné dle typu, např. datum, čas a do budoucna jiné */
    public static function transformType($type, $value){

        switch ($type){
            case "date" :
                if(is_numeric($value)){
                    return $value;
                }
                $timestamp = strtotime($value);
                return $timestamp;
                break;
            case "time" : break;
                return $value;
	        default: return $value;
        }
    }


    /* metoda pro směrování uvnitř administrace / pomocí linků */
    public static function getRoute($model, $action=FALSE, $id=FALSE){
        global $models;
        $final_url = ADMIN_BASE_URL;
        if(isset($models[$model])){
            $controllers = $models[$model];
            $controllerName = $controllers['backendController'];
            $final_url .= "&controller=" . $controllerName;
            if($action){
                $final_url .= "&action=" . $action;
                if($id ){
                    $final_url .= '&id=' . $id;
                }
            }
            return $final_url;
        }else{
            trigger_error("getRoute:: Tento route není možno poskytnout - chybí konfigurace");
        }

    }

    public static function getFERoute($model, $id=false, $view="detail", $action=false){
        global $routing_urls;
        if(isset($routing_urls[$model])){
            $route = $routing_urls[$model];
            if(isset($route[$view])){
                $route = $route[$view];

	            if($id){
		            $url = sprintf($route,$id);
		            if($action){
			            $url .= "?action=" . $action;
		            }
		            return $url;
	            }else{
	                $url = $route;
	                return $url;
                }
            }else{
                trigger_error("getFERoute:: pro tento model neexistuje daný view");
            }
        }else{
            trigger_error("getFERoute:: pro tuto třídu neexistuje cesta");
        }
    }


    public static function getMdbNotationDate($timestamp){
	    $datumVytvoreni =  $timestamp;
	    $day = intval(date("j", $datumVytvoreni));
	    $month = intval(date("n", $datumVytvoreni)) - 1;
	    $year = intval(date("Y", $datumVytvoreni));
	    $datumVytvoreni = '[' . $year . ',' . $month . ',' . $day . ']';
	    return $datumVytvoreni;
    }



    /* UPLOAD TOOLS */

    public static function uploadImage($upload_to = DEFAULT_UPLOAD_TO){
	    $response = new stdClass();
	    try {

		    // Undefined | Multiple Files | $_FILES Corruption Attack
		    // If this request falls under any of them, treat it invalid.

		    if (
			    !isset($_FILES['files']['error']) ||
			    is_array($_FILES['files']['error'])
		    ) {
			    throw new RuntimeException('Invalid parameters.');
			    $response->status = 0;
			    $response->message = "Invalid parameters.";
			    wp_send_json($response,500);
			    wp_die();
		    }

		    // Check $_FILES['upfile']['error'] value.
		    switch ($_FILES['files']['error']) {
			    case UPLOAD_ERR_OK:
				    break;
			    case UPLOAD_ERR_NO_FILE:
				    $response->status = 0;
				    $response->message = "No file sent.";
				    wp_send_json($response,500);
				    wp_die();
			    case UPLOAD_ERR_INI_SIZE:
			    case UPLOAD_ERR_FORM_SIZE:
				    $response->status = 0;
				    $response->message = "Exceeded filesize limit due to server settings.";
				    wp_send_json($response,500);
				    wp_die();
			    default:
				    $response->status = 0;
				    $response->message = "Unknown errors.";
				    wp_send_json($response,500);
				    wp_die();
		    }

		    // You should also check filesize here.
		    if ($_FILES['files']['size'] > UPLOAD_SIZE) {
			    $response->status = 0;
			    $response->message = "Exceeded filesize limit due to application settings.";
		    }

		    // DO NOT TRUST $_FILES['upfile']['mime'] VALUE !!
		    // Check MIME Type by yourself.
		    $finfo = new finfo(FILEINFO_MIME_TYPE);
		    if (false === $ext = array_search(
				    $finfo->file($_FILES['files']['tmp_name']),
				    array(
					    'jpg' => 'image/jpeg',
					    'png' => 'image/png',
					    'gif' => 'image/gif',
				    ),
				    true
			    )) {
			    $response->status = 0;
			    $response->message = "Invalid file format.";
			    wp_send_json($response,500);
			    wp_die();
		    }

		    // You should name it uniquely.
		    // DO NOT USE $_FILES['upfile']['name'] WITHOUT ANY VALIDATION !!
		    // On this example, obtain safe unique name from its binary data.



            $file_specs = array();
            global $image_sizes;
            $storePath = Tools::getPathTillFolder("wp-content", __DIR__) . $upload_to;
            $base_name = '';

            $arVals = array_values($image_sizes);
            $first_image_name = array_shift($arVals);
		    do{
			    $basic_code = md5(date('Y-m-d H:i:s:u'));
			    $newFilename = $storePath . $first_image_name['prefix'] . '_' . $basic_code . '.' . $ext;;
		    }while(file_exists($newFilename));

		    $universal_name = $basic_code . '.' . $ext;

            foreach ($image_sizes as $key => $value){
	            $imageSize = $value['size'];

	            $finalPath = $storePath . $value['prefix'] . '_' . $basic_code . '.' . $ext;
	            $base_name = $storePath . $basic_code . '.' . $ext;

	            if($key = DEFAULT_IMAGE_SIZE){
	                $default_url = DEFAULT_UPLOAD_URL . $value['prefix'] . '_' . $basic_code . '.' . $ext;
                }

                $file_specs[] = array(
                        "file" => $finalPath,
                        "size" => $imageSize
                );
            }

		    $temporary_filename = $_FILES['files']['tmp_name'];
		    if (!move_uploaded_file($temporary_filename, $base_name)) {
			    $response->status = 0;
			    $response->message = "Failed to move uploaded file.";
			    $response->detailError = $_FILES["files"]["error"];
			    wp_send_json($response,500);
			    wp_die();
		    }

            foreach ($file_specs as $key => $value){
                $destination_path = $value['file'];
                $destination_size = $value['size'];


	            if (!copy($base_name, $destination_path)) {
		            $response->status = 0;
		            $response->message = "Failed to copy file.";
		            wp_send_json($response,500);
		            wp_die();

	            }else {
		            if($destination_size !== 'original'){
			            $image = new Imagick($destination_path);
		                $width = array_shift($destination_size);
		                $height = array_shift($destination_size);
			            $image->cropThumbnailImage($width,$height);
			            $image->setImageCompressionQuality(IMAGE_QUALITY);
			            self::addImageWatermark($image);
			            $image->writeImage($destination_path);
                    }
	            }
            }
            unlink($base_name);


		    $response->status = 1;
		    $response->message = "File uploaded successfully.";
		    $response->universal_name = $universal_name;
		    $response->default_url = $default_url;
		    return $response;

	    } catch (RuntimeException $e) {

		    echo $e->getMessage();

	    }
	    return false;

    }


	/**
     * Regenruje obrázky dle pole image_sizes
     * tyto obrázky se regenerují z original_kod.jpg. Pokud není nalezen tak daný obrázek neregeneruje a vyhodí chybu
     * Jako parametr vstupují obrázky které chceme regenerovat.
	 * @param $images
	 *
	 * @throws ImagickException
	 */
	public static function regenerateImages($images){
	    global $image_sizes;
	    $storePath = Tools::getPathTillFolder("wp-content", __DIR__) . DEFAULT_UPLOAD_TO;
        echo '<div class="workingImages">';
        echo "<ul>";
	    if(is_array($images) && count($images)>0){
	        foreach ($images as $key => $val){

		        $original_filename = $storePath . "original_" . $val->db_kod;
		        if(file_exists($original_filename)){
			        echo "<li><strong>Regeneruji obrázek: " . $original_filename . "</strong></li>";
			        if(count($image_sizes) > 0) echo "<ol>";

                        foreach ($image_sizes as $key1 => $val1){
                            $saving_as = $storePath . $val1["prefix"] . "_" . $val->db_kod;
                            $destination_size = $val1['size'];

                            if ( $destination_size !== 'original' ) {
                                echo "<li>Rozměr: " . $val1['prefix'] . "</li>";
                                $image  = new Imagick( $original_filename );
                                $width  = array_shift( $destination_size );
                                $height = array_shift( $destination_size );
                                $image->cropThumbnailImage( $width, $height );
                                $image->setImageCompressionQuality( IMAGE_QUALITY );
                                self::addImageWatermark($image, false);
                                echo "<strong>Making watermark for : " . $saving_as . "</strong>";
                                $image->writeImage( $saving_as );
                            }
                        }

			        if(count($image_sizes) > 0) echo "</ol>";
		        }else{
		            throw new Exception("Tento obrázek nebyl nalezen");
                    echo "<h3>Chyba: tento obrázek nebyl nalezen - " . $original_filename . " - regenerace neproběhla";
                }
            }
        }
	    echo "</ul>";
	    echo "</div>";
    }


    public static function addImageWatermark(&$originalImage, $save = TRUE){
	    $watermark = new Imagick();
	    $watermark->readImage(WATERMARK);

	    $watermarkResizeFactor = WATERMARK_RESIZE_FACTOR;

	    $img_Width = $originalImage->getImageWidth();
	    $img_Height = $originalImage->getImageHeight();
	    $watermark_Width = $watermark->getImageWidth();
	    $watermark_Height = $watermark->getImageHeight();

	    $spacex_for_watermark = $img_Width / 4;
	    $ratio = $spacex_for_watermark / $watermark_Width;
	    $spacey_for_watermark = $watermark_Height * $ratio;

	    $watermark->scaleImage($spacex_for_watermark / $watermarkResizeFactor, $spacey_for_watermark / $watermarkResizeFactor);

	    $watermark_Width = $watermark->getImageWidth();
	    $watermark_Height = $watermark->getImageHeight();

	    $x = ($img_Width - $watermark_Width);
	    $y = ($img_Height - $watermark_Height);

	    $originalImage->compositeImage($watermark, Imagick::COMPOSITE_OVER, $x, $y);
	    if($save){
	        $originalImage->writeImage();
	    }
    }

    /*
     * Slouží k odmazání obrázků, které nejsou asociované v databázi a jedná se tedy o volné soubory
     */
    public static function cleanUnassociatedImages(){
	    $storePath = Tools::getPathTillFolder("wp-content", __DIR__) . DEFAULT_UPLOAD_TO;
	    $all_pics = assetsFactory::getAllEntity("obrazekClass");
	    $images_in_folder = glob($storePath . "*_*.jpg");


	    foreach ($all_pics as $key => $val){
	        $kod = $val->db_kod;
	        $kod = explode(".", $kod)[0];
	        $matches = preg_grep("/.+_" . $kod . "\.jpg/m", $images_in_folder);

	        if(count($matches) > 0){
	            $keys_to_del = array_keys($matches);
	            foreach ($keys_to_del as $key_to_del){
		            unset($images_in_folder[$key_to_del]);
                }
            }
        }
        echo '<div class="workingImages">';
            echo "<h3> Cleaning images </h3>";
            echo "<ul>";
            foreach ($images_in_folder as $key => $val){
                echo "<li> Cleaning image: " . $val . "</li>";
                unlink($val);
            }
            echo "</ul>";
        echo '</div>';
    }


    /* MAIL TOOL */

	/*
     * $templateName Volí šablonu
     * $arrayOfValues umísťuje do šablony proměné na vyznačená místa
     * vrací html obsah pro odeslání emailu
     */
	public static function serveTemplate($templateName, $arrayOfValues){
		if(is_string($templateName) && is_array($arrayOfValues)){
		    $filename = __DIR__ ."/../mailTemplates/" . $templateName . ".html";
		    if(file_exists($filename)){
			    $email = file_get_contents($filename);
			    foreach ($arrayOfValues as $key => $value) {
				    $find = "{" . $key . "}";
				    $email = str_replace($find, $value, $email);
			    }
			    return $email;
            }else{
		        frontendError::addMessage(__("Email","realsys"),ERROR, __("Z technických důvodů se nepodařilo zprávu odeslat - kontaktujte administrátora","realsys"));
		        trigger_error("Email template not found :: serveTemplate");
		        return false;
            }
		}
		else {
			frontendError::addMessage(__("Email","realsys"),ERROR, __("Z technických důvodů se nepodařilo zprávu odeslat - kontaktujte administrátora","realsys"));
			trigger_error("bad serve email params at :: serverTemplate");
			return false;
		}
	}


	public static function sendMail($to, $subject="Realys", $template=false, $data=array(), $headers='', $attachment = array()){
	    if(is_array($data) && $to && is_string($to)){
		    if($template){
			    $cargo = self::serveTemplate($template, $data);
			    if($cargo){
                    wp_mail(
                        $to,
                        $subject,
                        $cargo,
                        $headers,
                        $attachment
                    );
			    }
		    }else{
			    $cargo = implode("<br>", $data);
			    wp_mail(
				    $to,
				    $subject,
				    $cargo,
				    $headers,
				    $attachment
			    );

		    }
		    return true;
        }else{
		    frontendError::addMessage(__("Email","realsys"),ERROR, __("Z technických důvodů se nepodařilo zprávu odeslat - kontaktujte administrátora","realsys"));
	        trigger_error("Failed to send mail :: mising some parameters");
	        return false;
        }

    }

	/**
	 * Slouží pro verifikaci dat poslaných z GOOGLE Api.
     *
	 * @param $token
     *
	 * @return mixed
	 */
	public static function googleTokenVerification($token, $verifyData = false){
		require_once (__DIR__ . "/../lib/google-api-php-client-2.4.0/vendor/autoload.php");
		$client = new Google_Client(['client_id' => GOOGLE_ID]);
		$payload = $client->verifyIdToken($token);

		if($verifyData && is_array($verifyData)){
		    foreach ($verifyData as $key => $val){
                if(key_exists($key, $payload)){
                    if($payload[$key] != $val){
                        return false;
                    }
                }else{
                    trigger_error("GoogleTokenVerification :: Zmíněná vlastnost v objektu nefiguruje. -> " . $key);
                    return false;
                }
            }
        }

		return $payload;
	}



    /* HTML TOOLS */

    /*
     * struktura
     * array(
     *  neco => 'neco'
     * )
     */
	public static function getSelectBoxForCustom($dataFrom, $property, $currentValue, $label='Výběr', $id="vyber",$search_label='Vyhledávání', $dataPrefixed = false){

		$output = '<select id="' . $id . '" name="' . $id .'" class="mdb-select md-form mt-0" searchable="' . $search_label . '">';
		$output .= '<option value="" disabled selected>' . $label . '</option>';
		foreach ($dataFrom as $key => $value){
		    if($dataPrefixed !== false){
			    $new_key = str_replace($dataPrefixed, "",$key);
			    if($currentValue == $new_key) {

				    $output .= '<option selected value="' . $new_key . '">' . $value . '</option>';
			    }else{
				    $output .= '<option value="' . $new_key . '">' .  $value . '</option>';
			    }
            }else{
                if($key == $currentValue) {
                    $output .= '<option selected value="' . $key . '">' . $value . '</option>';
                }else{
                    $output .= '<option value="' . $key . '">' .  $value . '</option>';
                }
		    }
		}
		$output .= '</select>';
		return $output;
	}


    public static function getSelectBoxForDials($classname, $property, $currentValue, $label='Výběr', $id="vyber",$search_label='Vyhledávání'){
	    $output = '<select id="' . $id . '" name="' . $id .'" class="mdb-select md-form mt-0" searchable="' . $search_label . '">';
	    $output .= '<option value="" disabled selected>' . $label . '</option>';
	    if(is_array($property)){
	        $allPossibleDials = $property;

		    foreach ($allPossibleDials as $key => $value){
			    if($value == $currentValue) {
				    $output .= '<option selected value="' . $value . '">' . $key . '</option>';
			    }else{
				    $output .= '<option value="' . $value . '">' . $key . '</option>';
			    }
		    }

        }else{
		    $allPossibleDials = assetsFactory::getAllDials($classname, $property);
		    foreach ($allPossibleDials as $key => $value){
			    if($value->db_value == $currentValue) {
				    $output .= '<option selected value="' . $value->db_value . '">' . $value->db_translation . '</option>';
			    }else{
				    $output .= '<option value="' . $value->db_value . '">' . $value->db_translation . '</option>';
			    }
		    }

        }
	    $output .= '</select>';
	    return $output;

    }


    public static function switcher($true_label, $false_label, $main_label, $waiting_value, $id, $current_value){
        $output = '<label class="h6" for="' . $id . '">' . $main_label . '</label>';
        $output .= '<div class="switch">';
        $output .= '<label> ' . $false_label;
	    $output .= '<input id="zeroValue" type="hidden" value="0" name="' . $id . '">';
        $output .= '<input type="checkbox" id="' . $id . '" name="' . $id . '" value="' . $waiting_value . '"' . (($current_value == $waiting_value)? ' checked ':'') . '>';
        $output .= '<span class="lever"></span> ' . $true_label;
        $output .= '</label>';
        $output .= '</div>';
        return $output;
    }

	public static function getSelectBoxForEntities($classname_from, $selected_object_id, $naming_property, $label='Výběr', $id, $search_label='Vyhledávání'){
		$allPossibleOptions = assetsFactory::getAllEntity($classname_from);
		$is_selected = false;
		$output = '<select class="mdb-select md-form mt-0" searchable="' . $search_label . '" id="' . $id .  '" name="' . $id . '">';

		foreach ($allPossibleOptions as $key => $value){
			if($value->db_id == $selected_object_id) {
			    if($is_selected == false){
				    $is_selected = true;
                }
				$output .= '<option selected value="' . $value->db_id . '">';
				for ($i=0; $i < count($naming_property); $i++) {
				    $property = $naming_property[$i];
				    if($i == count($naming_property)-1){
					    $output .= $value->$property;
                    }else{
					    $output .= $value->$property . ' | ';
                    }

                }
				$output .= '</option>';
			}else{
				$output .= '<option value="' . $value->db_id . '">';
				for ($i=0; $i < count($naming_property); $i++) {
					$property = $naming_property[$i];
					if($i == count($naming_property)-1){
						$output .= $value->$property;
					}else{
						$output .= $value->$property . ' | ';
					}

				}
				$output .= '</option>';
			}
		}

		if($is_selected){
			$output .= '<option value="" disabled>' . $label . '</option>';
        }else{
			$output .= '<option value="" disabled selected>' . $label . '</option>';
        }

		$output .= '</select>';
		return $output;
	}

	public static function getFrontendFilters(){
		global $filter_parameters, $filter_hp_parameters;
		$final_filter = array();
		foreach ($filter_hp_parameters as $key => $value){
		    if(isset($filter_parameters[$value])){
			    $key_new = str_replace("db_","", $value);
			    if(is_array($filter_parameters[$value]['values']) && count($filter_parameters[$value]['values']) > 0){
				    $final_filter[$value]['values'] = $filter_parameters[$value]['values'];
                }else{
				    $final_filter[$value]['values'] = globalUtils::getValuesForFilter("inzeratClass", $key_new, __("-- Bez filtru --","realsys"));
                }

			    $final_filter[$value]['name'] = $filter_parameters[$value]['name'];
			    $final_filter[$value]['class'] = $filter_parameters[$value]['class'];
			    $final_filter[$value]['type'] = $filter_parameters[$value]['type'];
            }
		}

		foreach ($final_filter as $key => $val){
		    if($val['type'] == 'text') :
		    ?>
            <div class="customSel-wrapper">
                <label><?php echo $val['name']; ?></label>
                <input type="text" name="<?php echo $key; ?>" placeholder="<?php echo $val['name']; ?>" class="<?php echo (isset($val['class'])) ? $val['class'] : ''; ?>">
            </div>
		    <?php elseif($val['type'] == 'map-search'): ?>
                <div class="customSel-wrapper">
                    <label><?php echo $val['name']; ?></label>
                    <input type="text" name="<?php echo $key; ?>" placeholder="<?php echo $val['name']; ?>" class="<?php echo (isset($val['class'])) ? $val['class'] : ''; ?>">
                    <input type="hidden" name="db_lat" class="js-autocomplete-lat">
                    <input type="hidden" name="db_lng" class="js-autocomplete-lng">
                </div>
                <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDU9RxWxpRRoy9R-wAILv5Owb7GaXHLVaw&libraries=places&callback=initAutocomplete"
                        async defer></script>
            <?php else: ?>
            <div class="customSel-wrapper">
                <label><?php echo $val['name']; ?></label>
                <select name="<?php echo $key; ?>" class="select-hidden">
                    <?php foreach ($val['values'] as $key2 => $value2): ?>
                        <option value="<?php echo $key2 ?>" <?php echo ($key2 == -1)? 'selected' : '' ?>><?php echo $value2 ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <?php
            endif;
        }

    }


	public static function convertCurrency($val){
	    return number_format($val, 0, ",", " ") . " " . CURRENCY;
    }

	public static function getTextPart($string, $number_chars=32){
		return strip_tags(substr($string, 0, $number_chars)) . "...";
	}

	public static function translateBinaryValue($binary){
	    return ($binary == 1) ? "Ano" : "Ne";
    }

    public static function formatPhone($number){
	    if(ctype_digit($number) && strlen($number) == 9) {
		    $number = PHONE . ' ' . substr($number, 0, 3) .' '. substr($number, 3, 3) .' '. substr($number, 6);
	    }
	    return $number;
    }

    public static function formatTime($time){
	    return date(DATE_FORMAT ,$time);
    }

    public static function geocodeAdress($addres){
	    $address = urlencode($addres);
	    $link = 'https://maps.googleapis.com/maps/api/geocode/json?address=' . $address . '&key=' . GOOGLE_SERVER_API_KEY;
	    $result = json_decode(file_get_contents($link));
	    if(property_exists($result, "results")){
	        $result = array_pop($result->results);
	        if(is_object($result) && property_exists($result, "geometry")){
	            $geometry = $result->geometry;
	            if(property_exists($geometry, "location")){
	                return $geometry->location;
                }
            }
        }
	    return false;
    }

    public static function build_url(array $parts) {
        return (isset($parts['scheme']) ? "{$parts['scheme']}:" : '') .
            ((isset($parts['user']) || isset($parts['host'])) ? '//' : '') .
            (isset($parts['user']) ? "{$parts['user']}" : '') .
            (isset($parts['pass']) ? ":{$parts['pass']}" : '') .
            (isset($parts['user']) ? '@' : '') .
            (isset($parts['host']) ? "{$parts['host']}" : '') .
            (isset($parts['port']) ? ":{$parts['port']}" : '') .
            (isset($parts['path']) ? "{$parts['path']}" : '') .
            (isset($parts['query']) ? "?{$parts['query']}" : '') .
            (isset($parts['fragment']) ? "#{$parts['fragment']}" : '');
	}
}
