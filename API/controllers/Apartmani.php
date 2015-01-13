<?php
class Apartmani {
	private $_params;

	public function __construct($params) {
		$this->_params = $params;
	}

	public function readAction() {
		//read all data 
		$allApart = Apartman::getAllItems();

		//return the list
		return $allApart;
	}

	public function readOneAction() {

		$onlyOne = Apartman::getItem($this->_params['id']);

		if(is_null($onlyOne)) {
			$onlyOne = "There is no data for that query";
		}
		return $onlyOne;
	}

	public function createAction() {
		$data = json_decode($this->_params['data']);

		$save_entry = Apartman::save($data);

		return $save_entry;
	}

	public function updateAction() {

		$data = json_decode($this->_params['data']);
		$update_entry = Apartman::update($data);

		return $update_entry;
	}
}