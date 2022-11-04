<?php
// On démarre la session
session_start();
if(isset($_GET['id']) && !empty($_GET['id']))
{
	require_once('connect.php');
	// On nettoie l'id envoyé
	$id = strip_tags($_GET['id']);
	$sql = 'SELECT * FROM `users` WHERE `id`=:id';

	// On prépare la requête
	$query = $bdd->prepare($sql);

	// On attache les valeurs
	$query->bindValue(':id', $id, PDO::PARAM_INT);

	// On exécute la requête
	$query->execute();

	// On stocke le résultat dans un tableau associatif
	$userProfile = $query->fetch();

	// On vérifie que l'user existe
	if(!$userProfile)
	{
		$_SESSION['erreur']= "Cet id n'existe pas";
		header('location: index.php');
	}
	else
	{

	}
}
else
{
	$_SESSION['erreur']= 'URL invalide';
	header('location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
	<title>Détails users</title>
</head>
<body>
	<main class="container">
	<div class="row">
		<section class="col-12">
			<h1>Détail user <?=$userProfile['pseudo']?></h1>
			<p>ID: <?= $userProfile['id']?></p>
			<p>pseudo: <?= $userProfile['pseudo']?></p>
			<p>mdp:<?=$userProfile['mdp']?></p>
			<p>email: <?= $userProfile['email']?></p>
			<p>cle: <?= $userProfile['cle']?></p>
			<p>confirme: <?= $userProfile['confirme']?></p>
			<p>
				<a href="index.php">Retour</a>
				<a href="edit.php?id=<?=$userProfile['id'];?>">modifier</a>
			</p>
		</section>
	</div>
	</main>
</body>
</html>