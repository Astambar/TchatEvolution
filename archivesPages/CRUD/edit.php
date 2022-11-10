<?php
// On démarre une session
session_start();

if($_POST)
{
	if(isset($_POST['id']) && !empty($_POST['id'])
	&& isset($_POST['pseudo']) && !empty($_POST['pseudo'])
	&& isset($_POST['email']) && !empty($_POST['email'])
	&& isset($_POST['mdp']) && !empty($_POST['mdp']))
	{
		// on inclut la  connexion à la base de données
		require_once('connect.php');
		$id = strip_tags($_GET['id']);
		$pseudo = strip_tags($_POST['pseudo']);
		$email = strip_tags($_POST['email']);
		$mdp = strip_tags($_POST['mdp']);
		$cle = rand(1000000, 9000000);
		$confirme = 0;

		$sql = 'UPDATE `users` SET
		`pseudo`=:pseudo,
		`email`=:email,
		`mdp`=:mdp,
		`cle`=:cle,
		`confirme`=:confirme
		WHERE `id`=:id';

		$query = $bdd->prepare($sql);

		$query->bindValue(':id', $pseudo, PDO::PARAM_INT);

		$query->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);

		$query->bindValue(':email', $email, PDO::PARAM_STR);

		$query->bindValue(':mdp', $mdp, PDO::PARAM_STR);

		$query->bindValue(':cle', $cle, PDO::PARAM_INT);

		$query->bindValue(':confirme', $confirme, PDO::PARAM_INT);

		$query->execute();

		$_SESSION['message_SQL'] = 'Utilisateur modifier';

		// On  stop  la connexion
		require_once('closed.php');
		header('Location: index.php');
	}
	else
	{
		$_SESSION['erreur'] = "Le formulaireest incomplet";
	}
}

if(isset($_GET['id']) && !empty($_GET['id']))
{
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
	<title>Ajouter un produit</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
</head>
<body>
	<main class="container">
		<div class="row">
			<section class="col-12">
			<?php
				if(!empty($_SESSION['erreur']))
					echo '<div class="alert alert-danger" role="alert">
					'.$_SESSION['erreur'].'
					</div>';
					$_SESSION['erreur'] = "";
				?>
				<h1>Modifier un utilisateur</h1>
				<form action="" method="POST">
					<div class="form-group">
						<label for="pseudo"> Pseudo</label>
						<input type="text" name="pseudo" id="pseudo" class="form-control"
						value="<?=$userProfile['pseudo'];?>">
					</div>
					<div class="form-group">
						<label for="email"> Email</label>
						<input type="email" name="email" id="email" placeholder="example@domain.com" class="form-control"
						value="<?=$userProfile['email'];?>">
					</div>
					<div class="form-group">
						<label for="mdp"> Mots de passe</label>
						<input type="password" name="mdp" id="mdp" class="form-control"
						value="<?=$userProfile['mdp'];?>">
					</div>
					<div class="form-group">
						<label for="cle"> Cle</label>
						<input type="text" name="cle" id="cle" class="form-control"
						value="<?=$userProfile['cle'];?>">
					</div>
					<div class="form-group">
						<label for="confirme"> confirme</label>
						<input type="text" name="confirme" id="confirme" class="form-control"
						value="<?=$userProfile['confirme'];?>">
					</div>
					<input type="hidden" value="<?= $userProfile['id'];?>" name="id">
					<button class="btn btn-primary">
						Envoyer
					</button>
				</form>
			</section>
		</div>
	</main>
</body>
</html>