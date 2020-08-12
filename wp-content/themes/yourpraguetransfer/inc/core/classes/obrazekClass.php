<?php


class obrazekClass extends zakladniKamenClass {

	protected $db_titulek;
	protected $db_popisek;
	protected $db_kod;
	protected $db_url;

	protected $db_inzerat_id;
	protected $db_front;


	protected function zakladniVypis() {

	}

	protected function zakladniHtmlVypis() {

	}

	public function getTableName() {
		return "s7_obrazek";
	}

	public function getInterfaceTypes() {
		return array(
			"db_id" => "number",
			"db_url" => "image",
			"db_titulek" => "string",
			"db_popisek" => "string",
			"db_front" => "bool"

		);
	}

	public function getImageDimensions(){
		global $image_sizes;
		$image_urls = array();
		foreach ($image_sizes as $key => $value){
			$image_urls[$key] = DEFAULT_UPLOAD_URL . $value['prefix'] . "_" . $this->db_kod;
		}
		return $image_urls;
	}
}