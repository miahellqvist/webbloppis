<?php

class PrintPage {

	//DET SKRIVER UT LOGIN FORMULÄR
	public function printLoginForm() {
		return 
			"<form action='' method='post'>
				Username:<input type='text' name='username' /> <br>
				Password:<input type='password' name='password' /> <br>
				<input type='submit' name='login' value='Login'>
				<input type='submit' name='newAccount' value='Create new account'>
			</form>";
	}

	//DET SKRIVER UT USERS NAMN
	public function printName($dbCon) {
		
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
	public function printLogoutForm() {
		return 
			"<form action='' method='post'>
				<input type='submit' name='logout' value='Logout'>
			</form>";
	}

	public function createAccountForm() {
		return
			"<form action='' method='post'>
				Name:<input type='text' name='name' required> <br>
				Username:<input type='text' name='username' required> <br>
				Password:<input type='password' name='password' required> <br>
				Membership: 
				<select name='membership'>
					<option value='1'>Bronze</option>
					<option value='2'>Silver</option>
					<option value='3'>Gold</option>
				</select> <br>
				Adress:<input type='text' name='adress' required> <br>
				Län:<input type='text' name='county' required> <br>
				E-post:<input type='text' name='email' required> <br>
				Telefon:<input type='text' name='telephone'> <br>
				<input type='submit' name='createAccount' value='Create'>
			</form>"; //TELEFON SKA INTE VARA TVINGANDE SÅ JAG TOG BORT REQUIRED FÖR DEN.
	}
}