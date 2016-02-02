<?php

class Review{

//Visar mina recensioner
	public static function myReviews() {
		require_once('Review.model.php');
    require_once('User.model.php');
    $data=array();

    try{
        $result=ReviewModel::getMyReviews();
        $data['reviews'] = $result;
        $data['template'] = 'userReviews.html'; 
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
    require_once('Product.model.php');
    $data=array();

    if (count($url_parts) > 0) {
      $user_id=$url_parts[0];
      try{
        $result=ReviewModel::getSellerReviews($user_id);
        $data['states'] = UserModel::getStates();
        $data['categories'] = UploadModel::getCategories();
        $data['reviews'] = $result;
        $data['user_id'] = $user_id;
        $data['template'] = 'userReviews.html';
      }
      catch(Exception $e) {
        $data['error'] = $e->getMessage();
        $data['template']='error.html';
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
  

}