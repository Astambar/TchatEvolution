<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=messages_prives;charset=utf8;','root','');
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$getid = $_GET['id'];
$recupMessage = $bdd->prepare('SELECT * FROM message WHERE id_auteur = ? AND id_destinataire = ?
OR id_auteur = ? AND id_destinataire = ?');
$recupMessage->execute(array($_SESSION['id'], $getid, $getid, $_SESSION['id']));
while($message = $recupMessage->fetch())
{
	if($message['id_destinataire'] == $_SESSION['id'])
	{
		?>
		<p class="destinataire"><?= $message['message']; ?></p>
		<?php
	}
	elseif($message['id_destinataire'] == $getid)
	{
		?>
		<p class="receveur"><?= $message['message']; ?></p>
		<?php
	}
	?>

	<?php
}
?>