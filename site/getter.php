<?php
session_start();
include_once 'apicaller.php';
$apicaller = new ApiCaller('APP001', '28e336ac6c9423d946ba02d19c6a2632','http://localhost/apartman/API/');

if($_SERVER['REQUEST_METHOD'] == 'POST') {

	$data = json_encode($_POST);
	
	$apartmani = $apicaller->sendRequest(array(
		'controller' => 'apartmani',
		'action' => 'create',
		'data' => $data
	)); 

} else if ($_SERVER['REQUEST_METHOD'] === 'GET')  {
	if(!isset($_GET['id'])) {
		$apartmani = $apicaller->sendRequest(array(
			'controller' => 'apartmani',
			'action' => $_GET['action']
		));
	} else {
		$apartmani = $apicaller->sendRequest(array(
			'controller' => 'apartmani',
			'action' => $_GET['action'],
			'id' => $_GET['id']
		));
	}
	
} else if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
	parse_str(file_get_contents("php://input"),$post_vars);

	$data = json_encode($post_vars);

	$apartmani = $apicaller->sendRequest(array(
		'controller' => 'apartmani',
		'action' => 'update',
		'data' => $data
	));
}

echo $apartmani;