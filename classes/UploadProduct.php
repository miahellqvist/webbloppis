<?php
class UploadProduct {

	//FUNKAR EJ -- ska ej vara här
	function countProducts($dbCon){
		$username = $_SESSION['username'];
		$query="SELECT user.user_id FROM user WHERE username='$username'";
		$result = $dbCon->query($query);
		$row = $result->fetch_assoc();
		$user_id=$row['user_id'];
		$query2= "SELECT count(product.product_id) AS count
			FROM product, user
			WHERE user.user_id=product.user_id
			AND user.user_id= '$user_id'
			Group by user.user_id";
		$result2 = $dbCon->query($query2);
		$row = $result2->fetch_assoc();
		$count=$row['count'];
		$query3= "SELECT membership.membership_limit 
			FROM membership, user 
			WHERE user.type_membership_id=membership.membership_name
			AND user.username='$username'";
		$result3 = $dbCon->query($query3);
		$row = $result3->fetch_assoc();
		$limit=$row['membership_limit'];
		$html="";
		$html.= "Antal produkter: ".$count. " Gräns: ".$limit;
		if($count>$limit)
		{
			return false;
		}
		else
		{
			return true;
		}
	}

	//Lägger till en produktannons med text och bild
	function addProduct($dbCon){
		if (isset($_POST['add'])) {
			$username = $dbCon->real_escape_string($_SESSION['username']);
			// Kollar efter fel
			if($_FILES['file']['error'] > 0){
			   die('Fel vid uppladdning.');
			}
			// Kollar filstorlek – maxstorlek 6 mb
			elseif($_FILES['file']['size'] > 6291456){
			    die('Bilden överskrider maxstorleken.');
			}
			// Kollar om bilden redan finns
			elseif(file_exists('upload/' .$username.'/'. $_FILES['file']['name'])){
			    die('Bilden är redan uppladdad.');
			}
			// Kollar att det är rätt filtyp (png, jpg, jpeg eller gif)
			elseif($_FILES['file']['type'] == 'image/png' || $_FILES['file']['type'] == 'image/PNG' || $_FILES['file']['type'] == 'image/jpg' || $_FILES['file']['type'] == 'image/jpeg' || $_FILES['file']['type'] == 'image/gif'){
				
				//Den uppladdade bilden placeras i mappen användarens mapp i upload
				$uploadfile = move_uploaded_file($_FILES['file']['tmp_name'], 'upload/'.$username.'/'.$_FILES['file']['name']);
				$product_title = $dbCon->real_escape_string($_POST['title']);
				$product_text = $dbCon->real_escape_string($_POST['text']);
				$product_price = $dbCon->real_escape_string($_POST['price']);
				$image_name = $username.'/'.$_FILES['file']['name'];
				$image_type = $_FILES['file']['type'];
				$image_size = $_FILES['file']['size'];
				$product_category = $dbCon->real_escape_string($_POST['category']);
				$product_subcategory = $dbCon->real_escape_string($_POST['subcategory']);
				$username=$_SESSION['username'];
				$query1="SELECT user_id FROM user WHERE username='$username'";
				$result = $dbCon->query($query1);
				$row = $result->fetch_assoc();
				$user_id = $row['user_id'];
				$state = $dbCon->real_escape_string($_POST['state']);
			   	
			   	//Lägger in i databasen
			   	//Jag var tvungen att ändra date_added till date för att få koden att skrivas ut
				$query = ("INSERT INTO product
							(title, text, price, image_name, image_type, image_size, category, subcategory, date_added, user_id, state_id)
							VALUES 
							('$product_title', '$product_text', '$product_price', '$image_name', '$image_type', '$image_size', 
								'$product_category', '$product_subcategory', CURRENT_TIMESTAMP, '$user_id', '$state')");
				$dbCon->query($query);
				// Uppladdning av fil
				if($uploadfile && $query){
					die('Uppladdningen lyckades!');
					header('Location:Index.php');
				}else if(!$uploadfile){
					die('Uppladdningen misslyckades');
				}else if(!$query){
					die('Bilden är inte sparad');
				}
			}
			else
			{
				die('Se till att det är en bild som laddas upp. Godkända filtyper är jpg, jpeg, gif och png.');
			}
		}
	}

	//Visar hela annonsen -- ska ej vara här (gallery)
	function viewProductAdd($dbCon, $query){
		if ($result = $dbCon->query($query->showFullProduct($dbCon)))
		{
			while ($row = $result->fetch_assoc())
			{
				$items[]=$row;
			}
			return $items;
		}
		else
		{
			return "Inga annonser";
		}
	}
	
	//visar alla annonser som tillhör kategorin -- ska ej vara här (galleri)
	function printCategoryProducts($dbCon, $query){
		$html="";
		if ($result = $dbCon->query($query->getProductsByCategory($dbCon)))
		{
			while ($row = $result->fetch_assoc())
			{
				$items[]=$row;
			}
			return $items;
		}
	}
	//visar alla annonser som tillhör subkategorien -- ska ej vara här
	function printSubcategoryProducts($dbCon, $query){
		$html="";
		if ($result = $dbCon->query($query->getProductsBySubcategory($dbCon)))
		{
			while ($row = $result->fetch_assoc())
			{
				$items[]=$row;
			}
			return $items;
		}
	}
	//visar alla annonser som tillhör län -- ska ej vara här (print)
	function printStateProducts($dbCon, $query){
		if ($result = $dbCon->query($query->getProductsByState($dbCon)))
		{
			while ($row = $result->fetch_assoc())
			{	
				$items[]=$row;
			}
			return $items;
		}
	}

	//Skriver alla annonser från en säljare (print)
	function printUserProducts($dbCon, $query){
		if ($result = $dbCon->query($query->getUserProducts($dbCon)))
		{
			while ($row = $result->fetch_assoc())
			{
				$items[]=$row;
			}
			return $items;
		}
	}

	//Visar annonsens bild, rubrik och pris – till startsidan
	function printProductThumbnail($dbCon, $query){
		if ($result = $dbCon->query($query->getProductThumbnail()))
		{
			while ($row = $result->fetch_assoc())
			{
				$items[]=$row;
			}
			return $items;
		}
	}
}