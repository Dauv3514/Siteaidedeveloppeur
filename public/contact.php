<!--  

1 - Mettre en place un formulaire de contact et traiter les données POST
2 - Utilisation du service Mailjet pour envoyer les e-mails

-->


<?php

// va charger nos classes
// require 'vendor/autoload.php';

// use \Mailjet\Resources;

// define('API_USER','22083fb2a26cb75892d9470f945048cf');
// define('API_LOGIN','b8e0e36de8a54d4e0268422d9f18ec1c');
// $mj = new \Mailjet\Client(API_USER, API_LOGIN,true,['version' => 'v3.1']);


include 'database.php';

    if(isset($_POST['formulairecontact']))

    { 
        if(!empty($_POST['snom']) 
        AND !empty($_POST['semail'])
        AND !empty($_POST['message']))
        {
        echo "ok";

        $nom = htmlspecialchars($_POST['nom']);
        $smail = htmlspecialchars($_POST['smail']);
        $message = htmlspecialchars($_POST['message']);

        // verifier que l'email existe bien et qu'il soit de la bonne forme

       
            // if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            
            //     $body = [
            //         'Messages' => [
            //             [
            //                 'From' => [
            //                     'Email' => "valentindauvier@hotmail.fr",
            //                     'Name' => "Valentin Dauvier"
            //                 ],
            //                 'To' => [
            //                     [
            //                         'Email' => "passenger1@mailjet.com",
            //                         'Name' => "passenger 1"
            //                     ],
            //                 ],
 
            //                 'Subject' => "Demande de renseignement",
            //                 'TextPart' => "$email, $message",
            //             ]
            //         ]
            //     ];
            //     $response = $mj->post(Resources::$Email, ['body' => $body]);
            //     $response->success();
            //     echo "Email envoyé avec succès";
            
                
            
            
            // } else {
            //         echo "Email non valide";
            //     }
            

        }
        else
        { 
            echo "veuillez complèter tous les champs";
        }
    }

?>

<?php
if(isset($_POST['mailform'])) {  

$header="MIME-Version: 1.0\r\n";
$header.='From:"bestofcultes@gmail.com"<support@primfx.com>'."\n";
$header.='Content-Type:text/html; charset="uft-8"'."\n";
$header.='Content-Transfer-Encoding: 8bit';

$messages='
<html>
	<body>
		<div align="center">
			<img src="http://www.primfx.com/mailing/banniere.png"/>
			<br />
			J\'ai envoyé ce mail avec PHP !
			<br />
			<img src="http://www.primfx.com/mailing/separation.png"/>
		</div>
	</body>
</html>
';

mail("valentindauvier@hotmail.fr", "Test", $messages, $header);
}
?>

<form method="POST" action="">
	<input type="submit" value="Recevoir un mail !" name="mailform"/>
</form>


<div class="contact">
    <h1> Contact </h1>
    <br><br>
    <form method="POST" action="">
        <table>
        <tr>
                <td>
                <label for="nom"> Nom : </label>
                <input type="text" placeholder="Entrez votre Nom" id="snom" name="snom" value="<?php if(isset($_POST['snom'])) {echo $_POST['snom']; } ?>">
                </td>
            </tr>
            <tr>
                <td>
                <label for="email"> Email : </label>
                <input type="text" placeholder="Entrez votre E-mail" id="semail" name="semail" value="<?php if(isset($_POST['semail'])) {echo $_POST['semail']; } ?>">
                </td>
            </tr>
            <tr>
                <td>
                <label for="message"> Message : </label>
                <textarea type="text" placeholder="Entrez votre message" id="message" name="message"> <?php if(isset($_POST['message'])) {echo $_POST['message']; } ?>  </textarea>
                </td>
            </tr> 
        </table>
        <input type="submit" name="formulairecontact" value="Envoyez">
    </form>

</div>
