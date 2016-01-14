<?php
session_start();

//LÄSER IN KLASSER
function __autoload($class_name) {
	include 'classes/'.$class_name.'.php';
}

//DATABASKOPPLINGEN
$dbCon = Connection::connect();

//NYA OBJEKT
$user = new User();
$print = new PrintPage();
$upload = new UploadProduct();
$query = new Query();
$contact = new Contact();
$personalData = new UpdatePersonal();
$updateAnnons = new UpdateAnnons();
$review = new Reviews();

mysqli_query($dbCon, "SET NAMES 'utf8'") or die(mysql_error());
mysqli_query($dbCon, "SET CHARACTER SET 'utf8'") or die(mysql_error());

//NÄR MAN KOMMER IN PÅ SIDAN VISAS ANNONSER OCH INLOGGNINGSFORMULÄR
//OM MAN HAR TRYCKT PÅ LOGIN KNAPPEN GÖRS EN KONTROLL AV ANV.NAMN & PASS OCH MAN LOGGAS IN
if (isset($_POST['login'])) {
	$user->login($dbCon);
}

//NÄR MAN HAR LOGGATS IN KOMMER MAN TILL FORMULÄRET FÖR ATT LAGGA IN EN ANNONS
$upload->upload($dbCon);

//OM SESSION HAR SATTS VISAS TITLE, USERS NAMN OCH LOGOUTKNAPP
//DETTA ÄR EN VÄLDIGT LÅNG IF-SATS MED MÅNGA ELSEIF
if (isset($_SESSION['username'])) {
	if($upload -> countProducts($dbCon)==true)
	{
		$data = array(
			'name' =>$query->getUserName($dbCon),
			'logoutForm' =>$print->printLogoutForm(),
			'newProductForm' =>$print -> newProductForm($dbCon),
			'uploadProduct' =>$upload->upload($dbCon),
			'showProductsButton' =>$print->showProductsButton(),
			'updatePersonalButton' =>$print->updatePersonalInfoButton(),
			'showAllAnnonsButton'=>$print->showAllAnnonsButton(),
			'session'=> $_SESSION,
		);
	}
	else 
	{
		$data = array(
			'name' =>$print->printName($dbCon),
			'logoutForm' =>$print->printLogoutForm(),
			'countProducts' =>$upload ->countProducts($dbCon),
			'showProductsButton' =>$print->showProductsButton(),
			'updatePersonalButton' =>$print->updatePersonalInfoButton(),
			'viewAddImage' => $upload->viewAddImage($dbCon, $query),
		);
	}

	if (isset($_POST['showAllAnnons'])) {
		$data = array(
			'viewAddImage' => $upload->viewAddImage($dbCon, $query),
			'goBackToFirstLoggedInPage' => $print->goBackFromShowProductsButton()
		);
	}

	//VISAR ALLA ANVÄNDARENS ANNONSER
	if(isset($_POST['showProducts'])){
		$data = array(
			'viewPersonalAds' => $print->viewPersonalAds($dbCon,$query),
			'goBackToFirstLoggedInPage' => $print->goBackFromShowProductsButton()
		);
	}

	//Uppdatera mina personliga uppgifter
	if (isset($_POST['update'])) {
		$data = array(
			'personalData' => $personalData->personalData($dbCon, $query),
			'goBackToFirstLoggedInPage' => $print->goBackFromShowProductsButton()
		);
	}
	if (isset($_POST['updatePersonal'])) {
		$data = array(
			'personalUpdated' => $personalData->updatePersonalData($dbCon),
			'goBackToFirstLoggedInPage' => $print->goBackFromShowProductsButton()
		);
	}
	if (isset($_POST['deletePersonal'])) {
		$data = array(
			'deletePersonal' =>$personalData->deletePersonal($dbCon),
			'goBackToFirstLoggedInPage' => $print->goBackFromShowProductsButton()
		);
	}

	//Ändrar information om produkten
	if (isset($_GET['id'])) {
		$data = array(
			'updateAnnons' =>$updateAnnons->annonsData($dbCon,$query),
			'goBackToFirstLoggedInPage' => $print->goBackFromShowProductsButton()
		);

		if (isset($_POST['updateAnnons'])) {
			$data = array(
				'annonsUpdated' =>$updateAnnons->updateAnnonsData($dbCon, $query),
				'goBackToFirstLoggedInPage' => $print->goBackFromShowProductsButton()
			);
		}

		if (isset($_POST['deleteAnnons'])) {
			$data = array(
				'deleteAnnons' =>$updateAnnons->deleteAnnons($dbCon),
				'goBackToFirstLoggedInPage' => $print->goBackFromShowProductsButton()
			);
		}
	}
}

