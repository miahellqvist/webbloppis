<?php
class Connection{
	
	public function dbConnect() { //PDO=PHP Data Object
		return new PDO ("mysql:host=localhost; dbname=webbloppis", "root", "");
	}
}