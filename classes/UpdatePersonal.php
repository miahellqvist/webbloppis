<?php

    class UpdatePersonal{

    	function personalData($dbCon,$query){
    		$html="";
    		$allMembership="";
    		$allState="";
    		
    		//Kategori
			$query1 = "SELECT * FROM membership";
			$result1 = $dbCon->query($query1);

			while ($row = mysqli_fetch_assoc($result1)) {
				$allMembership .="<option value='".$row['membership_name']."'>".$row['membership_name']."</option>";
			}

			//Län		
			$query2 = "SELECT * FROM state";
			$result2 = $dbCon->query($query2);

			while ($row = mysqli_fetch_assoc($result2)) {
				$allState .="<option value='".$row['state_id']."'>".$row['state_name']."</option>";
			}

    		if ($result = $dbCon->query($query->getUserData($dbCon))){

    			while($row = $result->fetch_assoc()){
    				
					$user_id= $row['user_id'];
			 		$name = $row['name'];
			 		$membership="<option value='".$row['type_membership_id']."'>".$row['membership_name']."</option>";
			 		$adress = $row['adress'];
			 		$zip_code = $row['zip_code'];
			 		$city = $row['city'];
			 		$state="<option value='".$row['state']."'>".$row['state_name']."</option>";
			 		$email=$row['email'];
			 		$phone=$row['phone'];
			 	}

		 		
    		}
    		
    		$html.= "
						<form method=post>
						  <h3>Här kan du uppdatera dina inmatade uppgifter</h3>
						  <input type='hidden' name='user_id' value='{$user_id}'/>
						  <p><label>Namn:<br/><input type='text' name='name' value='{$name}'></p>
						  Medlemskap:
							<select name='membership'>
							".$membership."
							<option value='0'>-- Välj medlemskap --</option>
							".$allMembership."
							</select><br>
						<p><label>Adress:<br/><input type='text' name='adress' value='{$adress}'></p>
						<p><label>Postnummer:<br/><input type='text' name='zip_code' value='{$zip_code}'></p>
						<p><label>Stad:<br/><input type='text' name='city' value='{$city}'></p>
						Välj län:
							<select name='state'>
							".$state."
							<option value='0'>-- Välj ett län --</option>
							".$allState."
							</select><br><br>
						<p><label>Email:<br/><input type='email' name='email' value='{$email}'></p>
						<p><label>Telefon:<br/><input type='text' name='phone' value='{$phone}'></p>
						 <input type='submit'  name='updatePersonal' value='Spara'>
						 <input type='submit'  name='deletePersonal' value='Avsluta prenumeration'>						 
						</form>
					";
		 	return $this->html=$html;

		 	if (isset($_POST['updatePersonal'])) {
		 		header('Location: UpdatePersonal.php');
		 	}
    	}


    	function updatePersonalData($dbCon)
    	{
    			$user_id = $dbCon->real_escape_string($_POST['user_id']);
	    		$name = $dbCon->real_escape_string($_POST['name']);
				$membership = $dbCon->real_escape_string($_POST['membership']);
				$adress = $dbCon->real_escape_string($_POST['adress']);
		 		$zip_code = $dbCon->real_escape_string($_POST['zip_code']);
		 		$city = $dbCon->real_escape_string($_POST['city']);
		 		$state = $dbCon->real_escape_string($_POST['state']);
		 		$email = $dbCon->real_escape_string($_POST['email']);
		 		$phone = $dbCon->real_escape_string($_POST['phone']);
		 		
    			//Lägger in i databasen
				$query = ("UPDATE user
						 SET name='$name', adress='$adress', zip_code='$zip_code', city='$city', 
						 state='$state', email='$email', phone='$phone', type_membership_id= '$membership'
							WHERE user.user_id='$user_id'");

							
    			$dbCon->query($query);
    			return "Du har uppdaterat dina personliga uppgifter!";

    	}

    	function deletePersonal($dbCon) {   		
    		$username = $dbCon->real_escape_string($_SESSION['username']);
    		// sql to delete a record
    		$query1 = "DELETE FROM product
				WHERE user_id in (SELECT DISTINCT user_id FROM user WHERE username='$username')";

			$query2 = "DELETE FROM user 
				WHERE username='$username'";

			if ($dbCon->query($query1) == TRUE AND $dbCon->query($query2) == TRUE) {
			  	unset($_SESSION['username']);
			    echo "Hej då!";
			} else {
			    echo "Error deleting record: " . $dbCon->error;
			}
    	}
   }