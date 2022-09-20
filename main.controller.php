
<?php
// header("Content-Type: application/json");

require ("emailexist.class.php");
$str_json = file_get_contents('php://input'); //($_POST doesn't work here)
$response = json_decode($str_json, true); 


$email = $response['email'];
$login = $response['login'];
$password = $response['password'];
$loginPage = $response['loginPage'];
$execute = $response['destroy'];
$status = $response['status'];


$res = new EmailExistUser();

// var_dump($loginPage);
// var_dump($password);
// var_dump($email);
// var_dump($login);

if ($loginPage && $password) {
	$is_available = $res->loginPagePasswordCheck($loginPage,$password);
	echo json_encode(["available" => $is_available]);
	session_start();
	session_regenerate_id();
	$_SESSION['user'] = $loginPage;
}
else if ($email) {
	$is_available = $res->emailExists($email);
	echo json_encode(["available" => $is_available]);
}
else if ($login) {
	$is_available = $res->loginExists($login);
	echo json_encode(["available" => $is_available]);
}
else if ($password) {
	$is_available = $res->passwordExists($password);
	echo json_encode(["available" => $is_available]);
}
else if ($loginPage) {
	$is_available = $res->loginPageExists($loginPage);
	echo json_encode(["available" => $is_available]);
}
else if ($status) {
	
	echo json_encode(["status" => $_SESSION['user']]);
}
	

else if ($execute) {
	$_SESSION = array();

	if (ini_get("session.use_cookies")) {
	    $params = session_get_cookie_params();
	    setcookie(session_name(), '', time() - 42000,
	        $params["path"], $params["domain"],
	        $params["secure"], $params["httponly"]
	    );
	}

	session_destroy();
	echo json_encode(["session" => false]);
}
else{
	echo json_encode(["available" => "data not found"]);
}



?>