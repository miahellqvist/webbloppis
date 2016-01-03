<?php

class validateMail {

		//Kontroll och validering av formuläret med htmlentities för säkerhet.

	/*function valSendername(){
		if (isset($_POST['sendername'])) {
			if (empty($_POST['sendername'])) {
				$errors[] = 'Var vänlig fyll i ditt namn.';
			}else{
				$sendername = htmlentities($_POST['sendername']);
			}
			return $sendername;
		}	
	}*/

	function valSubject(){
		if (isset($_POST['subject'])){
			if (empty($_POST['subject'])) {
				$errors[] = 'Var vänlig fyll i ärendefältet.';
			}else{
				$subject = htmlentities($_POST['subject']);
			}
		}
		return $subject;
	}

	function valMessage(){
		if (isset($_POST['message'])) {
			if (empty($_POST['message'])) {
				$errors[] = 'Var vänlig skriv in ett meddelande.';
			}else{
				$message = htmlentities($_POST['message']);
			}
		}
		return $message;
	}
	
	//validering och filtrering av mailadressen för att minska risken att personer använder
	//en påhittad epost.
	function valSenderemail(){
		if (isset($_POST['senderemail'])) {
			if (empty($_POST['senderemail'])) {
				$errors[] = 'Var vänlig skriv in din e-postadress.';
			}else if (strlen($_POST['senderemail']) > 347){
				$errors[] = 'E-postadressen är för lång. Var vänlig ange en giltig e-postadress.';
			}else if (filter_var($_POST['senderemail'], FILTER_VALIDATE_EMAIL) === false) {
				$errors[] = 'Var vänlig ange en giltig e-postadress.';
			}else{
				$senderemail = "<" . htmlentities($_POST['senderemail']) . ">";
			}
		}
		return $senderemail;
	}
	function valReceiveremail(){
		if (isset($_POST['receiveremail'])) {
			if (empty($_POST['receiveremail'])) {
				$errors[] = 'Var vänlig skriv in mottagarens e-postadress.';
			}else if (strlen($_POST['receiveremail']) > 347){
				$errors[] = 'E-postadressen är för lång. Var vänlig ange en giltig e-postadress.';
			}else if (filter_var($_POST['receiveremail'], FILTER_VALIDATE_EMAIL) === false) {
				$errors[] = 'Var vänlig ange en giltig e-postadress.';
			}else{
				$receiveremail = "<" . htmlentities($_POST['receiveremail']) . ">";
			}
		}
		return $receiveremail;
	}
	function sendMail(){
		if (empty($errors) === false) {
			foreach ($errors as $error) {
				echo "<li>", $error, "</li>";
			}
		}else{
			if (isset($receivermail, $subject, $message, $sendermail)) {
				mail($receiveremail, $subject, $message, "From: {$senderemail}");
			}
		}
	}

}//stänger klassen