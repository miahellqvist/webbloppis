<?php

class User {

	function createAccount($dbCon) {
		$name = $dbCon->real_escape_string($_POST['name']);
		$username = $dbCon->real_escape_string($_POST['username']);
		$password = $dbCon->real_escape_string($_POST['password']);
		$date = date("Y-m-d h:i:s");
		$membership = $dbCon->real_escape_string($_POST['membership']);
		$adress = $dbCon->real_escape_string($_POST['adress']);
		$county = $dbCon->real_escape_string($_POST['county']);
		$email = $dbCon->real_escape_string($_POST['email']);
		$phone = $dbCon->real_escape_string($_POST['telephone']);

		$options = [
		    'cost' => 11,
		];

		$hash = password_hash($password, PASSWORD_BCRYPT, $options);

		$query = "INSERT INTO user
				(name, username, password, date, type_membership_id, adress, county, email, telephone)
				VALUES ('$name','$username', '$hash', '$date', '$membership', '$adress', '$county', '$email', '$phone')";	

		$dbCon->query($query);
		echo "Account Created!";
	}

	function login($dbCon) {
	
		$username = $dbCon->real_escape_string($_POST['username']);
		$password = $dbCon->real_escape_string($_POST['password']);
		$query = "
			SELECT *
			FROM user 
			WHERE username = '$username' 
		";

		//hämtar ut användarinfo
		$result = $dbCon->query($query);
		$row = $result->fetch_assoc();
		$getpassword= $row['password'];

		//Kollar om det hashade lösenordet stämmer överenst med det användaren skrivit in
		if (password_verify($password, $getpassword)) {
			$_SESSION['username'] = $username;
					$object = new PrintPage();
					$object->printName($dbCon);
		} else {
		    echo 'Invalid password.';
		}


	}

	//OM MAN HAR TRYCKT PÅ LOGOUT KNAPP UNSET SESSION OCH VISAS "YOU ARE LOGGED OUT"
	function logout() {
		session_unset();
		return "You are logged out";
	}
}