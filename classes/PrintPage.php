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

	function newProduct($dbCon){
		$query = "SELECT * FROM category";
		$result = $dbCon->query($query);
		
		echo 
		"<form action='' method='post' enctype='multipart/form-data'>
			Önskad titel:<input type='text' name='titel'><br>
			Beskrivande text:<textarea name='text' cols='45' rows='6'></textarea><br>
			Önskat pris:<input type='number' name='pris'><br>
			Lägg till en bild:<input type='file' name='file'><br>
			Välj kategori:
			<select name='kategori'>
				<option value='0'>-- Select a category --</option>";
				while ($row = mysqli_fetch_assoc($result)) {
					echo "<option value='".$row['id']."'>".$row['category_name']."</option>";
				}
		echo"</select><br>
			Välj underkategori:
			<select name='Underkategori'>
				<option value='0'>-- Select an undercategory --</option>
			</select><br>
			<input type='hidden' name='user_id'>
			<input type='submit'  name='publicera' value='Publicera annonsen'>
		</form>";
	}
}