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
$updateProduct = new UpdateProduct();
$review = new Reviews();

mysqli_query($dbCon, "SET NAMES 'utf8'") or die(mysql_error());
mysqli_query($dbCon, "SET CHARACTER SET 'utf8'") or die(mysql_error());

//NÄR MAN KOMMER IN PÅ SIDAN VISAS ANNONSER OCH INLOGGNINGSFORMULÄR
//OM MAN HAR TRYCKT PÅ LOGIN KNAPPEN GÖRS EN KONTROLL AV ANV.NAMN & PASS OCH MAN LOGGAS IN
if (isset($_POST['login'])) {
	$user->login($dbCon);
}

//OM SESSION HAR SATTS VISAS TITLE, USERS NAMN OCH LOGOUTKNAPP
//DETTA ÄR EN VÄLDIGT LÅNG IF-SATS MED MÅNGA ELSEIF

if (isset($_SESSION['username'])) {
	
	$data = array(
		'name' =>$query->getUserName($dbCon),
		'user_id'=>$query->getUserName($dbCon),
		'session'=> $_SESSION
	);

	if (isset($_GET['index'])) {
		$data=array(
			'name' =>$query->getUserName($dbCon),
			'session'=> $_SESSION,
			'printProductThumbnail' => $upload->printProductThumbnail($dbCon, $query),
			'searchForm' => $print->searchProductForm($dbCon),
		);
	}

	if (isset($_GET['id'])) {
		$data=array(
			'name' =>$query->getUserName($dbCon),
			'session'=> $_SESSION,
			'viewProductAdd' => $upload->viewProductAdd($dbCon, $query)
		);
	}

	//SKRIVER UT MEJLFORMULÄRET
	if (isset($_GET['Mejl']) && isset($_GET['id'])) {
		$data = array(
			'name' =>$query->getUserName($dbCon),
			'session'=> $_SESSION,
			'printMailform'=>$upload->viewProductAdd($dbCon, $query)
		);
	}
	//SKICKAR ETT MEJL TILL SÄLJAREN
	if (isset($_POST['send'])) {
		$data = array (
			'name' =>$query->getUserName($dbCon),
			'session'=> $_SESSION,
			'emailSent'=>$contact->sendEmail($dbCon, $query)
		);
	}

	if (isset($_GET['user_id'])) {
		$data = array(
			'name' =>$query->getUserName($dbCon),
			'session'=> $_SESSION,
			'printUserProducts' =>$upload->printUserProducts($dbCon, $query),
			'rateButton' =>$review->reviewButton($dbCon)
		);

		if (isset($_GET['VisaRecensioner']) && isset($_GET['user_id'])) {
			$data=array(
				'name' =>$query->getUserName($dbCon),
				'session'=> $_SESSION,
				'showReviews'=>$review->showReviews($dbCon),
				'writeReviewButton'=>$review->writeReviewButton($dbCon)
			);
		}
		//Skriver ut recensionsformulär
		if (isset($_GET['SkrivRecension']) && isset($_GET['user_id'])) {
			$data = array(
				'name' =>$query->getUserName($dbCon),
				'session'=> $_SESSION,
				'reviewForm'=>$review->reviewForm($dbCon)
			);
		}

		//Skicka en recension
		if (isset($_POST['sendreview'])) {
			$data = array(
				'name' =>$query->getUserName($dbCon),
				'session'=> $_SESSION,
				'sendReview'=>$review->sendReview($dbCon, $query)
			);
		}
	}

	if (isset($_GET['MinaOmdomen']) && isset($_GET['user_id'])) {
		$data=array(
			'name' =>$query->getUserName($dbCon),
			'user_id'=>$query->getUserName($dbCon),
			'session'=> $_SESSION,
			'showReviews'=>$review->showReviews($dbCon)
		);
	}

	if (isset($_GET['MinSida'])) {
		$data=array(
			'name' =>$query->getUserName($dbCon),
			'session'=> $_SESSION,
			'viewPersonalAds' => $print->viewPersonalAds($dbCon,$query)
		);
	}

	if (isset($_GET['NyAnnons'])) {
		$data = array(
			'name' =>$query->getUserName($dbCon),
			'newProductForm' =>$print->newProductForm($dbCon),
			'session'=> $_SESSION
		);
	}

	if (isset($_POST['add'])) {
		$data=array(
			'name' =>$query->getUserName($dbCon),
			'session'=> $_SESSION,
			'productAdded'=>$upload->addProduct($dbCon)
		);
	}

	//Ändrar information om produkten
	if(isset($_GET['MinSida']) && isset($_GET['id'])){
		$data = array(
			'name' =>$query->getUserName($dbCon),
			'session'=> $_SESSION,
			'updateProduct' =>$updateProduct->productData($dbCon,$query)
		);

		if (isset($_POST['updateProduct'])) {
			$data = array(
				'name' =>$query->getUserName($dbCon),
				'session'=> $_SESSION,
				'productUpdated' =>$updateProduct->updateProductData($dbCon, $query)
			);
		}

		if (isset($_POST['deleteProduct'])) {
			$data = array(
				'name' =>$query->getUserName($dbCon),
				'session'=> $_SESSION,
				'deleteProduct' =>$updateProduct->deleteProduct($dbCon)
			);
		}
	}

	//Uppdatera mina personliga uppgifter
	if (isset($_GET['MinaUppgifter'])) {
		$data = array(
			'name' =>$query->getUserName($dbCon),
			'personalData' => $personalData->personalData($dbCon, $query),
			'session'=> $_SESSION
		);
	}
	if (isset($_POST['updatePersonal'])) {
		$data = array(
			'name' =>$query->getUserName($dbCon),
			'session'=> $_SESSION,
			'personalUpdated' => $personalData->updatePersonalData($dbCon)
		);
	}
	if (isset($_POST['deletePersonal'])) {
		$data = array(
			'name' =>$query->getUserName($dbCon),
			'session'=> $_SESSION,
			'deletePersonal' =>$personalData->deletePersonal($dbCon)
		);
	}
}

