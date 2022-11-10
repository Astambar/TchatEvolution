<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=messages_prives;charset=utf8;','root','');
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if(!$_SESSION['mdp'])
{
	header('location: default_page.php');
}
if(!$_SESSION['pseudo'])
{
	header('location: default_page.php');
}

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