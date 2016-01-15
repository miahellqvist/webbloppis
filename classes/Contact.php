<?php

class Contact {

	function sendEmail($dbCon, $query) {
		$html="";
		
		$fromEmail=$_POST['email'];
		$fromName=$_POST['name'];
		$message=$_POST['message'];
		$headers= "From: $fromEmail";

		if ($result = $dbCon->query($query->getUserEmail($dbCon))){

			while ($row = $result->fetch_assoc()) {
	  			$subject=$row['title'];
	  			$to=$row['email'];
	  			$text = "Från: ". $fromName." (". $fromEmail.")\r\n". $message;
	  			$sendIt=mail($to, $subject, $text, $headers);
	  			
	  			if(isset($sendIt)) {
	  				$html .= "Mejlet har skickats!";
	  			} else {
	    			$html .= "Mailer Error (" . str_replace("@", "&#64;", $row["email"]) . ') <br>';
				}
			}return $this->html=$html;
		}
	}

}