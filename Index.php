<?php
include_once('Html.php');
include_once('User.php');

if(isset($_POST['login'])){
	$username = $_POST['username'];
	$password = $_POST['password'];

	$object = new User();
	$object->login($username, $password);
}