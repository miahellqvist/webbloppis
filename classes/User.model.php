<?php

class UserModel {

	//Verifierar lösenord och användarnamn och skapar en Session ifall de stämmer med databasen
	public static function checkLogin($username, $password) {
		$dbCon= Connection::connect();

		$cleanUsername=$dbCon->real_escape_string($username);
		$cleanPassword=$dbCon->real_escape_string($password);

		//hämtar ut användarinfo
		$query = "SELECT user_id, name, username, password
			FROM user 
			WHERE username = '$cleanUsername'";
		
		$result = $dbCon->query($query);
		$user = $result->fetch_assoc();
		$getpassword= $user['password'];

		//Kollar om det hashade lösenordet stämmer överens med det användaren skrivit in
		if (password_verify($cleanPassword, $getpassword)) {
			$_SESSION['user']['user_id'] = $user['user_id'];
			$_SESSION['user']['username'] = $user['username'];
			$_SESSION['user']['name'] = $user['name'];
			
			return $user;
		} 
		else {
		   throw new Exception('Fel användarnamn eller lösenord.');
		}
	}

	//Hämtar alla medlemsskapsnivåer från databas 
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

//Hämtar alla län från databasen
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

//Tvättar och lägger in uppgifter från completeRegister i databas
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
					(name, username, password, adress, zip_code, city, state, email, phone, date, type_membership)
	 				VALUES ('$cleanName','$cleanUsername', '$hash', '$cleanAdress', '$cleanZip_code', '$cleanCity', '$cleanState', '$cleanEmail', '$cleanPhone', '$date', '$cleanMembership')";
			$dbCon->query($query);

			mkdir('upload/'.$_POST['username']);
			return true;
		}
		
	}

//Hämtar användaruppgifter från databas
	public static function getPersonalData(){
		$dbCon=Connection::connect();
		$user_id=$_SESSION['user']['user_id'];

		$query = ("SELECT name, user_id, adress, zip_code, 
			city, email, phone, state, state_name
			FROM user, state
			WHERE user_id='$user_id'
			AND user.state=state.state_id");

		if ($result = $dbCon->query($query)) {
  			$user = $result->fetch_assoc();
  			return $user;
  		}
	}

//Hämtar och tvättar uppgifter från completePersonalUpdate och uppdaterar användaruppgifter
	public static function updatePersonal($name,$state,$email,$adress,$zip_code,$phone,$city){
		$dbCon= Connection::connect();
		$user_id=$_SESSION['user']['user_id'];
		$cleanName = $dbCon->real_escape_string($name);
		$cleanAdress = $dbCon->real_escape_string($adress);
 		$cleanZip_code = $dbCon->real_escape_string($zip_code);
 		$cleanCity = $dbCon->real_escape_string($city);
 		$cleanState = $dbCon->real_escape_string($state);
 		$cleanEmail = $dbCon->real_escape_string($email);
 		$cleanPhone = $dbCon->real_escape_string($phone);
		$query = ("
			UPDATE user
			SET name='$cleanName', adress='$cleanAdress', zip_code='$cleanZip_code', city='$cleanCity', 
				state='$cleanState', email='$cleanEmail', phone='$cleanPhone'
			WHERE user.user_id='$user_id'
			");
		$result=$dbCon->query($query);
		return true;
	}
//När betalningen är gjord uppdateras databasen med 'true' på membership_paid
	public static function updatePaidMembership(){
		$dbCon= Connection::connect();
		$user_id=$_SESSION['user']['user_id'];
		$query = "UPDATE user
					SET membership_paid = 'true'
					WHERE user.user_id='$user_id'";
		$result=$dbCon->query($query);
		return true;
	}
//Kollar om medlemskapet är betalt
	public static function checkIfMembershipPaid(){
		$dbCon=Connection::connect();
		$user_id=$_SESSION['user']['user_id'];
		$query = "SELECT user_id, membership_paid  FROM user
					WHERE user.user_id='$user_id'
					AND membership_paid = 'true'";

		$result=$dbCon->query($query);

		if ($result=$dbCon->query($query)) {
  			$pay = $result->fetch_assoc();
  			return $pay;
  		}
	}
//Hämtar användarens medlemskapsnivå
	public static function getUserMembership(){
		$dbCon=Connection::connect();
		$user_id=$_SESSION['user']['user_id'];
		$query = "SELECT type_membership FROM user
					WHERE user.user_id='$user_id'";

		$result=$dbCon->query($query);

		if ($result=$dbCon->query($query)) {
  			$type_memberships = $result->fetch_assoc();
  			foreach ($type_memberships as $type_membership) {
  				$type_membership;
  			}	
  		}
  		return $type_membership;
	}
}
