<?php 

class inputValidator{
	

	public function emailValidate($email){
		
		if (preg_match('/^\S+@\S+\.\S+$/',$email)) {
			return true;
		}
		else{
			return false;
		}

	}

	public function loginValidate($login){

		if (strlen($login) >= 6) {
			return true;
		}
		else{
			return false;
		}
	}

	public function nameValidate($name){

		if (preg_match('/^[a-zA-Z]{2}$/', $name)) {
			return true;
		}
		else{
			return false;
		}
	}

	public function passwordValidate($password){

		if (preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$/', $password)) {
			return true;
		}
		else{
			return false;
		}
	}


} // end of class