<?php
if(!$_SESSION['mdp'])
{
	header('location: connexion.php');
}
$bdd = new PDO('mysql:host=localhost;dbname=messageries;charset=utf8;','root','');
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if(isset($_POST['valider'])){
	if(!empty($_POST['pseudo'] AND !empty($_POST['message']))){
		$pseudo = htmlspecialchars($_POST['pseudo']);
		$message = nl2br(htmlspecialchars($_POST['message']));

		$insererMessage = $bdd->prepare('INSERT INTO message(pseudo, messages) VALUES(?, ?)');
		$insererMessage->execute(array($pseudo, $message));

	}else
	{
		echo "Veuillez compléter tout les champs";
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
	<form method="POST" action="" align="center">
		<input type="text" name="pseudo">
		<br><br>
		<textarea name="message"></textarea>
		<br><br>
		<input type="submit" name="valider">
	</form>
	<section id="messages">
	</section>
	<script>
		setInterval((load_message) => {
			$('#messages').load('loadMessage.php');
		}, 500);
	</script>
</body>
</html>