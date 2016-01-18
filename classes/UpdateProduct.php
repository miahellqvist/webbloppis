<?php

    class UpdateProduct{

    	function productData($dbCon,$query){
    		$html="";
    		$allCategory="";
    		$allSubcategory="";
			$allState="";
    		
    		//Kategori
			$query1 = "SELECT * FROM category";
			$result1 = $dbCon->query($query1);

			while ($row = mysqli_fetch_assoc($result1)) {
				$allCategory .="<option value='".$row['category_id']."'>".$row['category_name']."</option>";
			}

			//Underkategori
			$query2 = "SELECT * FROM subcategory";
			$result2 = $dbCon->query($query2);

			while ($row = mysqli_fetch_assoc($result2)) {
				$allSubcategory .="<option value='".$row['subcategory_id']."'>".$row['subcategory_name']."</option>";
			}

			//Län		
			$query3 = "SELECT * FROM state";
			$result3 = $dbCon->query($query3);

			while ($row = mysqli_fetch_assoc($result3)) {
				$allState .="<option value='".$row['state_id']."'>".$row['state_name']."</option>";
			}

    		if ($result = $dbCon->query($query->showFullProduct($dbCon))){

    			while($row = $result->fetch_assoc()){
    				
					$product_id= $row['product_id'];
			 		$title = $row['title'];
			 		$text = $row['text'];
			 		$price = $row['price'];
			 		$category="<option value='".$row['category_id']."'>".$row['category_name']."</option>";
			 		$subcategory="<option value='".$row['subcategory_id']."'>".$row['subcategory_name']."</option>";
			 		$state="<option value='".$row['state_id']."'>".$row['state_name']."</option>";
			 	}

		 		
    		}
    		
    		$html.= "
						<form method=post>
						  <h3>Här kan du uppdatera din annons uppgifter</h3>
						  <input type='hidden' name='product_id' value='{$product_id}'/>
						  <p><label>Önskad titel:<br/><input type='text' name='title' value='{$title}'></p>
						  <p><label>Beskrivande text:<br/><textarea name='text' cols='45' rows='6'>$text </textarea></label></p>
						  <p><label>Önskat pris:<br/><input type='number' name='price' value='{$price}'></label></p>
						  Välj kategori:
							<select name='category'>
							".$category."
							<option value='0'>-- Välj en kategori --</option>
							".$allCategory."
							</select><br>

						Välj underkategori:
							<select name='subcategory'>
							".$subcategory."
							<option value='0'>-- Välj en underkategori --</option>
							".$allSubcategory."
							</select><br>

						Välj län:
							<select name='state'>
							".$state."
							<option value='0'>-- Välj ett län --</option>
							".$allState."
							</select><br><br>
						 
						 <input type='submit'  name='updateProduct' value='Spara'>
						 <input type='submit'  name='deleteProduct' value='Ta bort annonsen'>						 
						</form>
					";
		 	return $this->html=$html;	
    	}


    	function updateProductData($dbCon, $query)
    	{
    			$id=$dbCon->real_escape_string($_GET['id']);
	    		$title = $dbCon->real_escape_string($_POST['title']);
				$text = $dbCon->real_escape_string($_POST['text']);
				$price = $dbCon->real_escape_string($_POST['price']);
				$category = $dbCon->real_escape_string($_POST['category']);
		 		$subcategory = $dbCon->real_escape_string($_POST['subcategory']);
		 		$state = $dbCon->real_escape_string($_POST['state']);
		 		
    			//Lägger in i databasen
				$query = ("UPDATE product
						 SET title='$title', text='$text', price= '$price',
							 category='$category', subcategory='$subcategory', state_id='$state'
							WHERE product.product_id='$id'");
							
    			$dbCon->query($query);
    			return "Du har uppdaterat din annons!";

    	}

    	function deleteProduct($dbCon) {   		
    		$id=$dbCon->real_escape_string($_GET['id']);
    		// sql to delete a record
			$query = "DELETE FROM product WHERE product_id='$id'";

			if ($dbCon->query($query) === TRUE) {
			    echo "Annonsen tagits bort";
			} else {
			    echo "Error deleting record: " . $dbCon->error;
			}
    	}
   }