<?php
session_start();

function __autoload($class_name) {
	include 'classes/'.$class_name.'.php';
}

$dbCon = Connection::getInstance();
$user = new User();
$print = new PrintPage();

if (!isset($_POST['login'])) {
	$print->printLoginForm();
}
else {
	$user->login($dbCon);
}

if (isset($_POST['logout'])) {
	$user->logout();
}
