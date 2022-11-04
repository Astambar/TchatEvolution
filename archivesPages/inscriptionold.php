<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=messages_prives;charset=utf8;','root','');
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if(isset($_POST['envoi']))
{
	if(!empty($_POST['pseudo']) AND !empty($_POST['mdp']))
	{
		$pseudo = htmlspecialchars($_POST['pseudo']);
		$mdp = sha1($_POST['mdp']);
		$insertUser = $bdd->prepare('INSERT INTO users(pseudo, mdp) VALUES(?, ?)');
		$insertUser->execute(array($pseudo, $mdp));

		$recupUser = $bdd->prepare('SELECT * FROM users WHERE pseudo=? AND mdp=?');
		$recupUser->execute(array($pseudo, $mdp));
		if($recupUser->rowCount() > 0)
		{
			$_SESSION['pseudo'] = $pseudo;
			$_SESSION['mdp'] = $mdp;
			$_SESSION['id'] = $recupUser->fetch()['id'];
		}
		echo $_SESSION['id'];
	}
	else
	{
		echo "Veuillez compléter tout les champs...";
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Inscription</title>
</head>
<body>
	<form method="POST" action="" align="center">
		<input type="text" name="pseudo" id="">
		<br>
		<input type="password" name="mdp" id="">
		<br><br>
		<input type="submit"  name="envoi">
	</form>
	
</body>
</html>