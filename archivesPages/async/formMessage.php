<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=messages_prives;charset=utf8;','root','');
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if(isset($_GET['id']) AND !empty(($_GET['id'])))
{
	$getid = $_GET['id'];
	echo getid;
	$recupUsers = $bdd->prepare('SELECT * FROM users WHERE id = ?');
	$recupUsers->execute(array($getid));
	if($recupUsers->rowCount() > 0)
	{
		if(isset($_POST['envoyer']))
		{
			$message = htmlspecialchars($_POST['message']);
			$insererMessage=$bdd->prepare('INSERT INTO message(message, id_destinataire, id_auteur) VALUES (?, ?, ?)');
			$insererMessage->execute(array($message, $getid, $_SESSION['id']));
			header('Location: message.php?id='.$getid);
		}
	}
	else
	{
		echo "Aucun utilisateur trouvée";
	}
}
?>