<?php

class PrintPage {

	//SKRIVER UT LOGOUT-FORMULÄR
	function printLogoutForm() {
		return 
			"<form action='' method='post'>
				<input type='submit' name='logout' value='Logga ut'>
			</form>";
	}

	//Knapp som visar Visa-alla-dina-annonser-formuläret när man är inloggad
	function showProductsButton() {
		return 
			"<form action='' method='post'>
				<input type='submit' name='showProducts' value='Visa alla dina annonser'>
			</form>";
	}

	function showAllAnnonsButton() {
		return 
			"<form action='' method='post'>
				<input type='submit' name='showAllAnnons' value='Visa alla annonser på sajten'>
			</form>";
	}

	//Knapp för att uppdatera personliga uppgifter
	function updatePersonalInfoButton() {
		return 
			"<form action='' method='post'>
				<input type='submit' name='update' value='Uppdatera mina personliga uppgifter'>
			</form>";
	}

	//Skriver ut Tillbaka-knapp när användaren tittar på alla sina annonser
	function goBackFromShowProductsButton() {
		return 
			"<form action='Index.php' method='post'>
				<input type='submit' name='goBack' value='<< Tillbaka'>
			</form>";

	}

	//SKRIVER UT REGISTRERINGS-FORMULÄR
	function createAccountForm($dbCon) {

		$html="";
		$state="";

		//Län		
		$query = "SELECT * FROM state";
		$result = $dbCon->query($query);

		while ($row2 = mysqli_fetch_assoc($result)) {
			$state.="<option value='".$row2['state_id']."'>".$row2['state_name']."</option>";
		}

  		$html.=
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

	 			Län:
				<select name='state' required>
				<option value='0'>-- Välj län --</option>".
				$state.
				"</select><br>

				E-mail: <input type='email' name='email' required> <br>
	 			Telefon: <input type='text' name='phone'> <br>
	 			<input type='submit' name='createAccount' value='Skapa konto'>
	 		</form>";
	 		return $this->html = $html;
  	}


	//SKRIVER UT ANNONS-INLÄGGNING-FORMULÄR
	function newProductForm($dbCon){

		$html="";
		$category="";
		$subcategory="";
		$state="";

		//Kategori
		$query1 = "SELECT * FROM category";
		$result1 = $dbCon->query($query1);

		while ($row = mysqli_fetch_assoc($result1)) {
			$category.="<option value='".$row['category_id']."'>".$row['category_name']."</option>";
		}

		//Underkategori
		$query2 = "SELECT * FROM subcategory";
		$result2 = $dbCon->query($query2);

		while ($row = mysqli_fetch_assoc($result2)) {
			$subcategory.="<option value='".$row['subcategory_id']."'>".$row['subcategory_name']."</option>";
		}

		//Län		
		$query3 = "SELECT * FROM state";
		$result3 = $dbCon->query($query3);

		while ($row = mysqli_fetch_assoc($result3)) {
			$state.="<option value='".$row['state_id']."'>".$row['state_name']."</option>";
		}
		

		$html.=
		"<form action='' method='post' enctype='multipart/form-data'>
			Önskad titel: <input type='text' name='title'><br>
			Beskrivande text: <textarea name='text' cols='45' rows='6'></textarea><br>
			Önskat pris: <input type='number' name='price'><br>
			Lägg till en bild: <input type='file' name='file'><br>

			Välj kategori:
				<select name='category'>
				<option value='0'>-- Välj en kategori --</option>".
				$category.
				"</select><br>

			Välj underkategori:
				<select name='subcategory'>
				<option value='0'>-- Välj en underkategori --</option>".
				$subcategory.
				"</select><br>

			Välj län:
				<select name='state'>
				<option value='0'>-- Välj ett län --</option>".
				$state.
				"</select><br>

			<input type='hidden' name='user_id'>
			<input type='submit'  name='submit' value='Publicera annonsen'>
			</form>
			";
		return $this->html = $html;
	}


	//Knapp som öppnar mailformuläret.
	function openMailform(){
		return "<form action='' method='post'>
					<input type='submit' name='writeemail' value='Skicka meddelande'>
				</form>";
	}

	//Mailformulär för att kontakta säljaren.
	function printMailform(){
		return "<form action='' method='post'>
					Ditt namn: 
					<input type='text' name='name' required autofocus><br>
					Din e-post: 
					<input type='email' name='email' required><br>
					Meddelande: 
					<textarea name='message' cols='45' rows='6'></textarea><br>
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
				$id=$row['product_id'];
				$html .= "".
				$row['title']." Pris: ".$row['price']." kr<br>
				<a href='?id=$id'><img src='upload/".$row['image_name']."' width='200' alt=''></a><br>
				";
			}
			return $this->html = $html;
		}
	}

	//Sökformulär
	function searchProductForm($dbCon){
		
		$html="";
		$category="";
		$state="";

		//Sök kategori
		$query = "SELECT * FROM category";
		$result = $dbCon->query($query);

		while ($row = mysqli_fetch_assoc($result)) {
			$category.="<option value='".$row['category_id']."'>".$row['category_name']."</option>";
		}

		//Sök Län		
		$query1 = "SELECT * FROM state";
		$result1 = $dbCon->query($query1);

		while ($row1 = mysqli_fetch_assoc($result1)) {
			$state.="<option value='".$row1['state_id']."'>".$row1['state_name']."</option>";
		}
		
		//Formuläret
		$html.="<form action='' method='post'>
				<input type='text' name='searchField' placeholder='Sök efter annons'>
				Välj kategori:
				<select name='category' id='category'>
				<option value='0'>-- Alla kategorier --</option>".
				$category.
				"</select>
				Välj län:
				<select name='state' id='state'>
				<option value='0'>-- Hela Sverige --</option>".
				$state.
				"</select>
				Sortera på:
				<select name='sort' id='sort'>
				<option value='0'>-- Alla annonser --</option>
				<option value='1'>Pris stigande</option>
				<option value='2'>Pris fallande</option>
				<option value='3'>Nyast först</option>
				<option value='4'>Äldst först</option>
				</select>
				<input type='submit' name='searchProduct' value='Sök'>
				</form>";
		return $this->html = $html;
	}

	//Sökresultatet
	function searchResult($dbCon, $query)
	{

		if ($result = $dbCon->query($query->searchProduct($dbCon)))
		{
			$html="";	

			if(mysqli_num_rows($result)>0){
				while ($row = $result->fetch_assoc())
				{
					$id=$row['product_id'];
					$html .= "".
					$row['title']." Pris: ".$row['price']." kr<br>
					<a href='?id=$id'><img src='upload/".$row['image_name']."' width='200' alt=''></a><br>
					";
					
				}
				return $this->html = $html;
			}
			else{
				$html="Ingen annons funnen.";
				return $this->html = $html;
			}	
		}	
	}

}