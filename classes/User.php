<?php

class User {

	public function createAccount($dbCon) {
		

		$name = $dbCon->real_escape_string($_POST['name']);
		$username = $dbCon->real_escape_string($_POST['username']);
		$password = $dbCon->real_escape_string($_POST['password']);
		$date = date("Y-m-d h:i:s");
		$membership = $dbCon->real_escape_string($_POST['membership']);
		$adress = $dbCon->real_escape_string($_POST['adress']);
		$county = $dbCon->real_escape_string($_POST['county']);
		$email = $dbCon->real_escape_string($_POST['email']);
		$telephone = $dbCon->real_escape_string($_POST['telephone']);

		//$salt = $username;
		$salt = '123';
		$password_db = hash('sha256', $salt.$password);

		$query = "INSERT INTO user
				(name, username, password, date, type_membership_id, adress, county, email, telephone)
				VALUES ('$name','$username', '$password', '$date', '$membership', '$adress', '$county', '$email', '$telephone')";	

		$dbCon->query($query);
		echo "Account Created!";
	}

	public function login($dbCon) {
	
		$username = $dbCon->real_escape_string($_POST['username']);
		$password = $dbCon->real_escape_string($_POST['password']);
		$query = "
			SELECT * 
			FROM user 
			WHERE username = '$username' 
			AND password = '$password'
		";
		$result = $dbCon->query($query);

		//OM USERNAME OCH PASSWORD STÄMMER SKAPAS EN SESSION OCH ETT NYTT OBJEKT FÖR ATT VISA USERS NAMN
		if ($row = $result->fetch_assoc()) {
			$_SESSION['username'] = $username;
			$object = new PrintPage();
			$object->printName($dbCon);
		} 
		else {
			echo "Wrong username or password";
		}

	}

	//OM MAN HAR TRYCKT PÅ LOGOUT KNAPP UNSET SESSION OCH VISAS "YOU ARE LOGGED OUT"
	public function logout() {
		session_unset();
		return "You are logged out";
	}
}