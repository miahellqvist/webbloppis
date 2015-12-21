<?php
include_once('Connection.php');

class User {

	private $id, $username, $password;

	function login() {
		$dbCon = Connection::getInstance();
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
				echo "Welcome ".$row['name'];
			}
		} 
		else{
			echo "Wrong username or password";
		}

	}
}