<?php
session_start();

//LÄSER IN KLASSER
function __autoload($class_name) {
	include 'classes/'.$class_name.'.php';
}

//DATABASKOPPLINGEN
$dbCon = Connection::getInstance();

//NYA OBJEKT
$user = new User();
$print = new PrintPage();

//OM MAN HAR TRYCKT PÅ LOGIN KNAPP VISAS DET LOGIN FORMULÄR
if (isset($_POST['login'])) {
	$user->login($dbCon);
}

//OM SESSION HAR SATT VISAS DET TITLE, USERS NAMN OCH LOGOUT FORMULÄR
if (isset($_SESSION['username'])) {
	$data = array(
		'title' => 'Webbloppis',
		'name' =>$print->printName($dbCon),
		'logoutForm' =>$print->printLogoutForm()
	);
}
//ANNARS VISAS DET TITLE OCH LOGIN FORMULÄR
else {
	$data = array(
		'title' => 'Webbloppis',
		'loginForm' =>$print->printLoginForm()
	);
}

//OM MAN HAR TRYCKT PÅ LOGOUT KNAPP VISAS DET TITLE, LOGOUT MEDDELANDE OCH LOGIN FORMULÄR
if (isset($_POST['logout'])) {
	$data = array(
		'title' => 'Webbloppis',
		'logoutMsg' =>$user->logout(),
		'loginForm' =>$print->printLoginForm()
	);
}

//Läser in Twig
require_once 'Twig/lib/Twig/Autoloader.php';
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem('Templates/');
$twig = new Twig_Environment($loader);
echo $twig->render('index.html', $data);