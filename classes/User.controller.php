<?php

class User{

//Skickar inloggningsuppgifter till checkLogin
	public static function login() {

		require_once('User.model.php');
		$data = array();
		if (isset($_POST['login'])) {
			
			$username = $_POST['username'];
			$password = $_POST['password'];
			try {
				$result = UserModel::checkLogin($username, $password);
				$data['redirect'] = '?/User/home';
			} catch(Exception $e) {
				$data['error'] = $e->getMessage();
				$data['template'] = 'registerError.html';
			}

		} else {
			$data['redirect'] = '?/User/home';
		}
		return $data;
	}

//Om säljaren tryck på "logga ut" avslutas sessionen username
	public static function logout() {
		session_unset();
		header ('Location: index.php');
	}

//Skickar användaren till registreringsformuläret
	public static function register() {
		require_once('User.model.php');
		$data['states'] = UserModel::getStates();
		$data['memberships'] = UserModel::getMemberships();
		$data['template'] = 'register.html';
		return $data;
  	}
  	
//Hämtar uppgifter från användarregistreringsformuläret
  	public static function completeRegister() {
  		require_once('User.model.php');
  		$data = array();
  		if(isset($_POST['createAccount'])) {
  			$username = $_POST['username'];
  			$password = $_POST['password'];
  			$name = $_POST['name'];
  			$membership = $_POST['membership'];
  			$state = $_POST['state'];
  			$email = $_POST['email'];
  			$adress = $_POST['adress'];
  			$zip_code = $_POST['zip_code'];
  			$phone = $_POST['phone'];
  			$city =$_POST['city'];
  			$result = UserModel::register($username,$password,$name,$membership,$state,$email,$adress,$zip_code,$phone,$city);

  			if($result) {
  				$data['template'] = 'registerSuccess.html';
  			} else {
  				$data['template'] = 'registerError.html';
  			}
  		} else {
  			$data['redirect'] = '?/User/register';
  		}
  		return $data;
  	}

//Skickar användaren till förstasidan
  	public static function home() {
		require_once('Product.model.php');
		require_once('Upload.model.php');
		$data['products'] = ProductModel::getAllProducts();
		$data['states'] = UploadModel::getStates();
		$data['categories'] = UploadModel::getCategories();

		if(isset($_SESSION['user'])) {
			$data['template'] = 'indexOnline.html';
		} else {
			$data['template'] = 'indexOffline.html';
		}
		return $data;
  	}

//Skickar användaren till Mina uppgifter
  	public static function personal(){
  		require_once('User.model.php');
  		require_once('Upload.model.php');
    	$data['states'] = UploadModel::getStates();
    	$data['user'] = UserModel::getPersonalData();
  		$data['template']='personal.html';
  		return $data;
  	}

//Hämtar uppgifter från "Uppdatera personliga uppgifter"
  	public static function completePersonalUpdate(){
  		require_once('User.model.php');
  		$data=array();
  		if(isset($_POST['updatePersonal'])){
  			$name = $_POST['name'];
  			$state = $_POST['state'];
  			$email = $_POST['email'];
  			$adress = $_POST['adress'];
  			$zip_code = $_POST['zip_code'];
  			$phone = $_POST['phone'];
  			$city =$_POST['city'];
  			$result=UserModel::updatePersonal($name, $state, $email, $adress, $zip_code, $phone, $city);
  		
	  		if($result) {
	  			$data['redirect'] = '?/User/home';
	  		} 
	  		else{
	  			$data['template'] = 'registerError.html';
	  		}
  		}
  		else {
  			$data['redirect'] = '?/User/personal';
  		}
  		return $data;
  	}

}