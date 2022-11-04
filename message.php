<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=messages_prives;charset=utf8;','root','');
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if(!$_SESSION['pseudo'])
{
	header('location: default_page.php');
}
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
			header('Location: ');
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