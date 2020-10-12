<?php
 ini_set('display_errors', 1);
 ini_set('display_startup_errors', 1);
 error_reporting(E_ALL);


 $dbHost = "localhost";
 $dbUser = "test";
 $dbPass = "password";
 $dbName = "database";

	try {
			$dsn = "mysql:host=".$dbHost.";dbname=".$dbName;
			$pdo = new PDO($dsn,$dbUser,$dbPass);
		} catch (Exception $e) {
			error_log($e->getMessage());
  			echo('Something weird happened:')." ".$e;
		}

		//$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
		//return $pdo;

?>
