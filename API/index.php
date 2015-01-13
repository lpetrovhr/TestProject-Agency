<?php
include_once 'models/Apartman.php';

try {
	$params = $_REQUEST;

	$controller = ucfirst(strtolower($params['controller']));

	$action = strtolower($params['action']).'Action';

	//check if controller exists if not throw exception
	if(file_exists("controllers/{$controller}.php")) {
		include_once "controllers/{$controller}.php";
	} else {
		throw new Exception("Controller is invalid");
	}
	include_once "controllers/{$controller}.php";

	//create new instance of controller
	$controller = new $controller($params);

	//check if action exists in controller. If not throw an exception
	if(method_exists($controller, $action) === false) {
		throw new Exception("Action is invalid");
	}
	
	//execute the action
	$result['data'] = $controller->$action();
	$result['success'] = true;

} catch (Exception $e) {
	$result = array();
	$result['success'] = false;
	$result['errormsg'] = $e->getMessage();
}

//echo the result
echo json_encode($result);
exit();