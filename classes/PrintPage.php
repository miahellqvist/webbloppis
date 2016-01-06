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
		
			$username = $dbCon->real_escape_string($_SESSION['username']);
			$query = "
				SELECT *
				FROM user 
				WHERE username = '$username'
			";
			$result = $dbCon->query($query);
			$row = $result->fetch_assoc();
			return "Välkommen ".$row['name'];
	}

	//SKRIVER UT LOGOUT-FORMULÄR
	function printLogoutForm() {
		return 
			"<form action='' method='post'>
				<input type='submit' name='logout' value='Logga ut'>
			</form>";
	}

	//Knapp som visar Visa-alla-dina-annonser-formuläret när man är inloggad
	function printShowProductsForm() {
		return 
			"<form action='' method='post'>
				<input type='submit' name='showProducts' value='Visa alla dina annonser'>
			</form>";
	}

	//Skriver ut Tillbaka-knapp när användaren tittar på alla sina annonser
	function printGoBackFromShowProductsForm() {
		return 
			"<form action='' method='post'>
				<input type='submit' name='goBack' value='<< Tillbaka'>
			</form>";
	}

	//SKRIVER UT REGISTRERINGS-FORMULÄR
	function createAccountForm($dbCon) {
	  		return
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
	 			Stad: <input type='text' name='city' required> <br>";
	}

	function createAccountForm2($dbCon) {
	 		return
	 			"E-mail: <input type='email' name='email' required> <br>
	 			Telefon: <input type='text' name='phone'> <br>
	 			<input type='submit' name='createAccount' value='Skapa konto'>
	 		</form>";
  	}

  	function stateMenu($dbCon){
		$html="";
		$html2="";
		$query = "SELECT * FROM state";
		$result = $dbCon->query($query);

		while ($row1 = mysqli_fetch_assoc($result)) {
			$html.="". "<option value='".$row1['state_id']."'>".$row1['state_name']."</option>";
		}
		
		$html2.="".
		"Län:
		<select name='state' required>
				<option value='0'>-- Välj län --</option>".
				$html.
		"</select><br>";
		return $html2;
	}

	//SKRIVER UT ANNONS-INLÄGGNING-FORMULÄR
	function newProductForm($dbCon){

		return 
		"<form action='' method='post' enctype='multipart/form-data'>
			Önskad titel: <input type='text' name='title'><br>
			Beskrivande text: <textarea name='text' cols='45' rows='6'></textarea><br>
			Önskat pris: <input type='number' name='price'><br>
			Lägg till en bild: <input type='file' name='file'><br>";
	}

	function newProductForm2($dbCon){
		return	
			"<input type='hidden' name='user_id'>
			<input type='submit'  name='submit' value='Publicera annonsen'>
		</form>";
	}

	function categoryMenu($dbCon){

		$html="";
		$html2="";
		$query1 = "SELECT * FROM category";
		$result1 = $dbCon->query($query1);

		while ($row1 = mysqli_fetch_assoc($result1)) {
					$html.="". "<option value='".$row1['category_id']."'>".$row1['category_name']."</option>";
				}
		
		$html2.="".
		"Välj kategori:
		<select name='category'>
				<option value='0'>-- Välj en kategori --</option>".
				$html.
		"</select><br>";
		return $html2;
	}

	function subcategoryMenu($dbCon){

		$html="";
		$html2="";
		$query2 = "SELECT * FROM subcategory";
		$result2 = $dbCon->query($query2);

		while ($row2 = mysqli_fetch_assoc($result2)) {
					$html.="". "<option value='".$row2['subcategory_id']."'>".$row2['subcategory_name']."</option>";
				}
		
		$html2.="".
		"Välj underkategori:
		<select name='subcategory'>
				<option value='0'>-- Välj en underkategori --</option>".
				$html.
		"</select><br>";

		return $html2;
	}

	//Knapp som öppnar mailformuläret.
	function openMailform(){
		return "<form action='' method='post'>
					<input type='submit' name='sendmail' value='Skicka meddelande'>
				</form>";
	}

	//Mailformulär för att kontakta säljaren.
	function printMailform(){
		return "<form action='' method='post'>
				Ditt namn: 
				<input type='text' name='sendername' required autofocus><br>
				Din e-post: 
				<input type='email' name='senderemail' required><br>
				Ärende: 
				<input type='text' name='subject' required><br>
				Meddelande: 
				<textarea name='message' cols='45' rows='6'></textarea><br>
				<input type='hidden' name='receiveremail'>
				<input type='submit' name='send' value='Skicka'>
				</form>";
	}

	//Visar säljarens egna annonser med bild, rubrik och pris på den personliga sidan
	function viewPersonalAds($dbCon, $query){

		$html="";	
		if ($result = $dbCon->query($query->showPersonalProduct($dbCon)))
		{
			while ($row = $result->fetch_assoc())
			{
				$id=$row['image_name'];
				$html .= "".
				$row['title']." Pris: ".$row['price']." kr<br>
				<img src='upload/".$row['image_name']."' width='200' alt=''><br>
				";
			}
			return $this->html = $html;
		}
	}
}
