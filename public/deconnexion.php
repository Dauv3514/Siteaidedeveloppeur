<?php

session_start();

// on vire toutes les variables de session

$_SESSION = array();
session_destroy();
header("Location: connexion.php");


?>