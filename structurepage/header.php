<?php
$bdd = new PDO('mysql:host=localhost;dbname=messages_prives;charset=utf8;','root','');
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
	$url = "https";
else
	$url = "http";

// Ajoutez // à l'URL.
$url .= "://";

// Ajoutez l'hôte (nom de domaine, ip) à l'URL.
$url .= $_SERVER['HTTP_HOST'];

// Ajouter l'emplacement de la ressource demandée à l'URL
$url .= $_SERVER['REQUEST_URI'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/x-icon" href="image/logo-fav.png">
	<title>tchatEvolution
		<?php
		if(isset($_SESSION['pseudo']) AND !empty($_SESSION['pseudo']))
			echo $_SESSION['pseudo'];
		?>
	</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="styles.css">
	<?php
	if($url == 'http://localhost/TchatEvolution/connexion.php'
		OR $url == 'http://localhost/TchatEvolution/inscription.php')
		{
						?>
	<link rel="stylesheet" href="formStyle.css">
	<?php
		}?>
</head>
<body>
<nav class="navbar">
			<?php
			if(!empty($_SESSION))
			{
			?>
		<div class="nav-links">
			<ul>
				<h1>Public</h1>
				<li class="active"><a href="index.php">GLOBAL</a></li>
				<hr width=80%>
				<h1>Privé</h1>
				<?php
				$recupUsers = $bdd->query('SELECT * FROM users');
				while($user = $recupUsers->fetch())
				{
					?>
					<li>
						<a href="message.php?id=<?php echo $user['id']?>">
						<?php echo $user['pseudo'];?>
						</a>
					</li>
					<?php
				}

				?>
			</ul>
		</div>
		<?php } ?>
		<?php
		if(isset($_GET['id']))
			$getid=$_GET['id'];
		else
			$getid="";
		?>

	</nav>
	<header>
	<a href="http://localhost/TchatEvolution/"><img class="logo" src="image/logo.png" alt="logo TchatEvolution" ></a>
	<?php
			if($url == 'http://localhost/TchatEvolution/index.php'
				OR $url == 'http://localhost/TchatEvolution/'
				OR $url == 'http://localhost/TchatEvolution/message.php?id='.$getid)
				{
					?>
					<article class="info">
						<h4>
							<?php
							if($url == 'http://localhost/TchatEvolution/index.php'
								OR $url == 'http://localhost/TchatEvolution/')
								echo "Public - Général";
							else
							{
								?>
								<?php
								$recupUsers = $bdd->query('SELECT * FROM users');
								while($user = $recupUsers->fetch())
								{

									if($user['id'] == $_GET['id'])
									{
										echo 'Private - '.$user['pseudo'];
										break;
									}
								}
							}
							?>
						</h4>
					</article>
					<article>
					<button style="background:none; border:none;" onclick="showConfirm()">
		<img class="deconnexion" src="image/power.png" alt="deconnexion">
	</button>
	<script type="text/javascript">
		function showConfirm()
		{
			var answer=confirm("Vous allez être déconnecté en êtes vous sûr ?");
			if (answer==true)
			{
				document.location.href="http://localhost/TchatEvolution/deconnexion";
			}
		}
	</script>
					<img src="image/menu_hamburger.png" alt="menu hamburger" class="menu-hamburger">

					</article>
					<?php
				}

	?>
	</header>
	<?php
				// Afficher l'URL
				if($url == 'http://localhost/TchatEvolution/default_page.php')
					{
						?>
						<article class="default-page">
							<a href="connexion.php">
							<button class="btn">connection</button>
							</a>
							<a href="inscription.php">
							<button class="btn">inscription</button>
							</a>
						</article>
						<?php
					}
		?>