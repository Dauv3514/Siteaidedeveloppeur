<?php

session_start();

require '../vendor/autoload.php';

require("../header.php");

include 'database.php';


// $_SESSION["auth"]["test"] = "bonjour";
// unset($_SESSION["auth"]);
// dump($_SESSION);


// if(isset($_POST['formulaireconnexion']))

// { 
//     if(!empty($_POST['eemail']) 
//     AND !empty($_POST['ppassword']))
//     {
//     echo "ok";

//     // requete permettant de recuperer tous les elements de la base de données (on match les 2 pour la connexion)

//     $requete = $bdd->prepare("SELECT email FROM users WHERE email = :email");
//     $requete->execute(['email' => $mailbdd]);
//     var_dump($requete);
//     $resultat = $requete->fetchAll();
//     var_dump($resultat);

//     }
//     else
//     { 
//         echo "veuillez complèter tous les champs";
//     }
// }


$pass = 'bonjour';

$pass1 = password_hash($pass, PASSWORD_DEFAULT);

//echo $pass1;

$isverify = password_verify($pass, '$2y$10$ar6vEPWEO3DdhXOZlgO1XumNYpRFMcXGy7fv01wUKDsyb8ivGauGK'
);

//echo $isverify ;

//var_dump($isverify);

/*  GESTION DES ERREURS EN PHP (mais problème, à chaque affichage d'une erreur la page se recharge. Donc il faut faire ça en Java Script)

if (isset($_POST['formulaireconnexion'])) {

    if (empty($_POST['eemail']))  {

        var_dump($_POST);

        $erreurmail = "Veuillez entrer un e-mail";

    }

    if (empty($_POST['ppassword']))  {

        var_dump($_POST);

        $erreurpassword = "erreur password"; 

    }

} */




?>

<?php if ($erreur) : ?>
    <div class="alert alert-danger">
        <?= $erreur ?>
    </div>
<?php endif ?>

<?php if($erreurmail) : ?>
    <div class="alert alert-danger">
        <?= $erreurmail ?>
    </div>
<?php endif ?>

<?php if($erreurpassword) : ?>
    <div class="alert alert-danger">
        <?= $erreurpassword ?>
    </div>
<?php endif ?>



<div class="connexion">

        <div class="axe">

        <h1 class="h3 mb-3 font-weight-normal">
				Se connecter
		</h1>

			<div class="container">

				<div class="milieu2">

					<form method="post" id="formconnexion" action="">

						<div class="adresseemail">
                            <label for="eemail"> Email : </label>
                            <input type="email" placeholder="Entrez votre addresse mail" id="eemail" name="eemail" value="<?= htmlspecialchars($_POST['eemail'])?>">
                            <p id="error_mail"></p>

						</div>

						<div class="motdepasse">

                            <label for="ppassword"> Mot de passe : </label>
                            <input type="password" placeholder="Entrez votre mot de passe" id="ppassword" name="ppassword" value="<?= htmlspecialchars($_POST['ppassword'])?>">
                            <p id="error_password"></p>
                            <p id="error_badpassword"></p>

						</div>

						<div class="motdepasseoublie">

							<a href="">
								Mot de passe oublié ?
							</a>

						</div>

                        <input class="btn btn-lg btn-danger" type="submit"  name="formulaireconnexion" value="Se connecter">
                </form>

            </div>
        </div>
    </div>  
</div>


<script type="text/javascript" src="erreurconnexion.js"></script>




