<?php

class Review{

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

  public static function sellerReviews($url_parts) {
    require_once('Review.model.php');
    $data=array();

    if (count($url_parts) > 0) {
      $user_id=$url_parts[0];

      if (isset($_SESSION['user'])) {
        try{
          $result=ReviewModel::getSellerReviews($user_id);
          if ($result) {
            $data['reviews'] = $result;
            $data['user_id'] = $user_id;
            $data['template'] = 'userReviews.html';
          }
        }
        catch(Exception $e) {
          $data['error'] = $e->getMessage();
          $data['template']='error.html';
        }
      }
      else{
        try{
          $result=ReviewModel::getSellerReviews($user_id);
          if ($result) {
            $data['reviews'] = $result;
            $data['user_id'] = $user_id;
            $data['template'] = 'userReviews.html';
          }
        }
        catch(Exception $e) {
          $data['error'] = $e->getMessage();
          $data['template']='error.html';
        }
      }
     
      return $data;
    }

  }

  public static function reviewForm($url_parts) {
    require_once('Review.model.php');
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

  public static function postReview() {
    require_once('Review.model.php');
    $data=array();

    if (isset($_POST['sendreview'])) {
      
    }
  }

}