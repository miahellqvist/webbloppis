<?php
include_once('Html.php');
include_once('User.php');

$user = new User();

if (isset($_POST['username'])) {
	$user->login();
}