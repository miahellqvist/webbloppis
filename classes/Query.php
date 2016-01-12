<?php

class Query{

	//Hämtar kategorierna
	function chooseCategory()
	{
		$query = ("SELECT * FROM category");
		 return $this->query = $query;
	}

	//Hämtar underkategorierna
	function chooseSubCategory()
	{
		$query = ("SELECT * FROM subcategory");
		 return $this->query = $query;
	}

	//Hämtar användarens user_id
	function getUserid()
	{
		$query = ("SELECT user_id FROM user WHERE user.user_id='$user_id' LIMIT 1");
		 return $this->query = $query;
	}

	//Hämtar all data i product-tabellen (annonsen)
	function showMinimizedProductAd()
	{
		$query = ("SELECT * FROM product ORDER BY date_added DESC");
		return $this->query = $query;
	}

	//Hämtar all data i product-tabellen (annonsen) samt deklarerar bildens namn som GET-id
	function showFullProductAd($dbCon)
	{
		$id=$dbCon->real_escape_string($_GET['id']);
		$query = ("SELECT * FROM product, category, subcategory, state, user
					WHERE product.product_id='$id'
					AND product.category=category.category_id
					AND product.subcategory=subcategory.subcategory_id
					AND user.state=state.state_id
					AND product.user_id=user.user_id");
		return $this->query = $query;
	}
	
	function showProductsByCategory($dbCon)
	{
		$category_id=$dbCon->real_escape_string($_GET['category']);
		$query = ("SELECT * FROM category, product
					WHERE product.category=category.category_id
					AND category.category_id='$category_id'
					ORDER BY date_added DESC");
		return $this->query = $query;
	}
	
	function showProductsBySubcategory($dbCon)
	{
		$subcategory_id=$dbCon->real_escape_string($_GET['subcategory']);
		$query = ("SELECT * FROM subcategory, product
					WHERE product.subcategory=subcategory.subcategory_id
					AND subcategory.subcategory_id='$subcategory_id'
					ORDER BY date_added DESC");
		return $this->query = $query;
	}
	
	function showProductsByState($dbCon)
	{
		$state_id=$dbCon->real_escape_string($_GET['state']);
		$query = ("SELECT *
					FROM state, user, product
					WHERE user.state=state.state_id
					AND state.state_id='$state_id'
					AND product.user_id=user.user_id
					ORDER BY product.date_added DESC");
		return $this->query = $query;
	}
	
	//Visar en säljares alla annonser
	function showProfile($dbCon)
	{
		$user_id=$dbCon->real_escape_string($_GET['user_id']);
		$query = ("SELECT * FROM user, product
					WHERE user.user_id='$user_id'
					AND product.user_id=user.user_id
					ORDER BY product.date_added DESC");
		return $this->query = $query;
	}

	//Hämtar ut säljarens e-post.
	function getUsermail($dbcon)
	{
		$id=$dbCon->real_escape_string($_GET['id']);
		$query =("SELECT user.email FROM user WHERE user.id = '$id'");
		return $this->query = $query;
	}

	//Hämtar användarens annonser i inloggat läge
	function showPersonalProduct($dbCon)
	{
		$username = $dbCon->real_escape_string($_SESSION['username']);
		$query = ("SELECT *  FROM product, user 
				WHERE product.user_id=user.user_id 
				AND username = '$username'
				ORDER BY product.date_added DESC");
		return $this->query = $query;
	}

	//Sökfunktion
	function searchProduct($dbCon)
	{
		
		$query="SELECT * FROM product "; 
		$query .="JOIN category AS cat ON cat.category_id=product.category ";
		$query .="JOIN state AS state ON state.state_id=product.state_id "; 
		$operator= "WHERE ";

		//Om sökfältet är ifyllt, sök på valt ord i annonsens titel och beskrivande text
		if(isset($_POST['searchField']) && $_POST['searchField'] !="")
		{
			$search=$dbCon->real_escape_string($_POST['searchField']);
			$query .= "$operator product.title LIKE '%$search%' OR product.text LIKE '%$search%' ";
			$operator= 'AND';
		}
		//Om en kategori är vald, visa alla annonser inom den kategorin
		if(isset($_POST['category']) && $_POST['category'] != 0)
		{
			$category_id=$dbCon->real_escape_string($_POST['category']);
			$query .= "$operator product.category='$category_id' ";
			$operator= 'AND ';
		}
		//Om ett län är valt, visa alla annonser i det valda länet
		if(isset($_POST['state']) && $_POST['state'] != 0)
		{
			$state_id=$dbCon->real_escape_string($_POST['state']);
			$query .= "$operator product.state_id='$state_id' ";
			$operator= 'AND ';
		}
		//Om sortera på "Pris stigande" är valt, sorteras priserna stigande
		if(isset($_POST['sort']) && $_POST['sort'] == 1){
			$priceLowToHigh=$dbCon->real_escape_string($_POST['sort']);
			$query .= "GROUP BY product.price ASC";
			$operator= 'AND ';
		}
		//Om sortera på "Pris fallande" är valt, sorteras priserna fallande
		elseif(isset($_POST['sort']) && $_POST['sort'] == 2){
			$priceLowToHigh=$dbCon->real_escape_string($_POST['sort']);
			$query .= "GROUP BY product.price DESC";
			$operator= 'AND ';
		}
		//Om sortera på "Nyaste först" är valt, sorteras annonserna nyast överst
		elseif(isset($_POST['sort']) && $_POST['sort'] == 3){
			$priceLowToHigh=$dbCon->real_escape_string($_POST['sort']);
			$query .= "GROUP BY product.date_added DESC";
			$operator= 'AND ';
		}
		//Om sortera på "Äldsta först" är valt, sorteras annonserna äldst överst
		elseif(isset($_POST['sort']) && $_POST['sort'] == 4){
			$priceLowToHigh=$dbCon->real_escape_string($_POST['sort']);
			$query .= "GROUP BY product.date_added ASC";
			$operator= 'AND ';
		}
		//Annars sorteras alla annonser på den senaste inlagda annonsen
		else{
		$query .="GROUP BY product.product_id DESC";
		} 
		return $this->query = $query;
	}		
}

