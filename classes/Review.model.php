<?php

class ReviewModel {

	public static function getMyReviews() {
		$dbCon= Connection::connect();
		$user_id=$_SESSION['user']['user_id'];

		$query= ("SELECT review.buyer_name, rate.rate_name, review.comment, review.date_comment
				FROM review, rate, user
				WHERE review.rate_id=rate.rate_id
				AND user.user_id='$user_id'
				AND review.seller_id='$user_id'
				ORDER BY date_comment DESC");

		if ($result = $dbCon->query($query))
		{	
			$reviews = array();
			while ($review = $result->fetch_assoc())
			{
				$reviews[]=$review;
			}
			
			return $reviews;
		}
		else {
			die($dbCon->error);
		}
	}

	public static function getSellerReviews($user_id) {
		$dbCon= Connection::connect();

		$query= ("SELECT review.buyer_name, rate.rate_name, review.comment, review.date_comment
				FROM review, rate, user
				WHERE review.rate_id=rate.rate_id
				AND user.user_id='$user_id'
				AND review.seller_id='$user_id'
				ORDER BY date_comment DESC");

		if ($result = $dbCon->query($query))
		{	
			$reviews = array();
			while ($review = $result->fetch_assoc())
			{
				$reviews[]=$review;
			}
			
			return $reviews;
		}
		else {
			die($dbCon->error);
		}
	}
}