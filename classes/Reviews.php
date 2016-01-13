<?php

class Reviews {

	//Reviewknapp
	function reviewButton() {
		$html="";
		$html .="<form action='' method='post'>
				<input type='submit' name='viewreviews' value='Visa recensioner'>
			</form>
		";
		return $this->html=$html;
	}

	function writeReviewButton() {
		$html="";
		$html .="<form action='' method='post'>
				<input type='submit' name='writereview' value='Skriv en recension'>
			</form>
		";
		return $this->html=$html;
	}

	//Reviewformulär
	function showReviews($dbCon, $query) {
		$html="";
		$user_id=$dbCon->real_escape_string($_GET['user_id']);
		$query = ("SELECT * FROM review, user, rate 
			WHERE review.user_id=user.user_id
			AND review.rate_id=rate.rate_id
			AND user.user_id='$user_id'
			ORDER BY date_comment DESC");

		if ($result = $dbCon->query($query)){
			while ($row = $result->fetch_assoc()){
				$name=$row['buyer_name'];
				$rate=$row['rate_name'];
				$comment=$row['comment'];
				$date=$row['date_comment'];

				$html .="".
				$name."<br>".$date."<br>Säljares betyg: ".$rate."<br>".$comment."<br><br>";
			}
			return $this->html = $html;
		}
	}

	function reviewForm($dbCon, $query) {
		$html="";

		if (isset($_COOKIE['user'])) {
			$html .="<h3>Sorry, you can not write another review.</h3>";
		}
		else {
			
			$this->showReviews($dbCon, $query);
			$rate="";
			
			if ($result = $dbCon->query($query->getRate())){
			    while($row = $result->fetch_assoc()){
			    	$rate .="<option value='".$row['rate_id']."'>".$row['rate_name']."</option>";
			    }
			}	    
			    $html .="
					<form action='' method='post'>
					<h3>Skriv din recension</h3>
					<p>Namn:</p>
					<input type='text' name='buyerName'>
					<p>Betyg: 
					<select name='rate'>
						<option value='0'>-- Välj ett betyg --</option>".
						$rate.
						"</select><br></p>
					<p>Kommentar:</p>
					<textarea name='comment' cols='45' rows='6'></textarea><br><br>
					<input type='submit' name='sendreview' value='Skicka din recension'>
					</form>";		
			 
		}return $this->html = $html;
	}

	function sendReview($dbCon, $query) {
		$user_id=$dbCon->real_escape_string($_GET['user_id']);
		$name=$dbCon->real_escape_string($_POST['buyerName']);
		$rate=$dbCon->real_escape_string($_POST['rate']);
		$comment=$dbCon->real_escape_string($_POST['comment']);

		$query = ("INSERT INTO review 
					(user_id, buyer_name, rate_id, comment, date_comment)
					VALUES ('$user_id', '$name', '$rate', '$comment', CURRENT_TIMESTAMP)");
		
		$dbCon->query($query);
		
		setcookie('user', time() + (86400 * 30));
		return $this->showReviews($dbCon, $query);
		
	}
}