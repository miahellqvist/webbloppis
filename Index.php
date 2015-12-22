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

//OM MAN INTE HAR TRYCKT PÅ LOGIN KNAPP VISAS LOGIN FORMULÄR
if (!isset($_POST['login'])) {
	$print->printLoginForm();
}
//ANNARS KOLLAR DET IFALL DET FINNS DEN USER I DATABASEN
else {
	$user->login($dbCon);
}

if (isset($_POST['logout'])) {
	$user->logout();
}
