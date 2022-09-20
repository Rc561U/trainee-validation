
<?php 
require("register.class.php") ;


$login = $_POST['login'];
$name = $_POST['name'];
$password = $_POST['password'];
$email = $_POST['email'];

$response = array('status' => '', 'response' => '');

try{
	
	new RegisterUser($login, $name, $password, $email);
	$response['status'] = 'ok';
	$response['response'] = 'New account seccessfully created';
	echo json_encode($response);

}catch(Exception $e) {

	$response['status'] = 'error';
	$response['response'] = 'Smth wrong';
    echo json_encode($response);
}

