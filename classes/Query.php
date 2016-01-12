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
	function getUserid($dbCon)
	{
		$username = $dbCon->real_escape_string($_SESSION['username']);
		$query = ("SELECT * FROM user, state, membership 
			WHERE username='$username'
			AND user.type_membership_id=membership.membership_name
			AND user.state=state.state_id");
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
					ORDER BY product.date_added DESC");
		return $this->query = $query;
	}
	
	function showProductsBySubcategory($dbCon)
	{
		$subcategory_id=$dbCon->real_escape_string($_GET['subcategory']);
		$query = ("SELECT * FROM subcategory, product
					WHERE product.subcategory=subcategory.subcategory_id
					AND subcategory.subcategory_id='$subcategory_id'
					ORDER BY product.date_added DESC");
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
	function getUserEmail($dbCon)
	{
		$id=$dbCon->real_escape_string($_GET['id']);
		$query =("SELECT * FROM user, product 
			WHERE product.product_id = '$id'
			AND product.user_id = user.user_id");
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

	function searchProduct($dbCon)
	{
		
		$query="SELECT * FROM product "; 
		$query .="JOIN category AS cat ON cat.category_id=product.category ";
		$query .="JOIN state AS state ON state.state_id=product.state_id "; 
		$operator= "WHERE ";

		if(isset($_POST['searchField']) && $_POST['searchField'] !="")
		{
			$search=$dbCon->real_escape_string($_POST['searchField']);
			$query .= "$operator product.title LIKE '%$search%' OR product.text LIKE '%$search%' ";
			$operator= 'AND';
		}

		if(isset($_POST['category']) && $_POST['category'] != 0)
		{
			$category_id=$dbCon->real_escape_string($_POST['category']);
			$query .= "$operator product.category='$category_id' ";
			$operator= 'AND ';
		}

		if(isset($_POST['state']) && $_POST['state'] != 0)
		{
			$state_id=$dbCon->real_escape_string($_POST['state']);
			$query .= "$operator product.state_id='$state_id' ";
			$operator= 'AND ';
		}

		$query .="GROUP BY product.product_id "; 
		return $this->query = $query;
	}		
}

