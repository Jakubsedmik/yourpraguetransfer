<?php


class typeClass implements JsonSerializable {
	protected $key;
	protected $type;
	protected $value;
	protected $required;
	protected $status;
	protected $message;

	public function __construct( $key, $value, $required, $type ) {
		$this->key      = $key;
		$this->value    = $value;
		$this->required = $required;
		$this->type     = $type;
		$this->isValid();
	}

	public function isValid() {
		if ( $this->required ) {

			if ( $this->value !== null ) {
				return $this->typeValidator();
			} else {
				$response = __("Pole","realsys") . " " . globalUtils::translate( $this->key ) . " " . __("není přítomno.","realsys");
				frontendError::addMessage( $this->key, ERROR, $response, $this );
				$this->message = $response;

				return false;
			}
		} else {
			if ( $this->value == null || strlen($this->value)==0 ) {
				$this->status = true;

				return true;
			} else {
				return $this->typeValidator();
			}
		}
	}

	public function typeValidator() {
		$response = "";
		$status   = true;
		switch ( $this->type ) {

			/* NUMERIC FILTERS */
			case 'int':
				if ( ! $this->isInteger($this->value) ) {
					$response = __("Pole","realsys") . " " . globalUtils::translate( $this->key ) . " " . __("není platné číslo.","realsys");
					$status   = false;
					frontendError::addMessage( $this->key, ERROR, $response, $this );
				}
				break;
			case "bool" :
				if ( ! is_bool( $this->value ) && ! ( $this->value == 1 || $this->value == 0 ) ) {
					$response = __("Pole","realsys") . " " . globalUtils::translate( $this->key ) . " " . __("není platná logická hodnota.","realsys");
					$status   = false;
					frontendError::addMessage( $this->key, ERROR, $response, $this );
				}
				break;
			case "float" :
				if ( $this->isFloat($this->value)) {
					break;
				}else{
					$response = __("Pole","realsys") . " " . globalUtils::translate( $this->key ) . " " . __("není platné desetinné číslo.","realsys");
					$status   = false;
					frontendError::addMessage( $this->key, ERROR, $response, $this );
				}
				break;

			/* TEXTUAL FILTERS */
			case 'str63' :
				if ( is_string( $this->value ) && strlen( $this->value ) < 64 && strlen($this->value) > 0 ) {
					break;
				} else {
					$response = __("Pole","realsys") . " " . globalUtils::translate( $this->key ) . " " . __("není řetězec o délce 63 znaků.","realsys");
					$status   = false;
					frontendError::addMessage( $this->key, ERROR, $response, $this );
					break;
				}
			case 'str255' :
				if ( is_string( $this->value ) && strlen( $this->value ) < 256 && strlen($this->value) > 0 ) {
					break;
				} else {
					$response = __("Pole","realsys") . " " . globalUtils::translate( $this->key ) . " " . __("není řetězec o délce 255 znaků.","realsys");
					$status   = false;
					frontendError::addMessage( $this->key, ERROR, $response, $this );
					break;
				}
			case 'str511' :
				if ( is_string( $this->value ) && strlen( $this->value ) < 512 && strlen($this->value) > 0 ) {
					break;
				} else {
					$response = __("Pole","realsys") . " " . globalUtils::translate( $this->key ) . " " . __("není řetězec o délce 511 znaků.","realsys");
					$status   = false;
					frontendError::addMessage( $this->key, ERROR, $response, $this );
					break;
				}
			case 'str':
				if ( ! is_string( $this->value ) || strlen( $this->value ) == 0 ) {
					$response = __("Pole","realsys") . " " . globalUtils::translate( $this->key ) . " " . __("není platný řetězec.", "realsys");
					$status   = false;
					frontendError::addMessage( $this->key, ERROR, $response, $this );
				}
				break;

			/* FUNCTIONAL FILTERS */
			case 'date':
				if ( $this->isTimestamp( $this->value ) ) {
					break;
				}
				$custom_date = $this->value;
				$custom_date = str_replace( ".", "-", $custom_date );
				if ( strtotime( $custom_date ) === false ) {
					$response = __("Pole","realsys") . " " . globalUtils::translate( $this->key ) . " " . __("není platné datum.","realsys");
					$status   = false;
					frontendError::addMessage( $this->key, ERROR, $response, $this );
				}
				break;
			case 'tel':
				if ( ! preg_match( REGEX_TELEPHONE, $this->value ) ) {
					$response = __("Pole","realsys") . " " . globalUtils::translate( $this->key ) . " " . __("není ve správném formátu.","realsys");
					$status   = false;
					frontendError::addMessage( $this->key, ERROR, $response, $this );
				}
				break;
			case 'url' :
				if ( ! Tools::isValidUrl( $this->value ) ) {
					$response = __("Pole","realsys") . " " . globalUtils::translate( $this->key ) . " " . __("není platná URL.","realsys");
					$status   = false;
					frontendError::addMessage( $this->key, ERROR, $response, $this );
				}
				break;
			case "time" :
				if ( ! preg_match( REGEX_TIME, $this->value ) ) {
					$response = __("Pole","realsys") . " " . globalUtils::translate( $this->key ) . " " . __("není typu čas.","realsys");
					$status   = false;
					frontendError::addMessage( $this->key, ERROR, $response, $this );
				}
				break;
			case "mail" :
				if ( ! filter_var($this->value, FILTER_VALIDATE_EMAIL) ) {
					if(strpos($this->value,"localhost") !== false){
						break;
					}
					$response = __("Pole","realsys") . " " . globalUtils::translate( $this->key ) . " " . __("není typu email.","realsys");
					$status   = false;
					frontendError::addMessage( $this->key, ERROR, $response, $this );
				}
				break;
			case "array" :
				if ( ! is_array( $this->value ) ) {
					$response = __("Pole","realsys") . " " . globalUtils::translate( $this->key ) . " " . __("není typu pole.","realsys");
					$status   = false;
					frontendError::addMessage( $this->key, ERROR, $response, $this );
				}
				break;
			case "price" :
				if ( $this->isPrice( $this->value ) ) {
					break;
				} else {
					$response = __("Pole","realsys") . " " . globalUtils::translate( $this->key ) . " " . __("není platná cena.","realsys");
					$status   = false;
					frontendError::addMessage( $this->key, ERROR, $response, $this );
					break;
				}
			case "price_zero" :
				if ( $this->isPriceZero( $this->value ) ) {
					break;
				} else {
					$response = __("Pole","realsys") . " " . globalUtils::translate( $this->key ) . " " . __("není platná cena.","realsys");
					$status   = false;
					frontendError::addMessage( $this->key, ERROR, $response, $this );
					break;
				}
			case 'timestamp' :
				if ( $this->isTimestamp( $this->value ) ) {
					break;
				} else {
					$response = __("Pole","realsys") . " " . globalUtils::translate( $this->key ) . " " . __("není platný časový údaj.","realsys");
					$status   = false;
					frontendError::addMessage( $this->key, ERROR, $response, $this );
					break;
				}
			case 'fk' :
				if ( $this->isForeignKey( $this->value ) ) {
					break;
				} else {
					$response = __("Pole","realsys") . " " . globalUtils::translate( $this->key ) . " " . __("není platný cizí klíč.","realsys");
					$status   = false;
					frontendError::addMessage( $this->key, ERROR, $response, $this );
				}
				break;
			case 'url_rel' :
				if ( ! preg_match( REGEX_URL_RELATIVE, $this->value ) ) {
					$response = __("Pole","realsys") . " " . globalUtils::translate( $this->key ) . " " . __("není platná relativní cesta.","realsys");
					$status   = false;
					frontendError::addMessage( $this->key, ERROR, $response, $this );
				}
				break;
		}
		$this->status  = $status;
		$this->message = $response;

		return $status;
	}

