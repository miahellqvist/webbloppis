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
	public static function getSingleProduct($id) {
  		$dbCon= Connection::connect();

  		$query=("SELECT * 
				FROM product, category, subcategory, state, user
				WHERE product.product_id='$id'
				AND product.category=category.category_id
				AND product.subcategory=subcategory.subcategory_id
				AND user.state=state.state_id
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
			WHERE user.state=state.state_id
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

}