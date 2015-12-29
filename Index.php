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

$upload->upload($dbCon);



//OM MAN INTE ÄR INLOGGAD VISAS ALLA ANNONSER
if (!isset($_SESSION['username'])) {
	echo $upload->viewAddImage($dbCon, $query); //Ta bort denna echo när viewAddImage funkar i twig

	$data = array(
		'viewAddImage' => $upload->viewAddImage($dbCon, $query)
	);
}
elseif(isset($_GET['id'])){
	echo $upload->viewProductAdd($dbCon, $query);
}

//OM MAN HAR TRYCKT PÅ LOGIN KNAPP VISAS DET LOGIN FORMULÄR
if (isset($_POST['login'])) {
	$user->login($dbCon);
}

//OM MAN HAR TRYCKT PÅ LOGOUT KNAPP VISAS DET TITLE, LOGOUT MEDDELANDE OCH LOGIN FORMULÄR
if (isset($_POST['logout'])) {
	$data = array(
		'title' => 'Webbloppis',
		'logoutMsg' =>$user->logout(),
		'loginForm' =>$print->printLoginForm()
	);
}

//OM SESSION HAR SATT VISAS DET TITLE, USERS NAMN OCH LOGOUT FORMULÄR
if (isset($_SESSION['username'])) {
	$data = array(
		'title' => 'Webbloppis',
		'name' =>$print->printName($dbCon),
		'logoutForm' =>$print->printLogoutForm(),
		'newProductForm' =>$print -> newProduct($dbCon)
	);
}
//ANNARS VISAS DET TITLE OCH LOGIN FORMULÄR
else {
	$data = array(
		'title' => 'Webbloppis',
		'loginForm' =>$print->printLoginForm()
	);
}

//OM MAN HAR TRYCKT PÅ CREATE NEW ACCOUNT KNAPP VISAS DET ETT FORMULÄR FÖR ATT SKAPA ETT KONTO
if (isset($_POST['newAccount'])) {
	$data = array(
		'createAccountForm' =>$print->createAccountForm()
	);
}

//SKAPA ETT KONTO
if (isset($_POST['createAccount'])){
	$user->createAccount($dbCon);
}



//Läser in Twig
require_once 'Twig/lib/Twig/Autoloader.php';
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem('templates/');
$twig = new Twig_Environment($loader);
echo $twig->render('index.html', $data);