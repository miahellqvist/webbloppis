<?php

class PrintPage {

	//SKRIVER UT LOGIN FORMULÄR
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
			return "Welcome ".$row['name'];
		}
	}

	//SKRIVER UT LOGOUT-FORMULÄR
	function printLogoutForm() {
		return 
			"<form action='' method='post'>
				<input type='submit' name='logout' value='Logga ut'>
			</form>";
	}

	function createAccountForm() {
		return
			"<form action='' method='post'>
				Namn: <input type='text' name='name' required> <br>
				Användarnamn: <input type='text' name='username' required> <br>
				Lösenord: <input type='password' name='password' required> <br>
				Medlemskap: 
				<select name='membership'>
					<option value='1'>Brons</option>
					<option value='2'>Silver</option>
					<option value='3'>Guld</option>
				</select> <br>
				Adress: <input type='text' name='adress' required> <br>
				Postnummer: <input type='text' name='zip_code' required> 
				Stad: <input type='text' name='city' required> <br>
				Län: 
				<select name='state' required>
					<option disabled selected>Välj län</option>
					<option value='Blekinge län'>Blekinge län</option>
					<option value='Dalarnas län'>Dalarnas län</option>
					<option value='Gotlands län'>Gotlands län</option>
					<option value='Gävleborgs län'>Gävleborgs län</option>
					<option value='Hallands län'>Hallands län</option>
					<option value='Jämtlands län'>Jämtlands län</option>
					<option value='Jönköpings län'>Jönköpings län</option>
					<option value='Kalmar län'>Kalmar län</option>
					<option value='Kronobergs län'>Kronobergs län</option>
					<option value='Norrbottens län'>Norrbottens län</option>
					<option value='Skåne län'>Skåne län</option>
					<option value='Stockholms län'>Stockholms län</option>
					<option value='Södermanlands län'>Södermanlands län</option>
					<option value='Uppsala län'>Uppsala län</option>
					<option value='Värmlands län'>Värmlands län</option>
					<option value='Västerbottens län'>Västerbottens län</option>
					<option value='Västernorrlands län'>Västernorrlands län</option>
					<option value='Västmanlands län'>Västmanlands län</option>
					<option value='Västra Götalands län'>Västra Götalands län</option>
					<option value='Örebro län'>Örebro län</option>
					<option value='Östergötlands län'>Östergötlands län</option>
				</select> <br>
				E-post: <input type='text' name='email' required> <br>
				Telefon: <input type='text' name='phone'> <br>
				<input type='submit' name='createAccount' value='Skapa konto'>
			</form>";
	}

	static function newProduct($row){
		return "
			<form action='product.php' method='post' enctype='multipart/form-data'>
				Önskad titel:<input type='text' name='titel'><br>
				Beskrivande text:<textarea name='text' cols='45' rows='6'></textarea><br>
				Önskat pris:<input type='number' name='pris'><br>
				Lägg till en bild:<input type='file' name='file'><br>
				<label for='select'>Välj kategori:</label>
				<select name='kategori'>
				<?php foreach ($row as $option);?>
				<option value='<?php echo $option->id;?>''>
				<?php echo $option->Kategori; ?></option>
				<?php endforeach;?>
				</select>
				Välj underkategori:
				<select name='Underkategori'>
				<?php foreach ($result as $option);?>
				<option value='<?php echo $option->id;?>''>
				<?php echo $option->Underkategori; ?></option>
				<?php endforeach;?>
				</select>
				<input type='hidden' name='user_id'>
				<input type='submit'  name='submit' value='Publicera annonsen'>
			</form>";		

	}
}