//SKRIVER UT HELA ANNONSEN
elseif(isset($_GET['id'])){
	$data = array(
		'viewProductAdd' => $upload->viewProductAdd($dbCon, $query),
		'openMailform' =>$print->openMailform()
	);
	//SKRIVER UT MEJLFORMULÄRET
	if (isset($_POST['writeemail'])) {
		$data = array(
			'printMailform'=>$print->printMailform()
		);
	}
	//SKICKAR ETT MEJL TILL SÄLJAREN
	if (isset($_POST['send'])) {
		$data = array (
			'emailSent' =>$contact->sendEmail($dbCon, $query),
			'openMailform' =>$print->openMailform(),
			'viewProductAdd' => $upload->viewProductAdd($dbCon, $query)
		);
	}
	
}
//SKRIVER UT ALLA ANNONSER SOM TILLHÖR EN KATEGORI
elseif (isset($_GET['category'])) {
	$data = array(
		'viewCategory' =>$upload->viewCategory($dbCon, $query)
	);
}
//SKRIVER UT ALLA ANNONSER SOM TILLHÖR EN SUBKATEGORI
elseif (isset($_GET['subcategory'])) {
	$data = array(
		'viewSubcategory' =>$upload->viewSubcategory($dbCon, $query)
	);
}
//SKRIVER UT ALLA ANNONSER SOM TILLHÖR EN LÄN
elseif (isset($_GET['state'])) {
	$data = array(
		'viewState' =>$upload->viewState($dbCon, $query)
	);
}
//DET VISAS ALLA ANNONSER SOM TILLHÖR EN SÄLJARE
elseif (isset($_GET['user_id'])) {
	$data = array(
		'viewProfile' =>$upload->viewProfile($dbCon, $query),
		'rateButton' =>$review->reviewButton()
	);

	//Skriver ut alla recensioner
	if (isset($_POST['viewreviews'])) {
		$data = array(
			'showReviews'=>$review->showReviews($dbCon, $query),
			'writeReviewButton'=>$review->writeReviewButton(),
			'goBackToFirstLoggedInPage' => $print->goBackFromShowProductsButton()
		);
	}

	//Skriver ut recensionformulär
	if (isset($_POST['writereview'])) {
		$data = array(
			'reviewForm'=>$review->reviewForm($dbCon, $query),
			'goBackToFirstLoggedInPage' => $print->goBackFromShowProductsButton()
		);
	}

	//Skicka en recension
	if (isset($_POST['sendreview'])) {
		$data = array(
			'sendReview'=>$review->sendReview($dbCon, $query),
			'goBackToFirstLoggedInPage' => $print->goBackFromShowProductsButton()
		);
	}
}

//ANNARS VISAS DET TITLE OCH LOGIN FORMULÄR
else {
	$data = array(
		//'loginForm' =>$print->printLoginForm(),
		'viewAddImage' => $upload->viewAddImage($dbCon, $query),
		'searchForm' => $print->searchProductForm($dbCon),
		'session'=> $_SESSION,
	);
}//HÄR SLUTAR DEN LÅNGA IF-SATSEN

//OM MAN HAR TRYCKT PÅ LOGOUT KNAPPEN KOMMER MAN TILLBAKA TILL LOGIN FORMULÄRET
//OCH ETT MEDDELANDE OM ATT MAN ÄR UTLOGGAT SKRIVS UT
if (isset($_POST['logout'])) {
	header('Location:index.php');
	$data = array(
		'logoutMsg' =>$user->logout(),
	);
}

//OM MAN HAR TRYCKT PÅ CREATE NEW ACCOUNT KNAPP VISAS DET ETT FORMULÄR FÖR ATT SKAPA ETT KONTO
if (isset($_POST['newAccount'])) {
	$data = array(
		'createAccountForm' =>$print->createAccountForm($dbCon)
	);
}

//SKAPA ETT KONTO
if (isset($_POST['createAccount'])){
	$data = array(
		'accountCreated' =>$user->createAccount($dbCon)
	);
}

//Om man har klickat på sök-knappen visas sökresultatet
if (isset($_POST['searchProduct'])){
	$data = array(
		'searchResult' => $print->searchResult($dbCon, $query),
	);
}

//Läser in Twig
require_once 'Twig/lib/Twig/Autoloader.php';
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem('templates/');
$twig = new Twig_Environment($loader);
echo $twig->render('index.html', $data);


