<?php


class ProductModel {

//Hämtar produktinformation från databasen (För galleri)
	public static function getAllProducts() {
		$dbCon= Connection::connect();
		$query = 
			("SELECT title, price, image_name, product_id 
			FROM product 
			ORDER BY date_added DESC
			");
		
		if ($result = $dbCon->query($query))
		{	
			$products = array();
			while ($product = $result->fetch_assoc())
			{
				$products[]=$product;
			}

			return $products;
		}
		else {
			die($dbCon->error);
		}
	}

//Hämtar produktinformation från databasen (För att visa ela annonsen)
	public static function getProductData($id) {
  		$dbCon= Connection::connect();

  		$query=("SELECT * 
				FROM product, category, subcategory, state, user
				WHERE product.product_id='$id'
				AND product.category=category.category_id
				AND product.subcategory=subcategory.subcategory_id
				AND product.state_id=state.state_id
				AND product.user_id=user.user_id");

  		if ($result = $dbCon->query($query)) {
  			$product = $result->fetch_assoc();
  			return $product;
  		}

  	}

//Hämtar produktinformation för produkter i en viss kategori från databasen
  	public static function getProductsCategory($category_id) {
		$dbCon= Connection::connect();
		$query = 
			("SELECT title, price, image_name, product_id, category_name
			FROM category, product
			WHERE product.category=category.category_id
			AND category.category_id='$category_id'
			ORDER BY product.date_added DESC");
		
		if ($result = $dbCon->query($query))
		{	
			$products = array();
			while ($product = $result->fetch_assoc())
			{
				$products[]=$product;
			}

			return $products;
		}
		else {
			die($dbCon->error);
		}
	}

//Hämtar produktinformation för produkter i en viss underkategori från databasen
	public static function getProductsSubcategory($subcategory_id) {
		$dbCon= Connection::connect();
		$query = 
			("SELECT title, price, image_name, product_id, subcategory_name
			FROM subcategory, product
			WHERE product.subcategory=subcategory.subcategory_id
			AND subcategory.subcategory_id='$subcategory_id'
			ORDER BY product.date_added DESC");
		
		if ($result = $dbCon->query($query))
		{	
			$products = array();
			while ($product = $result->fetch_assoc())
			{
				$products[]=$product;
			}

			return $products;
		}
		else {
			die($dbCon->error);
		}
	}

//Hämtar produktinformation för produkter i ett viss län från databasen
	public static function getProductsState($state_id) {
		$dbCon= Connection::connect();
		$query = 
			("SELECT title, price, image_name, product_id, state_name
			FROM state, user, product
			WHERE product.state_id=state.state_id
			AND state.state_id='$state_id'
			AND product.user_id=user.user_id
			ORDER BY product.date_added DESC");
		
		if ($result = $dbCon->query($query))
		{	
			$products = array();
			while ($product = $result->fetch_assoc())
			{
				$products[]=$product;
			}

			return $products;
		}
		else {
			die($dbCon->error);
		}
	}

//Hämtar produktinformation för produkter från en viss säljare från databasen
	public static function getProductsUser($user_id) {
		$dbCon= Connection::connect();
		$query = 
			("SELECT title, price, image_name, product_id, name
			FROM user, product
			WHERE user.user_id='$user_id'
			AND product.user_id=user.user_id
			ORDER BY product.date_added DESC");
		
		if ($result = $dbCon->query($query))
		{	
			$products = array();
			while ($product = $result->fetch_assoc())
			{
				$products[]=$product;
			}
			
			return $products;
		}
		else {
			die($dbCon->error);
		}
	}

	public static function getMyProducts() {
		$dbCon= Connection::connect();
		$user_id=$_SESSION['user']['user_id'];

		$query = 
			("SELECT title, price, image_name, product_id, name
			FROM user, product
			WHERE user.user_id='$user_id'
			AND product.user_id=user.user_id
			ORDER BY product.date_added DESC");

		if ($result = $dbCon->query($query))
		{	
			$products = array();
			while ($product = $result->fetch_assoc())
			{
				$products[]=$product;
			}
			
			return $products;
		}
		else {
			echo "Du har ingen annons.";
		}
	}

	public static function updatePersonalProduct($title,$text,$price,$category,$subcategory,$state,$id){
		$dbCon= Connection::connect();

		$cleanTitle = $dbCon->real_escape_string($title);
		$cleanText = $dbCon->real_escape_string($text);
 		$cleanPrice = $dbCon->real_escape_string($price);
 		$cleanCategory = $dbCon->real_escape_string($category);
 		$cleanSubcategory = $dbCon->real_escape_string($subcategory);
 		$cleanState = $dbCon->real_escape_string($state);
 		$cleanId = $dbCon->real_escape_string($id);

		$query = ("
			UPDATE product
			SET title='$cleanTitle', text='$cleanText', price='$cleanPrice', category='$cleanCategory', subcategory='$cleanSubcategory', state_id='$cleanState'
			WHERE product.product_id='$cleanId'
			");

		$result=$dbCon->query($query);
		return true;
	}

	public static function deleteProduct($id) {
		$dbCon= Connection::connect();

		$cleanId = $dbCon->real_escape_string($id);

		$query = "DELETE FROM product WHERE product_id='$cleanId'";
		$result=$dbCon->query($query);
		return true;
	}
}