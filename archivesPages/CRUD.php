<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<?php
	define("DBHOST", "localhost");
	define("DBUSER", "root");
	define("DBPASSWORD", "");
	define("DBNAME", "tuto-php");

	// DSN de conexion
	$dsn = "mysql:dbname=".DBNAME.";host=".DBHOST;

	try{
		// On instancie PDO
		$db = new PDO($dsn, DBUSER, DBPASSWORD);

		//on s'assure d'envoyer les données en UTF-8
		$db->exec("SET NAMES utf8")

	}catch(PDOException $e) {
		die("Erreur:".$e->getMessages());
	}
	$sql = "SELECT * FROM `users`";

	$requete = $db->query($sql);

	$user = $requete->fetch();
	?>
</body>
</html>