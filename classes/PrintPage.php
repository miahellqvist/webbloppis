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
