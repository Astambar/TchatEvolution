<?php
// Lance la session
session_start();
// Se connecte à la base de données
$rootPseudo = 'root';
$rootPassword = '';
$bdd = new PDO('mysql:host=localhost;dbname=messages_prives;charset=utf8;', $rootPseudo, $rootPassword);
// Retourn une erreur en cas de probléme avec la base de données
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// Verifie la sessions de l'utilisateur et retourne à la page par default en cas d'erreur
if(!$_SESSION['mdp'])
{
	header('location: default_page.php');
}
if(!$_SESSION['pseudo'])
{
	header('location: default_page.php');
}
// Ajout en base de donnée des données du formulaire
// en cas de message vide affiche un message et n'effectue pas la requêtes
if(isset($_POST['valider']))
{
	if(!empty($_POST['message']))
	{
		$message = nl2br(htmlspecialchars($_POST['message']));
		$idSession = $_SESSION['id'];
		$insereMessage =$bdd->prepare('INSERT INTO chat_general(id_auteur, message) VALUES(?, ?)');
		$insereMessage->execute(array($idSession, $message));
	}
	else
	{
		echo "message vide";
	}
}
include 'structurepage/header.php';
?>

	<div class="container">
		<div id="messages" class="body"></div>
		<div class="footer">
			<form method="POST" action="">
						<input type="text" name="message"/>
						<input type="submit" name="valider" value="SEND">
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
			$('#messages').load('dynamiquePage/loadMessage.php');
			var messageBody = document.querySelector('#messages');
			messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;
		}, 500);
	</script>
</body>
</html>