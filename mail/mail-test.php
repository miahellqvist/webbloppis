<?php
session_start();

//LÄSER IN KLASSER
function __autoload($class_name) {
	include 'classes/'.$class_name.'.php';
}
?>

<!doctype html>
<html>
<head>
	<title>Mailsida</title>
	<meta charset="utf-8">
</head>
<body>
		
<form action="" method="post">
	
	Ditt namn: 
	<input type="text" name"sendername" required autofocus><br>
	Din e-post: 
	<input type="email" name="senderemail" required><br>
	Mottagarens e-post:
	<input type="email" name="receiveremail" required><br>
	Ärende: 
	<input type="text" name="subject" required><br>
	Meddelande: 
	<textarea name="message" cols="45" rows="6"></textarea><br>
	<input type="submit" name="submit" value="Skicka">

</form>

</body>
</html>

<?php
$mail = new validateMail();
$query = new Query();

$sender = $mail->valSendername();
$subject = $mail->valSubject();
$message = $mail->valMessage();
$senderemail = $mail->valSenderemail();
$receiveremail = $mail->valReceiveremail();

//$mailquery = $query->getUsermail;

if (isset($_POST['submit'])) {
	mail($receiveremail, $subject, $message, 'From: ' . $senderemail);
}
?>