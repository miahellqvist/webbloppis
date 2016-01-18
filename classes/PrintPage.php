<?php

class PrintPage {

	//SKRIVER UT REGISTRERINGS-FORMULÄR
	function createAccountForm($dbCon) {
		//Medlemskap		
		$query = "SELECT * FROM membership";
		if($result = $dbCon->query($query)){

			while ($row = $result->fetch_assoc()) {
				$returns[]=$row;
			}
		}

		//Län		
		$query = "SELECT * FROM state";
		if($result = $dbCon->query($query)){
			while ($row = $result->fetch_assoc()) {
				$returns[]=$row;
			} 	
		}
		return $returns;	
  	}


	//SKRIVER UT ANNONS-INLÄGGNING-FORMULÄR
	function newProductForm($dbCon){
		//Kategori -- kommer ändras
		$query = "SELECT * FROM category";
		if($result = $dbCon->query($query)){
			while ($row = $result->fetch_assoc()) {
				$returns[]=$row;
			}
		}
		//Underkategori
		$query = "SELECT * FROM subcategory";
		if($result = $dbCon->query($query)) {
			while ($row = $result->fetch_assoc()) {
				$returns[]=$row;
			}
		}
		//Län		
		$query = "SELECT * FROM state";
		if($result = $dbCon->query($query)) {
			while ($row = $result->fetch_assoc()) {
				$returns[]=$row;
			}
		}
		return $returns;
	}

	//Visar säljarens egna annonser med bild, rubrik och pris på den personliga sidan
	function viewPersonalAds($dbCon, $query){

		$html="";	
		if ($result = $dbCon->query($query->getPersonalProducts($dbCon)))
		{
			while ($row = $result->fetch_assoc())
			{
				$items[]=$row;
			}
			return $items;
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

			if(mysqli_num_rows($result)>0){
				while ($row = $result->fetch_assoc())
				{				
					$items[]=$row;
				}
				return $items;
			}
			else{
				echo "Ingen annons funnen.";
			}
		}	
	}

}