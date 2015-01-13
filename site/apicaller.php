<?php
class ApiCaller {
	private $_app_id;
	private $_app_key;
	private $_api_url;


	//construct API CALLER object
	public function __construct($app_id, $app_key, $api_url) {
		$this->_app_id = $app_id;
		$this->_app_key = $app_key;
		$this->_api_url = $api_url;
	}

	//send request to the API server
	public function sendRequest($request_params) {
		$params = array();

		$params['request'] = $request_params;
		$params['app_id'] = $this->_app_id;


		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->_api_url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $params["request"]);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		//execute request
		$result = curl_exec($ch);

		//test other
		$fm = fopen("try.txt", "w");
		fwrite($fm, var_export($result, true));


		//json decode the result
		$result = json_decode($result);

		//check if is decoded correctly
		if($result == false || isset($result->success) == false) {
			throw new Exception('Request was not correct');
		}

		//if there was an error in request
		if($result->success == false) {
			throw new Exception($result->errormsg);
		}

		//if everything was successful return data
		return json_encode($result->data);
	}
}