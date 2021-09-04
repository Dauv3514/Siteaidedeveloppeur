<?php

session_start();

require("../header.php");

include 'database.php';

// on vérifie que la variable id existe bien (puis voir si la variable est superieur à 0)


if(isset($_GET['id']) AND $_GET['id'] > 0)
{
//intval permet de sécuriser la variable (on convertit en nombre pour être sûr)
$getid = intval($_GET['id']);

$recupererprofil = $bdd->prepare('SELECT * FROM users WHERE id = ?');
$recupererprofil->execute(array($getid));
var_dump($getid);

$afficherprofil = $recupererprofil->fetch();
var_dump($afficherprofil);

} else {

    echo "ca ne marche pas";
}

?>


<div class="profil">

    <h2> Profil de 
        <?php echo $afficherprofil['prenom']; ?> 
        <?php echo $afficherprofil['nom']; ?> 
    </h2>
    <br/><br/> Mail = ...
        <?php echo $afficherprofil['email']; ?>
    <br/><br/> Avatar = ... 
    <?php echo $afficherprofil['avatar']; ?>
    <br/>
    <br/>
    <?php 
    // ici on verifie que l'id de la session (stockée dans une session unique), soit égale à l'id présent dans la base de donnée
    if(isset($_SESSION['id']) AND $afficherprofil['id'] == $_SESSION['id'])
    
    {
    ?>
    <a href="editionprofil.php">Editer mon profil</a>
    <a href="deconnexion.php">Se déconnecter</a>
    <?php
    }
    ?>

    <h1> DEV ME - Outil d'aide à la conception de sites </h1>
    <img src="images/arriereplandevme.jpg">
    
</div>






