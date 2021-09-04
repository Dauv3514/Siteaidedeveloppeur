<?php

// va charger nos classes
// require 'vendor/autoload.php';

include 'database.php';

require("../header.php");

if (isset($_POST['formulairecontact'])) {

    if (isset($_POST['snom']) && ($_POST['semail']) && ($_POST['message'])) {

        $nom = $_POST['snom'];
        $mail = $_POST['semail'];
        $message = $_POST['message'];

        $mailTo = "valentindauvier@hotmail.fr";

        $headers = "From: " . $mail;
        $text = "Tu as reçu un email from " . $nom . "" . $message;
        var_dump($text);
        mail($mailTo, $text, $headers);
        header("Location: contact.php?sendmail");
    }
}

?>


<div class="contact">
    <h1> Contact </h1>
    <br><br>
    <div class="contacter">
        <div class="container3">

            <form method="POST" class="formulairecontact" action="">
                <div id="cnom">
                    <label for="nom"> Nom : </label>
                    <input type="text" placeholder="Entrez votre Nom" id="snom" name="snom">
                </div>
                <div id="cmail">
                    <label for="email"> Email : </label>
                    <input type="email" placeholder="Entrez votre E-mail" id="semail" name="semail">
                </div>
                <div id="cmessage">
                    <label for="message"> Message : </label>
                    <textarea type="text" placeholder="Entrez votre message" id="message" name="message"> </textarea>
                </div>
                <button type="submit" name="formulairecontact"> Envoyez </button>
            </form>

        </div>
    </div>
</div>