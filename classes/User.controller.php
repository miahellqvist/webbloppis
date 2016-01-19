<?php

class User{

	//Kollar om användaren skrivit in rätt namn ch lösenord och skapar en session med användarnamnet i
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

			/*if($result) {
				
  			} else {
  				
  			}*/
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

	//SKRIVER UT REGISTRERINGS-FORMULÄR

	public static function register() {
		require_once('User.model.php');
		$data['states'] = UserModel::getStates();
		$data['memberships'] = UserModel::getMemberships();
		$data['template'] = 'register.html';
		return $data;
  	}
  	
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

  	public static function home() {
		require_once('Product.model.php');
		$data['products'] = ProductModel::getAllProducts();

		if(isset($_SESSION['user'])) {
			$data['template'] = 'indexOnline.html';
		} else {
			$data['template'] = 'indexOffline.html';
		}
		return $data;
  	}

}