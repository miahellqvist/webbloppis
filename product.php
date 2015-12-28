<?php

//LÄSER IN KLASSER
function __autoload($class_name) {
	include 'classes/'.$class_name.'.php';
}

//DATABASKOPPLINGEN
$dbCon = Connection::connect();

//NYA OBJEKT
$user = new User();
$upload = New UploadProduct();

$upload->upload($dbCon);

echo PrintPage::newProduct(isset($row));