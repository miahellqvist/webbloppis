<?php

class Review{

//Visar mina recensioner
	public static function myReviews() {
		require_once('Review.model.php');
    require_once('User.model.php');
    $data=array();

    try{
        $result=ReviewModel::getMyReviews();
        if ($result) {
          $data['reviews'] = $result;
          $data['template'] = 'userReviews.html';
        } 
      }
      catch(Exception $e){
        $data['error']= $e->getMessage();
        $data['template']='error.html';
      }
     
      return $data;
    }

//Visar säljarens recensioner
  public static function sellerReviews($url_parts) {
    require_once('Review.model.php');
    require_once('User.model.php');
    require_once('Upload.model.php');
<<<<<<< HEAD
    require_once('Product.model.php');
=======
>>>>>>> ba25d166856fee68a4e27bdecb0ef8d93c80fcb4
    $data=array();

    if (count($url_parts) > 0) {
      $user_id=$url_parts[0];
      try{
        $result=ReviewModel::getSellerReviews($user_id);
        if ($result) {
          $data['states'] = UserModel::getStates();
          $data['categories'] = UploadModel::getCategories();
          $data['reviews'] = $result;
          $data['user_id'] = $user_id;
          $data['template'] = 'userReviews.html';
        }
      }
      catch(Exception $e) {
        $data['error'] = $e->getMessage();
        $data['template']='error.html';
<<<<<<< HEAD
        $data['states'] = UserModel::getStates();
        $data['categories'] = UploadModel::getCategories();
      }
      return $data;
    }

  }

//Visar recensionformuläret
  public static function reviewForm($url_parts) {
    require_once('Review.model.php');
    require_once('User.model.php');
    $data=array();
    
    if (count($url_parts) > 0) {
      $user_id=$url_parts[0];
      try{
          $result=ReviewModel::checkIfReviewExists($user_id);
          if ($result) {
            $data['rates'] = ReviewModel::getRates();
            $data['user_id'] = $user_id;
            $data['template'] = 'reviewForm.html';
          }
          
        }
        catch(Exception $e) {
          $data['error'] = $e->getMessage();
          $data['template']='error.html';
        }
    }
    return $data;
  }

//Publicerar en recension
  public static function postReview($url_parts) {
    require_once('Review.model.php');
    $data=array();

   
    

      if (isset($_POST['sendreview'])) {
        $rate = $_POST['rate'];
        $comment  = $_POST['comment'];
        $seller_id  = $_POST['seller_id'];

        try {
          $result = ReviewModel::reviewPosted($rate, $comment, $seller_id);
          $data['template'] = 'reviewSuccess.html';
        }
        catch(Exception $e) {
          $data['error'] = $e->getMessage();
          $data['template']='error.html';
        }
      }  
    
    return $data;
  }  
  

=======
        //$data['states'] = UserModel::getStates();
        //$data['categories'] = UploadModel::getCategories();
      }
      return $data;
    }

  }

  public static function reviewForm($url_parts) {
    require_once('Review.model.php');
    require_once('User.model.php');
    $data=array();
    
    if (count($url_parts) > 0) {
      $user_id=$url_parts[0];
      try{
          $result=ReviewModel::checkIfReviewExists($user_id);
            $data['rates'] = ReviewModel::getRates();
            $data['user_id'] = $user_id;
            $data['template'] = 'reviewForm.html';
        }
        catch(Exception $e) {
          $data['error'] = $e->getMessage();
          $data['template']='error.html';
        }
    }
    return $data;
  }

  public static function postReview($url_parts) {
    require_once('Review.model.php');
      $data = array();
      echo 'a';

    if (count($url_parts) > 0) {
      $user_id = $url_parts[2];

      if (isset($_POST['sendreview'])) {
        $rate = $_POST['rate'];
        $comment  = $_POST['comment'];
        $seller_id = $user_id;
        echo 'd';
        try {
          $result = ReviewModel::reviewPosted($rate, $comment, $seller_id);
          $data['template'] = 'reviewSuccess.html';
        }
        catch(Exception $e) {
          $data['error'] = $e->getMessage();
          $data['template']= 'error.html';
        }
      }
      else {
        $data['redirect'] = '?/User/home';
      }
      return $data;
    }
    echo 'b';
  }

     /* public static function postReview($url_parts) {
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
    }*/
>>>>>>> ba25d166856fee68a4e27bdecb0ef8d93c80fcb4
}