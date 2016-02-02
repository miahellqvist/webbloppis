<?php

class Contact {
	
//visar mejlformuläret och hämtar product_id
	public static function emailForm($url_parts) {
		require_once('Contact.model.php');
		require_once('User.model.php');
      	require_once('Upload.model.php');
		$data=array();

		if (count($url_parts) > 0) {
			$id=$url_parts[0];
			$result=ContactModel::sendEmail($id);
			if ($result) {
				$data['product'] = $result;
				$data['template'] = 'emailForm.html';
				$data['states'] = UserModel::getStates();
            	$data['categories'] = UploadModel::getCategories();
			}
			
		}
		return $data;
	}

//hämtar sender info
	public static function emailSent() {
		require_once('Contact.model.php');
		require_once('User.model.php');
      	require_once('Upload.model.php');
      	$data=array();

      	if (isset($_POST['send'])) {
      		$senderName=htmlentities($_POST['name']);
      		$senderEmail=htmlentities($_POST['email']);
      		$senderMsg=htmlentities($_POST['message']);  		
      		$subject=$_POST['subject'];
      		$sellerEmail=$_POST['sellerEmail'];

      		try {
				$result=ContactModel::sendEmailtoSeller($senderName, $senderEmail, $senderMsg, $subject, 
					$sellerEmail);
		          	$data['template'] = 'emailSuccess.html';
		         	$data['states'] = UserModel::getStates();
            		$data['categories'] = UploadModel::getCategories();
					
			}
			catch(Exception $e) {
				$data['error'] = $e->getMessage();
				$data['template'] = 'error.html';
				$data['states'] = UserModel::getStates();
            	$data['categories'] = UploadModel::getCategories();
			}
      		
      	}
      	else {
      		$data['redirect'] ='?/User/home';
      	}
      	return $data;
	}
}