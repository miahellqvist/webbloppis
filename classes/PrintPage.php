<?php

class PrintPage {

	//SKRIVER UT LOGIN-FORMULÄR
	function printLoginForm() {
		return 
			"<form action='' method='post'>
				Användarnamn: <input type='text' name='username' /> <br>
				Lösenord: <input type='password' name='password' /> <br>
				<input type='submit' name='login' value='Logga in'>
				<input type='submit' name='newAccount' value='Skapa nytt konto'>
			</form>";
	}

	//SKRIVER UT ANVÄNDARENS NAMN
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
			return "Välkommen ".$row['name'];
		}
	}

	//SKRIVER UT LOGOUT-FORMULÄR
	function printLogoutForm() {
		return 
			"<form action='' method='post'>
				<input type='submit' name='logout' value='Logga ut'>
			</form>";
	}

	//SKRIVER UT REGISTRERINGS-FORMULÄR
	function createAccountForm($dbCon) {

		$query = "SELECT * FROM state";
		$result = $dbCon->query($query);

  		echo
  			"<form action='' method='post'>

 			Namn: <input type='text' name='name' required> <br>

 			Användarnamn: <input type='text' name='username' required> <br>

 			Lösenord: <input type='password' name='password' required> <br>

 			Medlemskap: 
	  			<select name='membership' required>
	  				<option disabled selected>Välj medlemskap</option>
	 				<option value='Brons'>Brons</option>
	  				<option value='Silver'>Silver</option>
	 				<option value='Guld'>Guld</option>
	 			</select> <br>

 			Adress: <input type='text' name='adress' required> <br>

 			Postnummer: <input type='text' name='zip_code' required> <br>
 			
 			Stad: <input type='text' name='city' required> <br>

 			Län: <select name='state' required>
					<option value='0'>-- Välj län --</option>";

					while ($row1 = mysqli_fetch_assoc($result)) {
						echo "<option value='".$row1['id']."'>".$row1['state']."</option>";
					}

				echo "</select><br>

 			E-mail: <input type='text' name='email' required> <br>

 			Telefon: <input type='text' name='phone'> <br>

 			<input type='submit' name='createAccount' value='Skapa konto'>
 		</form>";
  	}


	//SKRIVER UT ANNONS-INLÄGGNING-FORMULÄR
	function newProduct($dbCon){
		$query1 = "SELECT * FROM category";
		$result1 = $dbCon->query($query1);

		$query2 = "SELECT * FROM subcategory";
		$result2 = $dbCon->query($query2);
		
		echo 
		"<form action='product.php' method='post' enctype='multipart/form-data'>
			Önskad titel: <input type='text' name='title'><br>
			Beskrivande text: <textarea name='text' cols='45' rows='6'></textarea><br>
			Önskat pris: <input type='number' name='price'><br>
			Lägg till en bild: <input type='file' name='file'><br>
			Välj kategori:
			<select name='category'>
				<option value='0'>-- Välj en kategori --</option>";

				while ($row1 = mysqli_fetch_assoc($result1)) {
					echo "<option value='".$row1['id']."'>".$row1['category_name']."</option>";
				}

		echo"</select><br>
			Välj underkategori:
			<select name='subcategory'>
				<option value='0'>-- Välj en underkategori --</option>";

				while ($row2 = mysqli_fetch_assoc($result2)) {
					echo "<option value='".$row2['id']."'>".$row2['subcategory_name']."</option>";
				}

		echo"</select><br>
			<input type='hidden' name='user_id'>
			<input type='submit'  name='submit' value='Publicera annonsen'>
		</form>";
	}
}
