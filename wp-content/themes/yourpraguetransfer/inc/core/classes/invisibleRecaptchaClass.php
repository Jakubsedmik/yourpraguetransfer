<?php


class invisibleRecaptchaClass
{
    /*
     * Třída funguje ve static módu, tedy není třeba konstruktoru.
     */

    /*
     * Natáhne integrační data z globálně přístupných konstant
     */
    protected static $secret = RECAPTCHA;
    protected static $site_key = RECAPTCHA_SITEKEY;
    protected static $url = "https://www.google.com/recaptcha/api/siteverify";

    /*
     * Ověří zdali recaptcha hash je platný oproti google services (vytváří HTTP request, který ověřuje)
     */
    public static function verifyRecaptcha($recaptcha_hash){

		// Curl Request
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, self::$url);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_FAILONERROR, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_POSTFIELDS, array(
			'secret' => self::$secret,
			'response' => $recaptcha_hash,
			'remoteip' => $_SERVER['REMOTE_ADDR']
			));
		$curlData = curl_exec($curl);
		curl_close($curl);

		// Parse data
		$recaptcha = json_decode($curlData, true);

		if($recaptcha !== NULL){
            if ($recaptcha["success"]){
                return true;
            }else{
                return false;
            }
        }else{
		    trigger_error("Failed to get recaptcha response");
		    return false;
        }

    }

    /*
     * Ověří platnost recaptchi v controlleru, jedná se pouze o rozšíření funkce verifyRecaptcha pro usecase uvnitř systému, mimo systém nemá význam (rozšířený context)
     */
    public static function verifyRecaptchaOnController($controller){
	    if(Tools::checkPresenceOfParam("g-recaptcha-response", $controller->requestData)){
		    $token = $controller->requestData['g-recaptcha-response'];
		    if(self::verifyRecaptcha($token)){
			    return true;
		    }
	    }

        frontendError::addMessage(__("Ověření","realsys"), ERROR, __("Ověření uživatele bylo neúspěšné","realsys"));
        $controller->setView("error");
        return false;
    }


    /*
     * Funkce která řídí formulář. Každý form, který má třídu js-recaptchaForm a uvnitř něj tlačítko button pro submit je ošetřen recaptchou a zasílá na
     * server onen scroing, který je třeba ověřit proti Google metodou verifyRecaptcha
     */
    public static function generateRecaptchaListeners(){
    	?>
		    <script src="https://www.google.com/recaptcha/api.js?onload=recaptchaScriptReady&render=explicit" async defer></script>
            <script>
                function recaptchaScriptReady(){
                    $(document).ready(function () {
                        $(".js-recaptchaForm").each(function (index, el) {
                            var id = 'cpt-' + index;
                            var recaptchaContainer = $('<div class="recaptchaContainer" id="' + id + '"></div>');
                            $(this).append(recaptchaContainer);
                            recaptchaContainer = recaptchaContainer.eq(0);
                            var recaptchaWidgetId = grecaptcha.render(id, {
                                'sitekey' : '<?php echo self::$site_key; ?>',
                                'theme' : 'light',
                                'size' : 'invisible',
                                'callback' : continueForm
                            });
                            recaptchaContainer.attr("data-rid", recaptchaWidgetId);
                        });

                        $(".js-recaptchaForm button").on("click", function (e) {
                            e.preventDefault();
                            var widgetId = $(this).find(".recaptchaContainer").attr("data-rid");
                            $(".js-recaptchaForm").removeClass("execution");
                            grecaptcha.reset(widgetId);
                            grecaptcha.execute(widgetId);
                            $(this).closest(".js-recaptchaForm").addClass("execution");
                        });

                    });
                }
                
                function continueForm(token) {
                    console.log("after form submission");
                    $(".js-recaptchaForm.execution").submit();
                }
            </script>
		<?php
    }
}