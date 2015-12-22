<?php

class User {

	private $username, $password;

	function login($dbCon) {
	
		$this->username = $dbCon->real_escape_string($_POST['username']);
		$this->password = $dbCon->real_escape_string($_POST['password']);
		$query = "
			SELECT * 
			FROM user 
			WHERE username = '$this->username' 
			AND password = '$this->password'
		";
		$result = $dbCon->query($query);

		//OM USERNAME OCH PASSWORD STÄMMER SKAPAS EN SESSION OCH ETT NYTT OBJEKT FÖR ATT VISA USERS NAMN
		if ($result->num_rows == 1) {
			while ($row = $result->fetch_assoc()){
				$_SESSION['username'] = $this->username;
				$object = new PrintPage();
				$object->printName($dbCon);
			}
		} 
		else {
			echo "Wrong username or password";
		}

	}

	//OM MAN HAR TRYCKT PÅ LOGOUT KNAPP UNSET SESSION OCH VISAS "YOU ARE LOGGED OUT"
	function logout() {
		session_unset();
		return "You are logged out";
	}
}