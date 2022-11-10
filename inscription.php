<?php
session_start();
// Se connecte à la base de données
$rootPseudo = 'root';
$rootPassword = '';
$bdd = new PDO('mysql:host=localhost;dbname=messages_prives;charset=utf8;', $rootPseudo, $rootPassword);
// Retourn une erreur en cas de probléme avec la base de données
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// Enregistre un nouvelle utilisateur dans la base de données si tout les champ sont correcte
if(isset($_POST['envoi']))
{
	if(!empty($_POST['pseudo']) AND !empty($_POST['mdp'])
	AND !empty($_POST['email']))
	{
		$cle = rand(1000000, 9000000);
		$email = $_POST['email'];
		$pseudo = htmlspecialchars($_POST['pseudo']);
		$mdp = sha1($_POST['mdp']);
		$insertUser = $bdd->prepare('INSERT INTO users(
			pseudo, mdp, email, cle, confirme)
			VALUES(?, ?, ?, ?, ?)');
		$insertUser->execute(array($pseudo, $mdp, $email, $cle, 0));

		$recupUser = $bdd->prepare('SELECT * FROM users WHERE pseudo=? AND mdp=?');
		$recupUser->execute(array($pseudo, $mdp));
		if($recupUser->rowCount() > 0)
		{
			$_SESSION['pseudo'] = $pseudo;
			$_SESSION['mdp'] = $mdp;
			$_SESSION['id'] = $recupUser->fetch()['id'];
		}
		echo $_SESSION['id'];
		// Détruit toutes les variables de session
		header('location: .');
	}
	else
	{
		echo "Veuillez compléter tout les champs...";
	}

}
include 'structurepage/header.php';
?>
<article class="default-page">
	<div id="container-form">
		<!-- zone d'inscription -->

		<form action="" method="POST">
		<h1>Inscription</h1>

		<label><b>Adresse email</b></label>
		<input type="email" name ="email" placeholder="example@domain.com">
		<label><b>Pseudo</b></label>
		<input type="text" name="pseudo" placeholder="pseudo">
		<label><b>Mot de passe</b></label>
		<input type="password" name="mdp" placeholder="password">

		<input type="submit" id='submit' name="envoi" value='inscription' >
		</form>
	</div>
 </article>
</body>
</html>