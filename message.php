<?php
session_start();
// Se connecte à la base de données
$rootPseudo = 'root';
$rootPassword = '';
$bdd = new PDO('mysql:host=localhost;dbname=messages_prives;charset=utf8;', $rootPseudo, $rootPassword);
// Retourn une erreur en cas de probléme avec la base de données
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if(!$_SESSION['pseudo'])
{
	header('location: default_page.php');
}
/**
 * Verifie si le GET est correct puis envoi un message à l'utilisateur dont l'id correspond
 * l'id de l'auteur est aussi envoyer en base de données on connais donc le  destinataire et l'auteur
 * dans la base de données
 * en cas  de probléme ont retourne le message aucun utilisateur trouvée
 * */
if(isset($_GET['id']) AND !empty(($_GET['id'])))
{
	$getid = $_GET['id'];
	$recupUsers = $bdd->prepare('SELECT * FROM users WHERE id = ?');
	$recupUsers->execute(array($getid));
	if($recupUsers->rowCount() > 0)
	{
		if(isset($_POST['envoyer']))
		{
			$message = htmlspecialchars($_POST['message']);
			$insererMessage=$bdd->prepare('INSERT INTO message(message, id_destinataire, id_auteur) VALUES (?, ?, ?)');
			$insererMessage->execute(array($message, $getid, $_SESSION['id']));

		}
	}
	else
	{
		echo "Aucun utilisateur trouvée";
	}
}

include 'structurepage/header.php'
?>
	<div class="container">
		<div id="messages" class="body"></div>
		<div class="footer">
			<form method="POST" action="">
						<input type="text" name="message"/>
						<input type="submit" name="envoyer" value="SEND">
			</form>
		</div>
	</div>



	<script>
		const menuHamburger = document.querySelector(".menu-hamburger")
		const navLinks = document.querySelector(".nav-links")
		menuHamburger.addEventListener('click',()=>{
			navLinks.classList.toggle('mobile-menu')
		})
		setInterval((load_message) => {
			$('#messages').load('dynamiquePage/loadPrivateMessage.php?<?= 'id='.$getid;?>');
			var messageBody = document.querySelector('#messages');
			messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;
		}, 500);
	</script>
</body>
</html>