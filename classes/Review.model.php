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

		$result = $dbCon->query($query);
		
		if ($result->num_rows>0)
		{	
			$reviews = array();
			while ($review = $result->fetch_assoc())
			{
				$reviews[]=$review;
			}
			
			return $reviews;
		}
		else {
			throw new Exception('Du har inga omdömen.');
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

		$result = $dbCon->query($query);

		if ($result->num_rows>0)
		{	
			$reviews = array();
			while ($review = $result->fetch_assoc())
			{
				$reviews[]=$review;
			}
			
			return $reviews;
		}
		else {
			throw new Exception('Säljaren har inga omdömen.');
		}
	}

	public static function getRates() {
		$dbCon= Connection::connect();

		$query = ("SELECT *  FROM rate");	
		if ($result = $dbCon->query($query)){
			$rates=array();
			while ($rate = $result->fetch_assoc()) {
				$rates[]=$rate;
			} 		
		}
			return $rates;
	}

	public static function checkIfReviewExists($user_id) {
		$dbCon= Connection::connect();
		$username=$_SESSION['user']['username'];

		$query=("SELECT * FROM user, review
				WHERE user.username='$username'
				AND review.seller_id='$user_id'");

		$result = $dbCon->query($query);
		if ($result->num_rows == 0) {
			return true;
		}
		else{
			while($review = $result->fetch_assoc()){
				$user_name=$review['name'];
				$user_id_database=$review['user_id'];
				$seller_id_database=$review['seller_id'];
				$buyer_id_database=$review['buyer_id'];
				
				if ($user_id_database == $user_id) {
					throw new Exception('Sorry. Du får inte skriva en recension om dig själv!');
				}
				elseif ($seller_id_database == $user_id) {
					throw new Exception('Sorry. Du får skriva bara en recension per säljare!');
				}
			}
		}
	}

	/*public static function reviewPosted() {
		$dbCon= Connection::connect();
		$user_id=$_SESSION['user']['user_id'];
		$user_name=$_SESSION['user']['user_name'];


	}*/
}