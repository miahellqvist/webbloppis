<?php

class UploadModel{

//Hämtar alla produktkategorier från databasen
		public static function getCategories() {		
		$dbCon= Connection::connect();
		$query = "SELECT * FROM category";
		$categories = array();
		if($result = $dbCon->query($query)){

			while ($category = $result->fetch_assoc()) {
				$categories[]=$category;
			}
		} else {
			die($dbCon->error);
		}
		return $categories;
	}

//Hämtar alla produktunderkategorier från databasen
	public static function getSubCategories() {		
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
	}

//Kontrollerar ifall bildfilen som användaren laddat upp i newProductForm är av rätt typ
	public static function fileControl($file) {
		$dbCon= Connection::connect();
		if (isset($file)) {
			$username = $_SESSION['user']['username'];
			// Kollar efter fel
			if($file['error'] > 0){
			   throw new Exception('Fel vid uppladdning.');
			}
			// Kollar filstorlek – maxstorlek 6 mb
			if(!($file['size'] < 8388608)){
			   throw new Exception('Bilden överskrider maxstorleken.');
			}
			// Kollar om bilden redan finns
			if(file_exists('upload/' . $username . '/' . $file['name'])){
			   throw new Exception('Bilden är redan uppladdad.');
			}
			// Kollar att det är rätt filtyp (png, jpg, jpeg eller gif)
			if(!($file['type'] == 'image/png' || $file['type'] == 'image/PNG' || $file['type'] == 'image/jpg' || $file['type'] == 'image/jpeg' || $file['type'] == 'image/gif')){
			   throw new Exception('Bilden inte rätt typ.');	
			}
		} else {
			throw new Exception('Bilden laddades inte upp.');
		}
	}

//Tvättar och hanterar uppgifter från newProductForm.html

	public static function upload($title,$text,$price,$file,$category,$subcategory,$state) {
		$dbCon= Connection::connect();
		$title = $dbCon->real_escape_string($title);
  		$text = $dbCon->real_escape_string($text);
  		$price = $dbCon->real_escape_string($price);
  		$category = $dbCon->real_escape_string($category);
  		$subcategory = $dbCon->real_escape_string($subcategory);
  		$state = $dbCon->real_escape_string($state);
  		try{
  		$image = self::fileControl($file);
  		}
  		catch (Exception $e){
  			throw $e;
  		}
  		$insert = self::insertProduct($title,$text,$price,$file,$category,$subcategory,$state);


	}

//Lägger in produktinformation i databasen
	public static function insertProduct($title,$text,$price,$file,$category,$subcategory,$state){
			$dbCon= Connection::connect();
			$username=$_SESSION['user']['username'];
			$uploadfile = move_uploaded_file($file['tmp_name'], 'upload/'.$username.'/'.$file['name']);
			$image_name = $username.'/'.$file['name'];
			$image_type = $file['type'];
			$image_size = $file['size'];

		$user_id = $_SESSION['user']['user_id'];
		$query = ("INSERT INTO product
							(title, text, price, image_name, image_type, image_size, category, subcategory, date_added, user_id, state_id)
							VALUES 
							('$title', '$text', '$price', '$image_name', '$image_type', '$image_size', 
								'$category', '$subcategory', CURRENT_TIMESTAMP, '$user_id', '$state')");
				$dbCon->query($query);
				// Uppladdning av fil
				if($uploadfile && $query){
					$data['template'] = 'index.html';
				}elseif(!($uploadfile or $query)){
					throw new Exception("Bilden laddades inte upp.");
				}
				return $data;
	}
}