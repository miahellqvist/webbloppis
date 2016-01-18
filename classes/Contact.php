<?php

class Contact {

//Skickar meddelande till säljaren
	function sendEmail($dbCon, $query) {
		$html="";
		
		$fromEmail=$dbCon->real_escape_string($_POST['email']);
		$fromName=$dbCon->real_escape_string($_POST['name']);
		$message=$dbCon->real_escape_string($_POST['message']);
		$headers= "From: $fromEmail";

		if ($result = $dbCon->query($query->getMessageInfo($dbCon))){

			while ($row = $result->fetch_assoc()) {
	  			$subject=$row['title'];
	  			$to=$row['email'];
	  			$text = "Från: ". $fromName.", ". $fromEmail."\r\n". $message;
	  			$sendIt=mail($to, $subject, $text, $headers);
	  			
	  			if(isset($sendIt)) {
	  				$html .= "Meddelandet har skickats till säljaren!";
	  			} else {
	    			$html .= "Ett fel har inträffat. Ditt meddelande kunde inte skickas. Försök igen vid ett senare tillfälle. <br>";
				}
			}return $this->html=$html;
		}
	}

}