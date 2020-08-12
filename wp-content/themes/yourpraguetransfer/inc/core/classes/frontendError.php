<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of frontendError
 *
 * @author Jackie
 */
class frontendError {
    public $error_description;
    public $error_type;
    public $field_name;
    public $type_object;
    
    protected static $allErrors = array();
    
    public function __construct($field_name, $error_type, $error_description, $type_object) {
        $this->error_description = $error_description;
        $this->error_type = $error_type;
        $this->field_name = $field_name;
        $this->type_object = $type_object;
    }

    public function getBackendMessage(){
        $html = "";
        $html .= '<div class="alert alert-' . $this->error_type . '" role="alert" alert-dismissible fade show">';
        $html .= '<strong>' . globalUtils::translate($this->field_name) . '</strong> - '. $this->error_description;
        $html .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
        $html .= '</div>';
        return $html;
        
    }
    
    public static function getBackendErrors(){
        $html = '<div class="backendErrors container p-0 mt-3">';
        foreach (self::$allErrors as $key => $value) {
            $html .= $value->getBackendMessage();
        }
        $html .= '</div>';
        return $html;
    }
    
    public static function addMessage($field_name, $error_type, $error_description,$type_object = null){
        $error = new frontendError($field_name,$error_type,$error_description, $type_object);
        self::$allErrors[] = $error;
    }


    public static function getFrontendErrors(){
	    $html = '<div class="backendErrors p-0 mt-3">';
	    foreach (self::$allErrors as $key => $value) {
		    $html .= $value->getBackendMessage();
	    }
	    $html .= '</div>';
	    return $html;
    }

    public static function getJSONErrors(){
		$info = array();
    	foreach (self::$allErrors as $key => $val){
			$info[$val->field_name] = $val->type_object;
		}
    	return $info;
    }
}
