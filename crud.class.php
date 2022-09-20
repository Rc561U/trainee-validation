<?php 

include 'validator.class.php';

class RegisterUser{
	// Class properties
	
	private $storage = "data.json";
	private $stored_users;

	private $validationSuccess = false;
	private $validationError = '';



	public function __construct(){
		$this->encrypted_password = password_hash($this->raw_password, PASSWORD_DEFAULT);

		$this->stored_users = json_decode(file_get_contents($this->storage), true);

		
		
	}



	public function emailExists($email){
		foreach($this->stored_users as $user){
    		if($user['email'] === $email){
    			return false;
    		}else{
    			return true;
    		}
		}
	}


	public function loginExists($login){
		foreach($this->stored_users as $user){
    		if($user['login'] === $login){
    			return false;
    		}else{
    			return true;
    		}
		}
	}


	private function valididAllInputs($login,$name,$email,$password){
		$validid = new inputValidator();

		if (!($validid->loginValidate($login))) {
			$this->validationError =  "Login have to consist of more then 5 letters";
			return;
		}

		if (!($validid->nameValidate($name))) {
			$this->validationError =  "Name have to consist of 2 letters only";
			return;
		}

		if (!($validid->emailValidate($email))) {
			$this->validationError =  "Email has invalid format";
			return;
		}

		if (!($validid->passwordValidate($password))) {
			$this->validationError =  "Minimum six characters, at least one letter and one number";
			return;
		}
		$this->validationSuccess = true;
	}

	public function addNewUserToDatabase($login,$name,$email,$password){
		
		 
		if (!($this->validationSuccess)){
			return $this->validationError;
		}

		if (!($this->emailExists($email))){
			return "Email already exists";
		} 
		if (!($this->loginExists($login))) {
			return 'Login already exists';
		}
		$encrypted_password = password_hash($password, PASSWORD_DEFAULT);

		$new_user = [
			"login" => $login,
			"name" => $name,
			"password" => $encrypted_password,
			"email" => $email
		];
		array_push($this->stored_users, $new_user);
		if(file_put_contents($this->storage, json_encode($this->stored_users, JSON_PRETTY_PRINT))){
			return "You successfuly registrate new user";
		}else{
			return "Something went wrong, please try again";
		}
	}
	



} // end of class