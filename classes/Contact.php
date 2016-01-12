<?php



class Contact {
	
	/*function sendEmail() {
		$errors = [];

		if (isset($_POST['name'], $_POST['email'], $_POST['subject'], $_POST['message'])) {
			$fields = [
				'name' => $_POST['name'],
				'email' => $_POST['email'],
				'subject' => $_POST['subject'],
				'message' => $_POST['message']
			];

			foreach ($fields as $field => $data) {
				if(empty($data)) {
					$errors[] = 'The ' . $field . ' field is required.';
				}
			}

			if (empty($errors)) {
				require_once 'PHPMailerAutoload.php';
				$m = new PHPMailer;
				$m->isSMTP();
				$m->SMTPAuth = true;

				$m->Host = 'smtp.gmail.com';
				$m->Username = 'natalianakagawa@gmail.com';
				$m->Password = '';
				$m->SMTPSecure = 'ssl';
				$m->Port = 465;

				$m->isHTML();

				$m->Subject = $fields['subject'];
				$m->Body = 'From: ' . $fields['name'] . ' (' . $fields['email'] . ')<p>' . $fields['message'] . '</p>';

				$m->FromName = 'Contact';

				$m->AddAddress('natalianakagawa@gmail.com', 'Natalia Nakagawa');

				if ($m->send()) {
					return "Your email has been sent";
					die();
				}else {
					$errors[] = 'Sorry, could not send email.';
				}
			}

		}
		else{
			$errors[] = 'Something went wrong.';
		}

		$_SESSION['errors'] = $errors;
		$_SESSION['fields'] = $fields;
	}*/

	function sendEmail($dbCon, $query) {
		$html="";
		//require_once 'PHPMailerAutoload.php';
		//$mail = new PHPMailer;
		$fromEmail=$_POST['email'];
		$fromName=$_POST['name'];
		$message=$_POST['message'];
		$subject=$_POST['subject'];
		$headers= "From: $fromEmail";
		//$mail->SetFrom($fromEmail, $fromName);

		if ($result = $dbCon->query($query->getUserEmail($dbCon))){

			while ($row = $result->fetch_assoc()) {
	  			//$mail->AddAddress($row["email"], $row["name"]);
	  			//$mail->Subject = $subject;
	  			//$mail->Body = 'From: ' . $fromEmail . ' (' . $fromName . ')<p>' . $message . '</p>';
	  			$to=$row['email'];
	  			$sendIt=mail($to, $subject, $message, $headers);
	  			
	  			
	  			if(isset($sendIt)) {
	  				$html .= "Message sent to :" . $row["name"] . ' (' . str_replace("@", "&#64;",     $row["email"]) . ')<br>';
	  			} else {
	    			$html .= "Mailer Error (" . str_replace("@", "&#64;", $row["email"]) . ') <br>';
				}
				// Clear all addresses and attachments for next loop
				//$mail->ClearAddresses();
				//$mail->ClearAttachments();
			}return $this->html=$html;
		}
	}

}