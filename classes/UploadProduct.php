<?php

class UploadProduct {

	function upload(){

		if(isset($_POST['submit'])){

			// Kollar efter fel
			if($_FILES['file']['error'] > 0){
			   die('Fel vid uppladdning.');
			}

			// Kollar att det är en bild som laddas upp
			if(!getimagesize($_FILES['file']['tmp_name'])){
			   die('Se till att det är en bild som laddas upp.');
			}

			// Kollar filstorlek (dock verkar det inte gå att ladda upp bilder över 2 mb oavsett vilken gräns man skriver)
			if($_FILES['file']['size'] > 4096000){
			    die('Bilden överskrider maxstorleken.');
			}

			// Kollar om bilden redan finns
			if(file_exists('upload/' . $_FILES['file']['name'])){
			    die('Bilden är redan uppladdad.');
			}

			// Kollar att det är rätt filtyp (png, jpg, jpeg eller gif)
			if($_FILES['file']['type'] == 'image/png' || 'image/jpg' || 'image/jpeg' || 'image/gif'){

				//Den uppladdade bilden placeras i mappen upload
				$uploadfile = move_uploaded_file($_FILES['file']['tmp_name'], 'upload/' . $_FILES['file']['name']);
				$image_title = $_POST['title'];
				$image_text = $_POST['text'];
				$image_name = $_FILES['file']['name'];
				$image_type = $_FILES['file']['type'];
				$image_size = $_FILES['file']['size'];
			   	
			   	//Lägger in i databasen
				$query = ("INSERT INTO product(title, text, image_name, image_type, image_size, date)
							VALUES ('$image_title', '$image_text', '$image_name', '$image_type', '$image_size', CURRENT_TIMESTAMP)");
				
				// Uppladdning av fil
				if($uploadfile && $query){
					echo "Uppladdningen lyckades!";
				}else if(!$uploadfile){
					echo "Uppladdningen misslyckades";
				}else if(!$query){
					echo "Bilden är inte sparad";
				}
			}
		}
	}
}