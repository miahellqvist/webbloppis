<?php

class User{

//Skickar inloggningsuppgifter till checkLogin och kollar om användaren har betalt sin prenumenation 
//Om ej betalt, skickas användaren till betalningssidan
	public static function login() {

    require_once('User.model.php');
    require_once('Product.model.php');
    $data = array();
    if (isset($_POST['login'])) {
      
      $username = $_POST['username'];
      $password = $_POST['password'];
      try {
        $user = UserModel::checkLogin($username, $password);
        $paidMembership=UserModel::checkIfMembershipPaid();
        if ($user && $paidMembership) {
          
          $data['template'] = 'myProfile.html';
          $data['user']=$user;
          $data['products']=ProductModel::getMyProducts();
          return $data;
        }
        elseif(!$paidMembership){
          $type_membership=UserModel::getUserMembership();
          if($type_membership == 1){
            $data['template'] = 'registerSuccessBrons.html';
          return $data;
          }
          elseif($type_membership == 2){
            $data['template'] = 'registerSuccessSilver.html';
          return $data;
          }
          elseif($type_membership == 3){
            $data['template'] = 'registerSuccessGuld.html';
          return $data;
          }
        }
      }
      catch(Exception $e) {
        $data['error'] = $e->getMessage();
        $data['template'] = 'error.html';
      }
    } 
    else {
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

  			try {
  				$result = UserModel::register($username,$password,$name,$membership,$state,$email,$adress,$zip_code,$phone,$city);
          $data['template'] = 'registerSuccess.html';
  			} catch (Exception $e) {
  				$data['template'] = 'error.html';
          $data['error'] = $e->getMessage();
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
    require_once('User.model.php');
		$data['products'] = ProductModel::getAllProducts();
		$data['states'] = UserModel::getStates();
		$data['categories'] = UploadModel::getCategories();

		if(isset($_SESSION['user'])) {
			$data['template'] = 'index.html';
      $data['user'] = UserModel::getPersonalData();
		} else {
			$data['template'] = 'index.html';
		}
		return $data;
  	}

//Skickar användaren till Mina uppgifter
  	public static function personal(){
  		require_once('User.model.php');
  		require_once('Upload.model.php');
    	$data['states'] = UserModel::getStates();
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
          $data['template'] = 'error.html';
        }
      }
      else {
        $data['redirect'] = '?/User/personal';
      }
      return $data;
  	}

     //Hämtar uppgifter från användarregistreringsformuläret
    public static function completePayment() {
        require_once('User.model.php');
        require_once('Product.model.php');
        try {
          $result = UserModel::updatePaidMembership();
          $data['template'] = 'myProfile.html';
            $data['user']=$result;
          $data['products']=ProductModel::getMyProducts();
        } catch (Exception $e) {
          $data['template'] = 'error.html';
          $data['error'] = $e->getMessage();
        }
      return $data;
    }
}