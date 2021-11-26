<?php 


$requestUri = $_SERVER["REQUEST_URI"];

$isMenu = true;

if($requestUri === '/connexion.php') {
    $isMenu = false;
}
if($requestUri === '/inscription.php') {
    $isMenu = false;
}
if($requestUri === '/contact.php') {
    $isMenu = false;
}
if($requestUri === '/programmedaide.php') {
    $isMenu = false;
}
if($requestUri === '/ajouttache.php') {
    $isMenu = false;
}
if($requestUri === '/editionprofil.php') {
    $isMenu = false;
}

?>

<!DOCTYPE html>

<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Site d'outils aide aux développeurs</title>
    <link rel="stylesheet" type="text/css" href="/css/style.css">

</head>

<body>

    <header >

    <?php if($isMenu) : ?>
        <div class="header">
            <?php
                if($isMenu) {
                    if(empty($_SESSION['id'])){
                        include('menu_public.php');
                    } else { 
                        include('menu_privee.php');
                    }
                }
            ?>
        </div>
    <?php endif; ?>

    </div>

    </header>
