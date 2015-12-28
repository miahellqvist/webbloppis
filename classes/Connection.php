<?php

class Connection{
	
	protected static $connection;

	public function connect()
	{
		if(!isset(self::$connection))
		{
			//Filen .ini innehåller databasuppkopplingsinfo som databasnamn, lösenord m.m.
			$config=parse_ini_file('./config.ini');//denna fil läggs utanför den mappar användare kan nå för att skydda databasinfo
			self::$connection = new mysqli('localhost',$config['username'],$config['password'],$config['dbname']);
		}
		return self::$connection;
	}

}