//SKRIVER UT HELA ANNONSEN
elseif(isset($_GET['id'])){
	$data = array(
		'viewProductAdd' => $upload->viewProductAdd($dbCon, $query)
	);
	//SKRIVER UT MEJLFORMULÄRET
	if (isset($_GET['Mejl']) && isset($_GET['id'])) {
		$data=array(
			'printMailform'=>$upload->viewProductAdd($dbCon, $query)
		);
	}
	//SKICKAR ETT MEJL TILL SÄLJAREN
	if (isset($_POST['send'])) {
		$data = array (
			'emailSent' =>$contact->sendEmail($dbCon, $query)
		);
	}
	
}
//SKRIVER UT ALLA ANNONSER SOM TILLHÖR EN KATEGORI
elseif (isset($_GET['category'])) {
	$data = array(
		'printCategoryProducts' =>$upload->printCategoryProducts($dbCon, $query)
	);
}
//SKRIVER UT ALLA ANNONSER SOM TILLHÖR EN SUBKATEGORI
elseif (isset($_GET['subcategory'])) {
	$data = array(
		'printSubcategoryProducts' =>$upload->printSubcategoryProducts($dbCon, $query)
	);
}
//SKRIVER UT ALLA ANNONSER SOM TILLHÖR ETT LÄN
elseif (isset($_GET['state'])) {
	$data = array(
		'printStateProducts' =>$upload->printStateProducts($dbCon, $query)
	);
}
//DET VISAS ALLA ANNONSER SOM TILLHÖR EN SÄLJARE
elseif (isset($_GET['user_id'])) {
	$data = array(
		'printUserProducts' =>$upload->printUserProducts($dbCon, $query),
		'rateButton' =>$review->reviewButton($dbCon)
	);

	//Skriver ut alla recensioner
	if (isset($_GET['VisaRecensioner']) && isset($_GET['user_id'])) {
		$data = array(
			'showReviews'=>$review->showReviews($dbCon)
		);
	}
}

//ANNARS VISAS TITEL OCH LOGINFORMULÄR
else {
	$data = array(
		'printProductThumbnail' => $upload->printProductThumbnail($dbCon, $query),
		'searchForm' => $print->searchProductForm($dbCon)
		
	);
}//HÄR SLUTAR DEN LÅNGA IF-SATSEN

//OM MAN HAR TRYCKT PÅ LOGOUT KNAPPEN KOMMER MAN TILLBAKA TILL LOGIN FORMULÄRET
//OCH ETT MEDDELANDE OM ATT MAN ÄR UTLOGGAT SKRIVS UT
if (isset($_POST['logout'])) {
	$user->logout();
}

//OM MAN HAR TRYCKT PÅ CREATE NEW ACCOUNT KNAPP VISAS DET ETT FORMULÄR FÖR ATT SKAPA ETT KONTO
if (isset($_GET['SkapaKonto'])) {
	$data = array(
		'createAccountForm' =>$print->createAccountForm($dbCon)
	);
}

//SKAPA ETT KONTO
if (isset($_POST['createAccount'])){
	$user->createAccount($dbCon);
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

