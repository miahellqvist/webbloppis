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

	function logout() {
		session_unset();
		echo "You are logged out";
	}
}