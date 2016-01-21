<?php

class Review{

	public static function myReviews() {
		require_once('Review.model.php');
    require_once('User.model.php');
    $data=array();

    $result=ReviewModel::getMyReviews();
    if ($result) {  	
    	$data['user'] = UserModel::getPersonalData();
    	$data['reviews'] = $result;
    	$data['template'] = 'reviewsOnline.html';
    }
    else{
      $data['template'] = 'reviewError.html';
      $data['user'] = UserModel::getPersonalData();
    }
    return $data;
	}

  public static function sellerReviews($url_parts) {
    require_once('Review.model.php');
    $data=array();

    if (count($url_parts) > 0) {
      $user_id=$url_parts[0];

      $result=ReviewModel::getSellerReviews($user_id);
      if ($result) {
        $data['reviews'] = $result;
        $data['product'] = ProductModel::getProductData($id);
        $data['template'] = 'reviewsOffline.html';
      }
      else{
        $data['template'] = 'reviewError.html';
      }
    }
    return $data;
  }



}