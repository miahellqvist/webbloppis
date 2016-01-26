<?php
//a href='?/posts/all'
session_start();
require_once("classes/Connection.php");

//Databaskopplingen
$dbCon=Connection::connect();

//Skriver ut svenska bokstäver
mysqli_query($dbCon, "SET NAMES 'utf8'") or die(mysql_error());
mysqli_query($dbCon, "SET CHARACTER SET 'utf8'") or die(mysql_error());

# $url_params blir en array med alla "värden" som står efter ? avgränsade med /
# ex. /Posts/single/11 kommer ge en array med 3 värden som är Posts, single och 11
$url_parts = getUrlParts($_GET); 
if(count($url_parts)>=2) {
	$class = array_shift($url_parts); //första delen i url:en
	$method = array_shift($url_parts); //andra delen i url:en
	require_once("classes/".$class.".controller.php");
	$data = $class::$method($url_parts); 
	$data['session']=$_SESSION;

    if(isset($data['redirect'])){
	   header("Location: ".$data['redirect']);
    } 
    else {
		$twig = startTwig();
		
		if(isset($data['template'])) 
		{
			$twig = startTwig();
			$template = $data['template'];
	    }
		 
		echo $twig->render($template, $data);
    }
																																						
}
else {
	require_once("classes/User.controller.php");
	$twig = startTwig();
	$data = User::home();
	echo $twig->render($data['template'], $data);
}
function getUrlParts($get) {
	if(isset($get) and count($get)>0) {
		$get_params = array_keys($get);
		$url = $get_params[0];
		$url_parts = explode("/",$url);
		foreach($url_parts as $k => $v){
			if($v) $array[] = $v;
		}
		$url_parts = $array;
		return $url_parts; 
	} 
	else {
		return array();
	}	
}
function startTwig() {
	require_once('Twig/lib/Twig/Autoloader.php');
	Twig_Autoloader::register();
	$loader = new Twig_Loader_Filesystem('templates/');
	return $twig = new Twig_Environment($loader);
}