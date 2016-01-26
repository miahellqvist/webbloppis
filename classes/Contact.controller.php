<?php

class Contact {
	
//visar mejlformuläret och hämtar product_id
	public static function emailForm($url_parts) {
		require_once('Contact.model.php');
<<<<<<< HEAD
		require_once('User.model.php');
      	require_once('Upload.model.php');
=======
>>>>>>> ba25d166856fee68a4e27bdecb0ef8d93c80fcb4
		$data=array();

		if (count($url_parts) > 0) {
			$id=$url_parts[0];
			$result=ContactModel::sendEmail($id);
			if ($result) {
				$data['product'] = $result;
				$data['template'] = 'emailForm.html';
<<<<<<< HEAD
				$data['states'] = UserModel::getStates();
            	$data['categories'] = UploadModel::getCategories();
=======
>>>>>>> ba25d166856fee68a4e27bdecb0ef8d93c80fcb4
			}
			
		}
		return $data;
	}

//hämtar sender info
	public static function emailSent() {
		require_once('Contact.model.php');
<<<<<<< HEAD
		require_once('User.model.php');
      	require_once('Upload.model.php');
      	$data=array();

      	if (isset($_POST['send'])) {
      		$senderName=htmlentities($_POST['name']);
      		$senderEmail=htmlentities($_POST['email']);
      		$senderMsg=htmlentities($_POST['message']);  		
=======
      	$data=array();

      	if (isset($_POST['send'])) {
      		$senderName=$_POST['name'];
      		$senderEmail=$_POST['email'];
      		$senderMsg=$_POST['message'];  		
>>>>>>> ba25d166856fee68a4e27bdecb0ef8d93c80fcb4
      		$subject=$_POST['subject'];
      		$sellerEmail=$_POST['sellerEmail'];

      		try {
				$result=ContactModel::sendEmailtoSeller($senderName, $senderEmail, $senderMsg, $subject, 
					$sellerEmail);
<<<<<<< HEAD
		          	$data['template'] = 'emailSuccess.html';
		         	$data['states'] = UserModel::getStates();
            		$data['categories'] = UploadModel::getCategories();
=======
		        //if ($result) {
		          $data['template'] = 'emailSuccess.html';
		        //}
>>>>>>> ba25d166856fee68a4e27bdecb0ef8d93c80fcb4
					
			}
			catch(Exception $e) {
				$data['error'] = $e->getMessage();
				$data['template'] = 'error.html';
<<<<<<< HEAD
				$data['states'] = UserModel::getStates();
            	$data['categories'] = UploadModel::getCategories();
=======
>>>>>>> ba25d166856fee68a4e27bdecb0ef8d93c80fcb4
			}
      		
      	}
      	else {
      		$data['redirect'] ='?/User/home';
      	}
      	return $data;
	}
}