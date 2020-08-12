<?php


class smsClass {

	public static $url = 'https://http-api.smsmanager.cz/Send';

	protected $api_key;
	protected $sender;
	protected $phone_number;
	protected $possible_to_send;

	public function __construct($user_or_phone, $sender = "420777888999") {
		$this->api_key = SMS_API_KEY;
		$this->sender = $sender;

		if(is_object($user_or_phone) && get_class($user_or_phone)){

			$this->phone_number = $user_or_phone->db_telefon;
			$this->possible_to_send = true;

		}elseif(is_string($user_or_phone)){
			$phone = new typeClass("SMS Phone",$user_or_phone, true, TEL);
			if($phone->isValid()){
				$this->phone_number = $user_or_phone;
				$this->possible_to_send = true;
			}else{
				$this->possible_to_send = false;
				trigger_error($phone->getMessage());
			}
		}else{
			$this->possible_to_send = false;
			trigger_error("Vstupní parametry pro zaslání zprávy jsou ve špatném formátu");
		}
	}

	public function sendSMS($message){

		if($this->possible_to_send){

			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, self::$url);
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl, CURLOPT_FAILONERROR, true);
			curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($curl, CURLOPT_POSTFIELDS, array(
				'apikey' => $this->api_key,
				'number' => $this->phone_number,
				'message' => $message
			));
			$curlData = curl_exec($curl);
			curl_close($curl);

			$curlData = explode("|",$curlData);

			if($curlData[0] !== "OK"){
				trigger_error("Došlo k chybě při odesílání SMS, návratová zpráva: " . implode($curlData, "|") . ". Telefon:" . $this->phone_number . " Zpráva:" . $message );
				return false;
			}
			return true;
		}else{
			return false;
		}
	}

}