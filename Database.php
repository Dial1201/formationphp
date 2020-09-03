<?php

class DataBase {

	private static $dbHost = "localhost";
	private static $dbName = "Bank";
	private static $dbUser = "root";
	private static $dbUserPassword = "";
	
	private static $connection = null;



	public static function connect() {
		/**
		 * Le mode exception permet à PDO de nous prévenir quand on fait une erreur
		 * le d'exploitation FETCH_ASSOC veut dire qu'on exploitera les données sous forme de tableaux associatifs
		 */

		try 

		{
			self::$connection = new PDO("mysql:host=" . self::$dbHost . ";dbname=" . self::$dbName,self::$dbUser,self::$dbUserPassword,
			array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
					PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC));
		}

		catch(Exception $e)
				 
		{
			die('Erreur : '.$e->getMessage());
		}
		return self::$connection;
	}

	public static function disconnect() {
		self::$connection = null;
	}

}


