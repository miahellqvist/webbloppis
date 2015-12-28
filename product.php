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

//UPPLADDNING AV TEXT, BILD OCH KATEGORI FÖR ANNONSER
$upload->upload($dbCon);

//SKRIVER UT ANNONS-INLÄGGNING-FORMULÄR
echo PrintPage::newProduct(isset($row));