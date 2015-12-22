<?php

class PrintPage {

	//DET SKRIVER UT LOGIN FORMULÄR
	function printLoginForm() {
		echo 
			'<form action="" method="post">
				Username:<input type="text" name="username" /> <br>
				Password:<input type="password" name="password" /> <br>
				<input type="submit" name="login" value="Login">
				<input type="submit" name="logout" value="Logout">
			</form>';
	}

	//DET SKRIVER UT USERS NAMN OCH LOG OUT KNAPP
	function printName($dbCon) {
		
		if (isset($_SESSION['username'])) {
			$username = $dbCon->real_escape_string($_POST['username']);
			$query = "
				SELECT * 
				FROM user 
				WHERE username = '$username'
			";
			$result = $dbCon->query($query);

			if ($result->num_rows == 1) {
				while ($row = $result->fetch_assoc()){
					echo "Welcome ".$row['name'];
					echo 
					'<form action="" method="post">
						<input type="submit" name="logout" value="Logout">
					</form>';
				}
			} 
			
		}
	}
}