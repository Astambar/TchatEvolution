<?php
session_start();
// Se connecte à la base de données
$rootPseudo = 'root';
$rootPassword = '';
$bdd = new PDO('mysql:host=localhost;dbname=messages_prives;charset=utf8;', $rootPseudo, $rootPassword);
// Retourn une erreur en cas de probléme avec la base de données
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// Connecte l'utilisateur dans la base de données si tout les champ sont correcte
if(isset($_POST['envoi'])){
	if(!empty($_POST['pseudo']) AND !empty($_POST['mdp']))
	{
		$pseudo = htmlspecialchars($_POST['pseudo']);
		$mdp = sha1($_POST['mdp']);
		$recupUsers = $bdd->prepare('SELECT * FROM users WHERE pseudo = ? AND mdp = ?');
		$recupUsers->execute(array($pseudo, $mdp));
		if($recupUsers->rowCount() > 0)
		{
			$_SESSION['pseudo'] = $pseudo;
			$_SESSION['mdp'] = $mdp;
			$_SESSION['id'] = $recupUsers->fetch()['id'];
			header('Location: .');

		}
		else
		{
			echo "mot de passe ou pseudo incorecte";
		}
	}
	else
	{
		echo "Veuillez compléter le champ pseudo";
	}
}
include 'structurepage/header.php';
?>
	<article class="default-page">
		<div id="container-form">
			<!-- zone de connexion -->
			<form action="" method="POST">
				<h1>Connexion</h1>
				<label><b>Pseudo</b></label>
				<input type="text" name="pseudo" placeholder="pseudo">
				<label><b>Mot de passe</b></label>
				<input type="password" name="mdp" placeholder="password">
				<input type="submit" id='submit' name="envoi" value='Connexion' >
			</form>
		</div>
	</article>
</body>
</html>