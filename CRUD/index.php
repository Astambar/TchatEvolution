<?php
// On démarre une session
session_start();
// on inclut la  connexion à la base de données
require_once('connect.php');

$sql = 'SELECT * FROM `users`';

// On prépare la requête
$query = $bdd->prepare($sql);

// On exécute la requête
$query->execute();

// On stocke le résultat dans un tableau associatif
$result = $query->fetchAll(PDO::FETCH_ASSOC);
//$result = $query->fetchAll();
//var_dump($result);
require_once('closed.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
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
				<?php
				if(!empty($_SESSION['message_SQL']))
					echo '<div class="alert alert-success" role="alert">
					'.$_SESSION['message_SQL'].'
					</div>';
					$_SESSION['message_SQL'] = "";
				?>
				<table class="table">
					<thead>
						<th>ID</th>
						<th>pseudo</th>
						<th>mdp</th>
						<th>email</th>
						<th>cle</th>
						<th>confirme</th>
						<th>Action</th>
					</thead>
					<tbody>
						<?php
						// On boucle sur la variable result
						foreach($result as $userprofile){
						?>
						<tr>
							<td>
								<?= $userprofile['id']?>
							</td>

							<td>
								<?= $userprofile['pseudo']?>
							</td>
							<td>
								<?= $userprofile['mdp']?>
							</td>
							<td>
								<?= $userprofile['email']?>
							</td>
							<td>
								<?= $userprofile['cle']?>
							</td>							<td>
								<?= $userprofile['confirme']?>
							</td>
							<td>
								<a href="details.php?id=<?= $userprofile['id'];?>">Voir</a>
								<a href="edit.php?id=<?= $userprofile['id'];?>">Modifier</a>
								<a href="delete.php?id=<?= $userprofile['id'];?>">Supprimer</a>
							</td>
						</tr>
						<?php
						}
						?>
					</tbody>
				</table>
				<a href="add.php" class="btn btn-primary">Ajouter un utilisateur</a>
			</section>
		</div>
	</main>
</body>
</html>