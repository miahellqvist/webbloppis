<?php

class PrintPage {

	//DET SKRIVER UT LOGIN FORMULÄR
	function printLoginForm() {
		return 
			"<form action='' method='post'>
				Username:<input type='text' name='username' /> <br>
				Password:<input type='password' name='password' /> <br>
				<input type='submit' name='login' value='Login'>
				<input type='submit' name='newAccount' value='Create new account'>
			</form>";
	}

	//DET SKRIVER UT USERS NAMN
	function printName($dbCon) {
		
		if (isset($_SESSION['username'])) {
			$username = $_SESSION['username'];
			$query = "
				SELECT * 
				FROM user 
				WHERE username = '$username'
			";
			$result = $dbCon->query($query);

			$row = $result->fetch_assoc();
			return "Welcome ".$row['name'];
		}
	}

	//DET SKRIVER UT LOGOUT FORMULÄR
	function printLogoutForm() {
		return 
			"<form action='' method='post'>
				<input type='submit' name='logout' value='Logout'>
			</form>";
	}

	function createAccountForm() {
		return
			"<form action='' method='post'>
				Name:<input type='text' name='name' required/> <br>
				Username:<input type='text' name='username' required/> <br>
				Password:<input type='password' name='password' required/> <br>
				Membership: 
				<select name='membership'>
					<option value='1'>Bronze</option>
					<option value='2'>Silver</option>
					<option value='3'>Gold</option>
				</select> <br>
				<input type='submit' name='createAccount' value='Create'>
			</form>";
	}
}