<?php

class SearchModel {
	public static function searchQuery($searchProduct,$category,$state,$sort){
		$dbCon= Connection::connect();
		$query="SELECT * FROM product "; 
		$query .="JOIN category AS cat ON cat.category_id=product.category ";
		$query .="JOIN state AS state ON state.state_id=product.state_id "; 
		$operator= "WHERE ";

		//Om sökfältet är ifyllt, sök på valt ord i annonsens titel och beskrivande text
		if(isset($searchProduct) && $searchProduct !="")
		{
			$searchProduct=$dbCon->real_escape_string($searchProduct);
			$query .= "$operator (product.title LIKE '%$searchProduct%' ";
			$operator= 'AND';
		}
		//Om sökfältet är ifyllt, sök på valt ord i annonsens titel och beskrivande text
		if(isset($searchProduct) && $searchProduct !="")
		{
			$searchProduct=$dbCon->real_escape_string($searchProduct);
			$operator= 'OR';
			$query .= "$operator product.text LIKE '%$searchProduct%') ";
			$operator= 'AND';
		}
		//Om en kategori är vald, visa alla annonser inom den kategorin
		if(isset($category) && $category != 0)
		{
			$category_id=$dbCon->real_escape_string($category);
			$query .= "$operator product.category='$category_id' ";
			$operator= 'AND ';
		}
		//Om ett län är valt, visa alla annonser i det valda länet
		if(isset($state) && $state != 0)
		{
			$state_id=$dbCon->real_escape_string($state);
			$query .= "$operator product.state_id='$state_id' ";
			$operator= 'AND ';
		}
		//Om sortera på "Pris stigande" är valt, sorteras priserna stigande
		if(isset($sort) && $sort == 1){
			$priceLowToHigh=$dbCon->real_escape_string($sort);
			$query .= "GROUP BY product.price ASC ";
			$operator= 'AND ';
		}
		//Om sortera på "Pris fallande" är valt, sorteras priserna fallande
		elseif(isset($sort) && $sort == 2){
			$priceLowToHigh=$dbCon->real_escape_string($sort);
			$query .= "GROUP BY product.price DESC ";
			$operator= 'AND ';
		}
		//Om sortera på "Nyaste först" är valt, sorteras annonserna nyast överst
		elseif(isset($sort) && $sort == 3){
			$priceLowToHigh=$dbCon->real_escape_string($sort);
			$query .= "GROUP BY product.date_added DESC ";
			$operator= 'AND ';
		}
		//Om sortera på "Äldsta först" är valt, sorteras annonserna äldst överst
		elseif(isset($sort) && $sort == 4){
			$priceLowToHigh=$dbCon->real_escape_string($sort);
			$query .= "GROUP BY product.date_added ASC ";
			$operator= 'AND ';
		}
		//Annars sorteras alla annonser på den senaste inlagda annonsen
		else{
		$query .="GROUP BY product.product_id DESC ";
		$data['template'] = 'uploadError.html';
		} 
	
		return $query;
	}

	public static function getSearchResult($searchProduct,$category,$state,$sort){

		$dbCon= Connection::connect();
		$query=self::searchQuery($searchProduct,$category,$state,$sort);
		//$query=("SELECT * FROM product WHERE product.title LIKE 'test'");
		$products = array();
		if($result = $dbCon->query($query)){
			if(mysqli_num_rows($result)>0){
				while ($product = $result->fetch_assoc()) {
					$products[]=$product;
					
				}
				return $products;
			} 	
		}else {
			echo "Ingen annons funnen.";
		}
		
	}
}

/*
	if($result = $dbCon->query($query)){

			while ($item = $result->fetch_assoc()) {
				$items[]=$item;
			}
		} else {
			die("Ingen annons funnen.");
		}
		return $items;



		$dbCon= Connection::connect();
		$query = "SELECT * FROM subcategory";
		$subcategories = array();
		if($result = $dbCon->query($query)){

			while ($subcategory = $result->fetch_assoc()) {
				$subcategories[]=$subcategory;
			}
		} else {
			die($dbCon->error);
		}
		return $subcategories;
		*/