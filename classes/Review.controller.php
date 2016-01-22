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
        $data['template'] = 'reviewsOnline.html';
        } 
      }
      catch(Exception $e){
        $data['error']= $e->getMessage();
        $data['template']='errorloggedin.html';
      }
     
      return $data;
    }

  public static function sellerReviews($url_parts) {
    require_once('Review.model.php');
    $data=array();

    if (count($url_parts) > 0) {
      $user_id=$url_parts[0];

    try{
        $result=ReviewModel::getSellerReviews($user_id);
          if ($result) {
           $data['reviews'] = $result;
           $data['user_id'] = $user_id;
          $data['template'] = 'reviewsOffline.html';
      } 
      }
      catch(Exception $e){
        $data['error']= $e->getMessage();
        $data['template']='error.html';
      }
     
      return $data;
    }
  }

}