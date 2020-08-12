<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of globalUtils
 *
 * @author Jackie
 */
class globalUtils {
    
    
    public static $debugstack = array();
    
    public static function generateGetLink($query, $root=false){
        $currentLink = $_SERVER["PHP_SELF"];
        if($root != true ){
            $query = array_merge($_GET,$query);
        }else {
            $query = array_merge($query, array("page"=>PLUGIN_SLUG));
        }
        $returnlink = $currentLink . "?" . http_build_query($query);
        return $returnlink;
    }
    
    
    public static function translate($sentence){
        global $dictionary;
        if(isset($dictionary[$sentence])){
            return $dictionary[$sentence];
        }
        return $sentence;
    }

    /*
    public static function processForm($superglobal, $class = 'default'){
        global $field_rules;
        if(isset($superglobal["processForm"])){

            $filteredArray = self::filterOnlyDbProperties($superglobal);
            $fieldsDescription = array();
            $fules = array();
            if(isset($field_rules[$class])){
                $rules = $field_rules[$class];
            }else{
                $rules = $field_rules['default'];
            }
            
            foreach ($filteredArray as $key => $value) {
                if(isset($rules[$key])){
                    $fieldsDescription[$key] = $rules[$key];
                }
            }
            $response = Tools::postChecker($filteredArray, $fieldsDescription, true);
            $response = ($response == true) ? $filteredArray : false;
            return $response;
        }
    } */

    public static function filterOnlyDbProperties($arr){
	    $filteredArray = $arr;
	    $filteredArray = array_filter($filteredArray, function($obj,$index){
		    $re = '/^db_.{1,}$/m';
		    if(!preg_match($re, $index)){
			    return false;
		    }
		    return true;
	    }, ARRAY_FILTER_USE_BOTH);
	    return $filteredArray;
    }
    
    
    public static function writeDebug($entity){
        ob_start();
        echo "<pre>";
        print_r($entity);
        echo "</pre>";
        $out = ob_get_clean();
        self::$debugstack[] = $out;
        return $out;
    }
    
    public static function renderDebug(){
    	if(count(self::$debugstack) == 0){
    		return "";
	    }
	    $output = '<style>
		.debugPanel{
		    position: fixed;
		    right: 0px;
		    bottom: 0px;
		    height: 380px;
		    width: 530px;
		    overflow-y: scroll;
		    padding: 25px;
		    background-color: #272838;
		    border: 1px solid #0b2a41;
		    border-top-left-radius: 5px;
		    box-shadow: 0px 0px 15px 5px rgba(0, 0, 0, 0.09);
		    z-index: 999;
		}
		.debugPanel pre {
		    color: #00d500;
		}
		
		.debugPanel h3 {
			color: #00d500;
		}
		</style>';
	    $output .= '
          <script>
			  $( document).ready(function() {
			    $( ".debugPanel" ).resizable({ handles: "n, w, nw" });
			    $(".debugPanel").draggable();
			  } );
		  </script>
	    ';
        $output .= '<code class="debugPanel">';
        $output .= '<h3>Debug konzole</h3>';
        foreach (self::$debugstack as $key => $value) {
            $output .= $value;
            $output .= '<hr>';
        }
        $output .= '</code>';
        return $output;
    }
    
    
    public static function lineProcesor($superglobal){
        $db_property = "";
        if(isset($superglobal["lineproperty"])){
            $db_property = $superglobal['lineproperty'];
            $filteredArr = array_filter($superglobal, function($obj, $index){
                if(preg_match('/^linekey-\d+/m', $index) && strlen($obj) > 0){
                    return true;
                }
                return false;
            },ARRAY_FILTER_USE_BOTH);
            
            
            
            $finalArr = array();
            foreach ($filteredArr as $key => $value) {
                $index = explode("-", $key)[1];
                $finalVal = $superglobal['lineval-' . $index];
                if(strlen($finalVal) > 0){
                    $finalArr[$value] = $finalVal;
                }else{
                    $finalVal = "";
                    $finalArr[$value] = $finalVal;
                }
                
            }
            if(count($finalArr)==0){
                $finalArr2[$db_property] = "";
            }else{
                $finalArr2[$db_property] = $finalArr;
            }
            
            return $finalArr2;
            
        }
    }
    
    public static function multipleAddProcessor($superglobal, $fieldName){
        if(isset($superglobal[$fieldName])){
            $multipleAdd = $superglobal[$fieldName];
        }else{
            $multipleAdd = array();
        }

        if(is_array($multipleAdd)){
            return array_values($multipleAdd);
        }else{
            return array_values(array());
        }
    }

    public static function checkFieldValidity($data_key,$data, $type){
    	$array_data = array($data_key => $data);
    	$array_type = array($data_key => $type);
    	$result = Tools::postChecker($array_data, $array_type, true);
    	return $result;
    }

    public static function getValuesForFilter($class, $state, $default = false){
    	$values = assetsFactory::getAllDials($class, $state);
    	$clearValues = array();
    	foreach ($values as $key => $value){
    		$clearValues[$value->db_value] = $value->db_translation;
	    }
    	if($default !== false){
    		$clearValues[-1] = $default;
	    }
    	return $clearValues;
    }

    
}
