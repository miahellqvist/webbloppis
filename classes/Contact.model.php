<?php

class ContactModel {

//hämtar säljares mejl och produkt titel
	public static function sendEmail($id) {
		$dbCon=Connection::connect();

		$query=("SELECT product.user_id, title, email
				FROM user, product 
				WHERE product.product_id = '$id'
				AND product.user_id = user.user_id");

		if ($result = $dbCon->query($query)) { 
  			$product = $result->fetch_assoc();
  			return $product;
  		}
	}

//skickar mejl till säljaren
	public static function sendEmailtoSeller($senderName, $senderEmail, $senderMsg, $subject, $sellerEmail) {
		$dbCon=Connection::connect();

		$cleanName = $dbCon->real_escape_string($senderName);
		$cleanEmail = $dbCon->real_escape_string($senderEmail);
		$cleanMessage = $dbCon->real_escape_string($senderMsg);
		
		$cleanSellerEmail = $dbCon->real_escape_string($sellerEmail);
		$cleanSubject = $dbCon->real_escape_string($subject);

		$text = "Från: ". $cleanName.", ". $cleanEmail."\r\n". $cleanMessage;
		$headers= "From: $cleanName";
	  	$sendIt=mail($cleanSellerEmail, $cleanSubject, $text, $headers);
	
<<<<<<< HEAD
	//if mejlet skickades returnerar det true. Annars skriver ut error meddelande		
=======
	//om mejlet skickades returnerar det true. Annars skriver ut error meddelande		
>>>>>>> ba25d166856fee68a4e27bdecb0ef8d93c80fcb4
	  	if(isset($sendIt)) {
	  		return true;
	  	} else {
	  		throw new Exception('Ett fel har inträffat. Ditt meddelande kunde inte skickas. Försök igen vid ett senare tillfälle.');
		}
		
	}


}