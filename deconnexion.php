<?php
// Clean Session  et retourne à la page default_page.php'
session_start();
$_SESSION = array();
session_destroy();
header('location: default_page.php');
?>