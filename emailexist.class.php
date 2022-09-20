<?php 

class EmailExistUser{
	// class properties
	public $storage = "data.json";
	public $stored_users;


	public function __construct(){
		$this->stored_users = json_decode(file_get_contents($this->storage), true);
	}


	public function emailExists($email){
		foreach($this->stored_users as $user){
    		if($user['email'] === $email){
    			return false;
    		}
    	}
    	return true;
		
	}
	public function loginExists($login){
		$login = filter_var(trim($login), FILTER_SANITIZE_STRING);
		foreach($this->stored_users as $user){
    		if($user['login'] === $login){

    			return false;
    		}
		}
		return true;
		
	}

	public function passwordExists($password){
		foreach($this->stored_users as $user){

    		if (password_verify($password, $user['password'])) {
    		    
    		    return false;
    		}
		}
		return true;
		
	}

	public function loginPageExists($login){
		foreach($this->stored_users as $user){

    		if ($user['login'] === $login) {
    		    
    		    return true;
    		}
		}
		return false;
		
	}

	public function loginPagePasswordCheck($login,$password){
		foreach($this->stored_users as $user){


    		if ($user['login'] === $login && password_verify($password, $user['password'])) {
    		    return true;
    		}
		}
		return false;
		
	}
}

