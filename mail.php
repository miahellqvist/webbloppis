<?php

function __autoload($class_name) {
	include 'classes/'.$class_name.'.php';
}

$dbCon = Connection::connect();
$query = new Query();

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
	<input type="email" name="emailsender" required><br>
	Ärende: 
	<input type="text" name="subject" required><br>
	Meddelande: 
	<textarea name="message" cols="45" rows="6"></textarea><br>
	<input type="submit" name="submit" value="Skicka">

</form>

</body>
</html>
<?php

//Kontroll och validering av formuläret med htmlentities för säkerhet.

if (isset($_POST['sendername'], $_POST['senderemail'], $_POST['subject'], $_POST['message'])) {
	if (empty($_POST['sendername'])) {
		$errors[] = 'Var vänlig fyll i ditt namn.';
	}else{
		$sendername = htmlentities($_POST['sendername']);
	}

	if (empty($_POST['subject'])) {
		$errors[] = 'Var vänlig fyll i ärendefältet.';
	}else{
		$subject = htmlentities($_POST['subject']);
	}

	if (empty($_POST['message'])) {
		$errors[] = 'Var vänlig skriv in ett meddelande.';
	}else{
		$message = htmlentities($_POST['message']);
	}

	//validering och filtrering av mailadressen för att minska risken att personer använder
	//en påhittad epost.

	if (empty($_POST['senderemail'])) {
		$errors[] = 'Var vänlig skriv in din e-postadress.';
	}else if (strlen($_POST['senderemail']) > 347){
		$errors[] = "E-postadressen är för lång. Var vänlig ange en giltig e-postadress.";
	}else if (filter_var($_POST['senderemail'], FILTER_VALIDATE_EMAIL) === false) {
		$errors[] = 'Var vänlig ange en giltig e-postadress.';
	}else{
		$senderemail = "<" . htmlentities($_POST['senderemail']) . ">";
	}
}

$id=2;

echo $query->getUsermail($id);

?>