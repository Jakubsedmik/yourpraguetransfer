<?php


class ciselnikClass extends zakladniKamenClass {

	//dbvars
	protected $db_domain;
	protected $db_property;
	protected $db_value;
	protected $db_translation;

	protected function zakladniVypis() {

	}

	protected function zakladniHtmlVypis() {

	}

	public function getTableName() {
		return 's7_ciselnik';
	}
}