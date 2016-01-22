<?php

class Contact {
	
//visar mejlformuläret och hämtar product_id
	public static function emailForm($url_parts) {
		require_once('Contact.model.php');
		$data=array();

		if (count($url_parts) > 0) {
			$id=$url_parts[0];
			$result=ContactModel::sendEmail($id);
			if ($result) {
				$data['product'] = $result;
				$data['template'] = 'emailForm.html';
			}
			
		}
		return $data;
	}

//hämtar sender info
	public static function emailSent() {
		require_once('Contact.model.php');
      	$data=array();

      	if (isset($_POST['send'])) {
      		$senderName=$_POST['name'];
      		$senderEmail=$_POST['email'];
      		$senderMsg=$_POST['message'];  		
      		$subject=$_POST['subject'];
      		$sellerEmail=$_POST['sellerEmail'];

      		try {
				$result=ContactModel::sendEmailtoSeller($senderName, $senderEmail, $senderMsg, $subject, 
					$sellerEmail);
		        //if ($result) {
		          $data['template'] = 'emailSuccess.html';
		        //}
					
			}
			catch(Exception $e) {
				$data['error'] = $e->getMessage();
				$data['template'] = 'error.html';
			}
      		
      	}
      	else {
      		$data['redirect'] ='?/User/home';
      	}
      	return $data;
	}
}