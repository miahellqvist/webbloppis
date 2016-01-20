<?php

class UploadModel{

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

	public static function getStates() {
		$dbCon= Connection::connect();
		$states = array();
		$query = "SELECT * FROM state";
		if($result = $dbCon->query($query)){
			while ($state = $result->fetch_assoc()) {
				$states[]=$state;
			} 	
		} else {
			die($dbCon->error);
		}
		return $states;
	}
	public static function upload($title,$text,$price,$file,$category,$subcategory,$state) {
		$dbCon= Connection::connect();
		$title = $dbCon->real_escape_string($title);
  		$text = $dbCon->real_escape_string($text);
  		$price = $dbCon->real_escape_string($price);
  		$category = $dbCon->real_escape_string($category);
  		$subcategory = $dbCon->real_escape_string($subcategory);
  		$state = $dbCon->real_escape_string($state);
  		$image = self::fileControl($file);
  		$insert = self::insertProduct($title,$text,$price,$file,$category,$subcategory,$state);

	}

	public static function fileControl($file) {
		//$dbCon= Connection::connect();
		if (isset($file)) {
			$username = $_SESSION['user'];
			// Kollar efter fel
			if(!($file['fel'] > 0)){
				return true;
			}else{
			   throw new Exception('Fel vid uppladdning.');
			}
			// Kollar filstorlek – maxstorlek 6 mb
			if($file['size'] < 6291456){
			    return true;
			}else{
			   throw new Exception('Bilden överskrider maxstorleken. Din storlek var : '.$file['size']);
			}
			// Kollar om bilden redan finns
			if(!(file_exists('upload/' .$username.'/'. $file['name']))){
			    return true;
			}else{
			   throw new Exception('Bilden är redan uppladdad.');
			}
			// Kollar att det är rätt filtyp (png, jpg, jpeg eller gif)
			if($file['type'] == 'image/png' || $file['type'] == 'image/PNG' || $file['type'] == 'image/jpg' || $file['type'] == 'image/jpeg' || $file['type'] == 'image/gif'){
				return true;
			}else{
			   throw new Exception("Bilden inte rätt typ.");
					
			}
			return true;
		} else {
			throw new Exception("Bilden laddades inte upp.");
		}
	}

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
					$data['template'] = 'indexOnline.html';
				}else if(!($uploadfile or $query)){
					$data['template'] = 'uploadError.html';
				}
				return $data;
	}
}