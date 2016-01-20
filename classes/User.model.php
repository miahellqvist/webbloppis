<?php

class UserModel {

	public static function checkLogin($username, $password) {
		$dbCon= Connection::connect();

		$cleanUsername=$dbCon->real_escape_string($username);
		$cleanPassword=$dbCon->real_escape_string($password);

		//hämtar ut användarinfo
		$query = "
			SELECT user_id, name, username, password
			FROM user 
			WHERE username = '$cleanUsername' 
		";
		
		$result = $dbCon->query($query);
		$user = $result->fetch_assoc();
		$getpassword= $user['password'];

		//Kollar om det hashade lösenordet stämmer överens med det användaren skrivit in
		if (password_verify($cleanPassword, $getpassword)) {
			$_SESSION['user']['user_id'] = $user['user_id'];
			$_SESSION['user']['name'] = $user['name'];
			$_SESSION['user']['username'] = $user['username'];
			
			return true;
		} 
		else {

		   throw new Exception('Fel användarnamn eller lösenord.');
		}

	}
	public static function getMemberships() {		
		$dbCon= Connection::connect();
		$query = "SELECT * FROM membership";
		$memberships = array();
		if($result = $dbCon->query($query)){

			while ($membership = $result->fetch_assoc()) {
				$memberships[]=$membership;
			}
		} else {
			die($dbCon->error);
		}
		return $memberships;
	}
	public static function getStates() {
		$dbCon= Connection::connect();
		$states = array();
		$query = "SELECT * FROM state";
		if($result = $dbCon->query($query)){
			while ($state = $result->fetch_assoc()) {
				$states[]=$state;
			} 	
		} else {
			die($dbCon->error);
		}
		return $states;
	}
	public static function register($username,$password,$name,$membership,$state,$email,$adress,$zip_code,$phone,$city) {
		$dbCon= Connection::connect();

		$cleanName = $dbCon->real_escape_string($name);
		$cleanUsername = $dbCon->real_escape_string($username);
		$cleanPassword = $dbCon->real_escape_string($password);
		$cleanMembership = $dbCon->real_escape_string($membership);
		$cleanAdress = $dbCon->real_escape_string($adress);
 		$cleanZip_code = $dbCon->real_escape_string($zip_code);
 		$cleanCity = $dbCon->real_escape_string($city);
 		$cleanState = $dbCon->real_escape_string($state);
 		$cleanEmail = $dbCon->real_escape_string($email);
 		$cleanPhone = $dbCon->real_escape_string($phone);
		$date = date("Y-m-d h:i:s");
		
		$options = [
		    'cost' => 11
		];
		$hash = password_hash($cleanPassword, PASSWORD_BCRYPT, $options);

		$queryUsernameExists = ("SELECT * FROM user WHERE username='$username' OR email='$email'");
		$result = $dbCon->query($queryUsernameExists);
		
		if ($result->num_rows > 0) {
			die("Användarnamnet eller e-post addressen används redan.");
		} 
		else{
			$query = "INSERT INTO user
					(name, username, password, adress, zip_code, city, state, email, phone, date, type_membership_id)
	 				VALUES ('$cleanName','$cleanUsername', '$hash', '$cleanAdress', '$cleanZip_code', '$cleanCity', '$cleanState', '$cleanEmail', '$cleanPhone', '$date', '$cleanMembership')";
			$dbCon->query($query);

			mkdir('upload/'.$_POST['username']);
			return true;
		}
		
	}
}
