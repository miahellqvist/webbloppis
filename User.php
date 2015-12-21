<?php

include_once('Connection.php');

class User {

	private $db;

	function __construct() 
	{
		$this->db = new connection();
		$this->db = $this->db->dbConnect();
	}

	function login($username, $password)
	{
		if(!empty($username) && !empty($password)){
			$query = $this->db->prepare("select * from user where username=? and password=?");
			$query->bindParam(1, $username);
			$query->bindParam(2, $password);
			$query->execute();

			if($query->rowCount() == 1){
				echo "User verified, Acces granted.";
			}else{
				echo "Incorrect username or password";
			}
		}else {
			echo "Please enter username and password";
		}
	}
}