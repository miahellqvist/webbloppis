<?php

class User {
	
	function createAccount($dbCon) {
		$html="";
		$name = $dbCon->real_escape_string($_POST['name']);
		$username = $dbCon->real_escape_string($_POST['username']);
		$password = $dbCon->real_escape_string($_POST['password']);
		$membership = $dbCon->real_escape_string($_POST['membership']);
		$adress = $dbCon->real_escape_string($_POST['adress']);
 		$zip_code = $dbCon->real_escape_string($_POST['zip_code']);
 		$city = $dbCon->real_escape_string($_POST['city']);
 		$state = $dbCon->real_escape_string($_POST['state']);
 		$email = $dbCon->real_escape_string($_POST['email']);
 		$phone = $dbCon->real_escape_string($_POST['phone']);
		$date = date("Y-m-d h:i:s");
		
		$options = [
		    'cost' => 11
		];
		$hash = password_hash($password, PASSWORD_BCRYPT, $options);

		$queryUsernameExists = ("SELECT * FROM user WHERE email='$email'");
		$result = $dbCon->query($queryUsernameExists);

		if ($row = $result->fetch_assoc()) {
			$html .="E-post addressen används redan.";
		} 
		else{
			$query = "INSERT INTO user
					(name, username, password, adress, zip_code, city, state, email, phone, date, type_membership_id)
	 				VALUES ('$name','$username', '$hash', '$adress', '$zip_code', '$city', '$state', '$email', '$phone', '$date', '$membership')";
			$dbCon->query($query);

			mkdir('upload/'.$_POST['username']);
			$html .="Ditt konto har skapats!";
		}
		return $this->html=$html;
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
		} else {
		    echo 'Fel användarnamn eller lösenord.';
		}
	}
	//OM MAN HAR TRYCKT PÅ LOGOUT KNAPP UNSET SESSION OCH VISAS "YOU ARE LOGGED OUT"
	function logout() {
		session_unset();
		return "Du har loggat ut!";
	}
}