<?php

class Reviews {

	//Reviewknapp
	function reviewButton($dbCon) {
		$user_id=$dbCon->real_escape_string($_GET['user_id']);
		return "<a href='?VisaRecensioner&user_id=$user_id'>Visa Recensioner</a>";
	}

	function writeReviewButton($dbCon) {
		$user_id=$dbCon->real_escape_string($_GET['user_id']);
		return "<a href='?SkrivRecension&user_id=$user_id'>Skriv en recension</a>";
	}

	//Visar recensioner
	function showReviews($dbCon) {
		$user_id=$dbCon->real_escape_string($_GET['user_id']);
		$query = ("SELECT review.buyer_name, rate.rate_name, review.comment, review.date_comment
				FROM review, rate, user
				WHERE review.rate_id=rate.rate_id
				AND user.user_id='$user_id'
				AND review.seller_id='$user_id'
				ORDER BY date_comment DESC");

		if ($result = $dbCon->query($query)){
			while ($row = $result->fetch_assoc())
			{
				$items[]=$row;
			}
			return $items;
		}
	}

	//Recensionsformulär
	function reviewForm($dbCon) {

		$username=$dbCon->real_escape_string($_SESSION['username']);
		$user_id=$dbCon->real_escape_string($_GET['user_id']);
		
		$query="SELECT * FROM user, review
				WHERE user.username='$username'
				AND review.seller_id='$user_id'";
		
		$result = $dbCon->query($query);

		if ($result->num_rows == 0) {
			$query = ("SELECT *  FROM rate");	
			if ($result = $dbCon->query($query)){
				while($row = $result->fetch_assoc()){
					$items[]=$row;
				}
				return $items;
			}
		}
		else{
			while ($row = $result->fetch_assoc()){
				$user_name=$row['name'];
				$user_id_database=$row['user_id'];
				$seller_id_database=$row['seller_id'];
				$buyer_id_database=$row['buyer_id'];
				
				if ($user_id_database == $user_id) {
					echo "Sorry ".$user_name.". Du får inte skriva en recension om dig själv! ;)";
				}
				elseif ($seller_id_database == $user_id) {
					echo "Sorry ".$user_name.". Du får skriva bara en recension per säljare!";
				}
			}
		}
		
	}

	//skicka recension
	function sendReview($dbCon) {
		$username=$dbCon->real_escape_string($_SESSION['username']);
		$query="SELECT * FROM user WHERE username='$username'";
		$result = $dbCon->query($query);
		$row = $result->fetch_assoc();

		$buyer_id=$dbCon->real_escape_string($row['user_id']);
		$buyer_name=$dbCon->real_escape_string($row['name']);
		$seller_id=$dbCon->real_escape_string($_GET['user_id']);
		$rate=$dbCon->real_escape_string($_POST['rate']);
		$comment=$dbCon->real_escape_string($_POST['comment']);

		$query = ("INSERT INTO review 
					(buyer_id, buyer_name, seller_id, rate_id, comment, date_comment)
					VALUES ('$buyer_id', '$buyer_name', '$seller_id', '$rate', '$comment', CURRENT_TIMESTAMP)");
			
		$dbCon->query($query);

		return $this->showReviews($dbCon);
	}
}