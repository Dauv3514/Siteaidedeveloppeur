<?php

session_start();

require '../vendor/autoload.php';

include 'database.php';

//insertion en base de données d'une veille google

$lien = $_POST['lienyoutube'];
$image = $_POST['imageyoutube'];
$msg ="Veuillez entrer un mail valide"; 
$session = 0;
$success = 0;


    if (!empty($_POST['lienyoutube']) AND !empty($_POST['imageyoutube'])) {

        $lien = htmlspecialchars($_POST['lienyoutube']);
        $image = htmlspecialchars($_POST['imageyoutube']);
        $userid = $_SESSION['id'];
        $session = 1;

        $insertdonnees = $bdd->prepare("INSERT INTO veilleyoutube(user_id, lien, image) VALUES(?,?,?)");
        $insertdonnees->execute(array($userid, $lien, $image));
        $success = 1;    

    } else {
        $msg = "canemarchepas";
    }


$reponse = [

    "success" => $success,
    "lien" => $lien,
    "image" => $image,
    "message" => $msg,
    "id" => $session,

];

echo json_encode($reponse);


?>