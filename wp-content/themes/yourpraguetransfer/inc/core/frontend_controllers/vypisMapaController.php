<?php


class vypisMapaController extends frontendController {

	public function beforeHeadersAction() {

	}

	public function action() {
		// FILTER AVAILABLE FILTERS FROM HP
		global $filter_hp_parameters;
		$vue_preset_filters = array();
		foreach ($this->requestData as $key => $value){
			if(in_array($key, $filter_hp_parameters)){
				$vue_preset_filters[$key] = $this->requestData[$key];
			}
		}
		$this->requestData['filterPreset'] = Tools::prepareJsonToOutputHtmlAttr($vue_preset_filters);

		// PREPARE FILTERS FOR VUE
		global $filter_parameters;
		foreach ($filter_parameters as $key => $value){
			$key_new = str_replace("db_","", $key);
			if($value['type'] == "select"){
				if(is_array($value['values']) && count($value['values'])==0){
					$filter_parameters[$key]['values'] = globalUtils::getValuesForFilter("inzeratClass", $key_new, __("-- Bez filtru --","realsys"));
				}
			}elseif ($value['type'] == "customswitcher" || $value['type'] == 'option'){
				$filter_parameters[$key]['values'] = globalUtils::getValuesForFilter("inzeratClass", $key_new, false);
			}
		}

		$this->requestData['filter'] = Tools::prepareJsonToOutputHtmlAttr($filter_parameters);
	}
}