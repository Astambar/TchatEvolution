<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=messages_prives;charset=utf8;','root','');
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$recupMessage = $bdd->query("SELECT * FROM `chat_general`");

class MessageUser
{
	public int $idAuteur;
	public string $message;
	public string $pseudo;

	public function __construct(int $idAuteur, string $message, string $pseudo)
	{
		$this->idAuteur = $idAuteur;
		$this->message = $message;
		$this->pseudo = $pseudo;
	}
}
$i=0;
while($message = $recupMessage->fetch())
{
	$recupUsers = $bdd->query("SELECT id, pseudo FROM `users`");
	while($usersId = $recupUsers->fetch())
	{
		if($usersId['id'] == $message['id_auteur'])
		{
			$messageUserId[$i] = new MessageUser(
									$message['id_auteur'],
									$message['message'],
									$usersId['pseudo']);
			$i++;

		}
	}
}
//var_dump($messageUserId);
$countTab = count($messageUserId) -1 ;
if(isset($messageUserId)){
	for ($i=$countTab; 0 <= $i; $i--)
	{
		if($messageUserId[$i]->idAuteur == $_SESSION['id'])
		{

			?>
			<p class="message user_message"><?= $messageUserId[$i]->message; ?></p>
			<?php
		}
		else
		{
			?>
			<section class="message">
				<article class="headermsg"><?=$messageUserId[$i]->pseudo;?></article>
				<article><?= $messageUserId[$i]->message; ?></article>
			</section>
			<?php
		}
	}
}


?>