<?php

class User {

	function createAccount($dbCon) {

		$name = $dbCon->real_escape_string($_POST['name']);
		$username = $dbCon->real_escape_string($_POST['username']);
		$password = $dbCon->real_escape_string($_POST['password']);
		$adress = $dbCon->real_escape_string($_POST['adress']);
		$zip_code = $dbCon->real_escape_string($_POST['zip_code']);
		$city = $dbCon->real_escape_string($_POST['city']);
		$state = $dbCon->real_escape_string($_POST['state']);
		$email = $dbCon->real_escape_string($_POST['email']);
		$phone = $dbCon->real_escape_string($_POST['phone']);
		$date = date("Y-m-d h:i:s");
		$membership = $dbCon->real_escape_string($_POST['membership']);

		//$salt = $username;
		$salt = '123';
		$password_db = hash('sha256', $salt.$password);

		$query = "INSERT INTO user
				(name, username, password, adress, zip_code, city, state, email, phone, date, type_membership_id)
				VALUES ('$name','$username', '$password_db', '$adress', '$zip_code', '$city', '$state', '$email', '$phone', '$date', '$membership')";	
	
		$dbCon->query($query);
		echo "Account Created!";

	}

	function login($dbCon) {
	
		$username = $dbCon->real_escape_string($_POST['username']);
		$password = $dbCon->real_escape_string($_POST['password']);

		$salt = '123';
		$password_db = hash('sha256', $salt.$password);
		
		//PDO - PHP DATA OBJECT
		//Man får parameters istället för strängar, till exempel "password='$_POST['password']". Det är säkrare än SQL statements
		$query = $dbCon->prepare('SELECT id FROM user WHERE password = ? AND username = ?');

		//Binds variables to a prepared statement as parameters. "ss" representerar antalet "values", i det här fallet password och username. 
		$query->bind_param("ss", $password_db, $username);
 		$query->execute();

		//OM USERNAME OCH PASSWORD STÄMMER SKAPAS EN SESSION OCH GÅ TILL PRINTPAGE KLASS FÖR ATT VISA USERS NAMN
		if (!empty($query->fetch())) {
			$_SESSION['username'] = $username;
		} 
		else {
			echo "Fel användarnamn eller lösenord";
		}

	}

	//OM MAN HAR TRYCKT PÅ LOGOUT KNAPP UNSET SESSION OCH VISAS "YOU ARE LOGGED OUT"
	function logout() {
		session_unset();
		return "Du är utloggad";
	}
}