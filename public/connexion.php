<?php

session_start();

include 'database.php';

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

    $erreur = null; 

    if(isset($_POST['formulaireconnexion'])) {

    $eemail = htmlspecialchars($_POST['eemail']);
    $ppassword = sha1($_POST['ppassword']);

    if(!empty($_POST['eemail']) && !empty($_POST['ppassword'])) {

    // on verifie que l'email et le mot de passe corresponde dans la bdd
        $verificationutilisateur = $bdd->prepare("SELECT * FROM users WHERE email = ? AND motdepasse = ?");
        $verificationutilisateur->execute(array($eemail, $ppassword));
        // la fonction rowCount retourne le nombre de lignes affectées par la dernière requête DELETE, INSERT ou UPDATE exécutée par l'objet PDOStatement correspondant.
        $utilisateurexiste = $verificationutilisateur->rowCount();
        // si l'utilisateur existe on va chercher l'utilisateur avec le fetch (on va recevoir les infos)
        if($utilisateurexiste == 1){

            // on démarre la session de l'utilisateur une fois qu'il est connecté et on récupere les variables de la session, comme l'id, l'email et le mot de passe (concernant cet utilisateur)

            $sessionutilisateur = $verificationutilisateur->fetch();
            // l'utilisateur existe dans la table
            // on ajoute ses infos en tant que variables de session
            $_SESSION['id'] = $sessionutilisateur['id'];
            $_SESSION['email'] = $sessionutilisateur['email'];
            $_SESSION['motdepasse'] = $sessionutilisateur['motdepasse'];
            // on redirige l'utilisateur connecté vers son profil
            header("Location: profil.php?id=".$_SESSION['id']);

        } else 
        {
            $erreur = "Mauvais mail ou mot de passe";
        }

    }

}


    ?>

    <?php if ($erreur): ?>
    <div class="alert alert-danger">
        <?= $erreur ?>
    </div>
    <?php endif ?>




<div class="connexion">
    <h1> Connexion </h1>
    <br><br>
    <form method="POST" action="">
        <table>
            <tr>
                <td>
                <label for="eemail"> Email : </label>
                <input type="email" placeholder="Entrez votre addresse mail" id="eemail" name="eemail">
                </td>
            </tr>
            <tr>
                <td>
                <label for="ppassword"> Mot de passe : </label>
                <input type="password" placeholder="Entrez votre mot de passe" id="ppassword" name="ppassword">
                </td>
            </tr>
        </table>
        <input type="submit" name="formulaireconnexion" value="Se connecter">
    </form>

</div>
