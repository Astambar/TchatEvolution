<?php
// On démarre une session
session_start();

if($_POST)
{
	if(isset($_POST['pseudo']) && !empty($_POST['pseudo'])
	&& isset($_POST['email']) && !empty($_POST['email'])
	&& isset($_POST['mdp']) && !empty($_POST['mdp']))
	{
		// on inclut la  connexion à la base de données
		require_once('connect.php');
		$pseudo = strip_tags($_POST['pseudo']);
		$email = strip_tags($_POST['email']);
		$mdp = strip_tags($_POST['mdp']);
		$cle = rand(1000000, 9000000);
		$confirme = 0;

		$sql = 'INSERT INTO `users`(`pseudo`, `email`, `mdp`, `cle`, `confirme`) VALUES (:pseudo, :email, :mdp, :cle, :confirme)';

		$query = $bdd->prepare($sql);

		$query->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);

		$query->bindValue(':email', $email, PDO::PARAM_STR);

		$query->bindValue(':mdp', $mdp, PDO::PARAM_STR);

		$query->bindValue(':cle', $cle, PDO::PARAM_INT);

		$query->bindValue(':confirme', $confirme, PDO::PARAM_INT);

		$query->execute();

		$_SESSION['message_SQL'] = 'Produit ajouté';

		// On  stop  la connexion
		require_once('closed.php');
		header('Location: index.php');
	}
	else
	{
		$_SESSION['erreur'] = "Le formulaireest incomplet";
	}
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
				<h1>Ajoutter un utilisateur</h1>
				<form action="" method="POST">
					<div class="form-group">
						<label for="pseudo"> Pseudo</label>
						<input type="text" name="pseudo" id="pseudo" class="form-control">
					</div>
					<div class="form-group">
						<label for="email"> Email</label>
						<input type="email" name="email" id="email" placeholder="example@domain.com" class="form-control">
					</div>
					<div class="form-group">
						<label for="mdp"> Mots de passe</label>
						<input type="password" name="mdp" id="mdp" class="form-control">
					</div>
					<button class="btn btn-primary">
						Envoyer
					</button>
				</form>
			</section>
		</div>
	</main>
</body>
</html>