	/**
	 * Specify data which should be serialized to JSON
	 * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
	 * @return mixed data which can be serialized by <b>json_encode</b>,
	 * which is a value of any type other than a resource.
	 * @since 5.4.0
	 */
	public function jsonSerialize() {
		$info = array(
			'key'      => $this->key,
			'value'    => $this->value,
			'type'     => $this->type,
			'required' => $this->required,
			'message'  => $this->message
		);

		return $info;
	}

	/**
	 * @return mixed
	 */
	public function getKey() {
		return $this->key;
	}

	/**
	 * @param mixed $key
	 */
	public function setKey( $key ) {
		$this->key = $key;
	}

	/**
	 * @return mixed
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * @param mixed $type
	 */
	public function setType( $type ) {
		$this->type = $type;
	}

	/**
	 * @return mixed
	 */
	public function getValue() {
		return $this->value;
	}

	/**
	 * @param mixed $value
	 */
	public function setValue( $value ) {
		$this->value = $value;
	}

	/**
	 * @return mixed
	 */
	public function getRequired() {
		return $this->required;
	}

	/**
	 * @param mixed $required
	 */
	public function setRequired( $required ) {
		$this->required = $required;
	}

	/**
	 * @return mixed
	 */
	public function getStatus() {
		return $this->status;
	}

	/**
	 * @param mixed $status
	 */
	public function setStatus( $status ) {
		$this->status = $status;
	}

	/**
	 * @return mixed
	 */
	public function getMessage() {
		return $this->message;
	}

	/**
	 * @param mixed $message
	 */
	public function setMessage( $message ) {
		$this->message = $message;
	}

	public function isInteger( $integer ) {
		$val = intval( $integer );
		return ( $val == $integer ) && ( is_int( $val ) && $val < PHP_INT_MAX && $val > PHP_INT_MIN );
	}

	public function isFloat( $float ) {
		$val = floatval( $float );
		return ( $val == $float ) && ( is_float( $val ) && $val < PHP_FLOAT_MAX && $val > PHP_FLOAT_MIN );
	}

	public function isTimestamp( $timestamp ) {
		return ( $this->isInteger( $timestamp ) && $timestamp > 0 );
	}

	public function isPrice( $price ) {
		return ( $this->isInteger( $price ) && $price < PHP_INT_MAX && $price > 0 );
	}

	public function isPriceZero( $price ) {
		return ( $this->isInteger( $price ) && $price < PHP_INT_MAX && $price > -1 );
	}

	public function isForeignKey ( $key ){
		return $this->isPrice($key);
	}


}