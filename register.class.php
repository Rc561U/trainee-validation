<?php 
class RegisterUser{
	// Class properties
	private $login;
	private $email;
	private $name;
	
	private $raw_password;
	private $encrypted_password;
	public $error;
	public $success;
	private $storage = "data.json";
	private $stored_users;
	private $new_user; // array 


	public function __construct($login, $name, $password, $email){

		$this->login = trim($this->login);
		$this->name = trim($this->name);

		$this->login = filter_var($login, FILTER_SANITIZE_STRING);
		$this->name = filter_var($name, FILTER_SANITIZE_STRING);
		$this->email = filter_var($email, FILTER_SANITIZE_STRING);

		$this->raw_password = filter_var(trim($password), FILTER_SANITIZE_STRING);
		$this->encrypted_password = password_hash($this->raw_password, PASSWORD_DEFAULT);

		$this->stored_users = json_decode(file_get_contents($this->storage), true);

		$this->new_user = [
			"login" => $this->login,
			"name" => $this ->name,
			"password" => $this->encrypted_password,
			"email" => $this->email
		];

		$this->insertUser();
		
	}



	private function loginExists(){
		foreach($this->stored_users as $user){
			if($this->login == $user['login']){
				$this->error = "login already taken, please choose a different one.";
				return true;
			}
		}
		return false;
	}

	private function emailExists(){
		foreach($this->stored_users as $user){
			if($this->email == $user['email']){
				$this->error = "email already taken, please choose a different one.";
				return true;
			}
		}
		return false;
	}


	private function insertUser(){
		if($this->loginExists() == FALSE && $this->emailExists() == FALSE) {
			array_push($this->stored_users, $this->new_user);
			if(file_put_contents($this->storage, json_encode($this->stored_users, JSON_PRETTY_PRINT))){
				// header("Location: signup-success.html");
				$this->success = "Your registration was successful";
				// header("Location: login-page.html");
			}else{
				$this->error = "Something went wrong, please try again";
			}
		}
	}



} // end of class