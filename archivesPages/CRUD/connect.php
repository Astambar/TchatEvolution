<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=messages_prives;charset=utf8;','root','');
	$bdd->exec('SET NAMES "UTF8"');

}
catch (PDOException $e)
{
	echo 'Erreur : ' . $e->getMessage();
	die();
}
