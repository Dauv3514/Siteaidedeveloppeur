<?php

session_start();

require '../vendor/autoload.php';

include 'database.php';

//insertion en base de données d'une veille google

$lien = $_POST['liengoogle'];
$image = $_POST['imagegoogle'];
$msg ="Veuillez entrer un mail valide"; 
$session = 0;
$success = 0;


    if (!empty($_POST['liengoogle']) AND !empty($_POST['imagegoogle'])) {

        $lien = htmlspecialchars($_POST['liengoogle']);
        $image = htmlspecialchars($_POST['imagegoogle']);
        $userid = $_SESSION['id'];
        $session = 1;

        $insertdonnees = $bdd->prepare("INSERT INTO veillegoogle(user_id, lien, image) VALUES(?,?,?)");
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