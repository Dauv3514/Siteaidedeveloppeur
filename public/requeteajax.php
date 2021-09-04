<?php

session_start();

/*

    On recoit l'email et le mot de passe de la requete AJAX
    
    1- Si l'email et le mot de passe sont vides
    2- Si l'email ou le mot de passe est vide
    3- Si l'email et le mot de passe sont remplis mais que l'utilisateur n'existe pas (e-mail/mot de passe mauvais)
    4- Si l'email et le mot de passe sont remplis et que l'utilisateur existe (connexion réussi)


*/

require '../vendor/autoload.php';


include 'database.php';


/* $errors = [];

if(isset($_POST['eemail']) && empty($_POST['eemail'])) {

    $errors["email"] = 'Veuillez entrer un e-mail';
    var_dump($_POST['email']);

}

if(isset($_POST['ppassword']) && empty($_POST['ppassword'])) {

    $errors["motdepasse"] = 'Veuillez entrer un mot de passe';

}

if($errors) {

    $reponse = [
        "code" => '404',
        "erreur" => $errors,
        "mauvaisutilisateur" => 'Veuillez entrer un mail et un mot de passe valide',
        "email" => $_POST['email'],
        "motdepasse" => $_POST['motdepasse'],
        dump($_POST['email'])
    ];

    echo json_encode($reponse);

    exit();

}
 */

$errors = [];

if (empty($_POST['email']))  {

    $errors["email"] = 'Veuillez entrer un e-mail' ;

}

if(empty($_POST['motdepasse'])) {

    $errors["motdepasse"] = 'Veuillez entrer un mot de passe';

} 

// Test si email existe dans la base de données
// Si email n'existe pas renvoyer l'erreur
// Si email existe tester le mot de passe
// Si mot de passe pas bon renvoyer une erreur
// Si mot de passe est bon on connecte l'utilisateur

//   $errors["valide"] = 'Veuillez entrer un email valide';


$session = 0;
$msg ="Veuillez entrer un mail valide";
$success = 0;

if (!empty($_POST['email']) AND !empty($_POST['motdepasse'])) {

$mdp = htmlspecialchars($_POST['motdepasse']);
$mail = htmlspecialchars($_POST['email']);

    $verificationmail = $bdd->prepare("SELECT* FROM users WHERE email = ?");
    $verificationmail->execute(array($mail));
    $utilisateurexiste = $verificationmail->rowCount();

    if($utilisateurexiste == 1) {

        $resultatbdd = $verificationmail->fetch();

        $isverify = password_verify($mdp, $resultatbdd['motdepasse']);

    if($isverify){
        $success = 1;
        $msg = "Vous êtes bien connecté";
        $session = 1;
        $session = $_SESSION['id'] = $resultatbdd['id'];

    } else {

        $msg = "Veuillez entrer un mot de passe valide";

    }

    } 

}

//$redir = header("Location: /profil.php?id=" . $_SESSION['id']);
$reponse = [

    "code" => '404',
    "email" => $_POST['email'],
    "id" => $session,
    "motdepasse" => $_POST['motdepasse'],
    "success" => $success,
    "message" => $msg

];

echo json_encode($reponse);




//$erreur = null;

/* if (isset($_POST['formulaireconnexion'])) {

    $ppassword = $_POST['ppassword'];
    $eemail = $_POST['eemail'];


    if (!empty($_POST['eemail']) && !empty($_POST['ppassword'])) {

        // on verifie que l'email et le mot de passe corresponde dans la bdd
        $verificationutilisateur = $bdd->prepare("SELECT * FROM users WHERE email = ?");
        $verificationutilisateur->execute(array($eemail));
        // la fonction rowCount retourne le nombre de lignes affectées par la dernière requête DELETE, INSERT ou UPDATE exécutée par l'objet PDOStatement correspondant.       
        $utilisateurexiste = $verificationutilisateur->rowCount();
        // si l'utilisateur existe on va chercher l'utilisateur avec le fetch (on va recevoir les infos)

        if ($utilisateurexiste == 1) {

            // on démarre la session de l'utilisateur une fois qu'il est connecté et on récupere les variables de la session, comme l'id, l'email et le mot de passe (concernant cet utilisateur)

            $resultatbdd = $verificationutilisateur->fetch();

            //on vérifie la concordance des mots de passes entre celui passé par la variable POST au clique par l'utilisateur (celui soumis par le formulaire) et celui présent dans la base de données (qui a déja été haser avec la fonction password_hash).

            $isverify = password_verify($ppassword, $resultatbdd['motdepasse']);
            if($isverify){
                
                $_SESSION["auth"]["id"] = $resultatbdd['id'];
                

            // l'utilisateur existe dans la table
            // on ajoute ses infos en tant que variables de session
                $_SESSION['id'] = $resultatbdd['id'];
                $_SESSION['email'] = $resultatbdd['email'];
                $_SESSION['motdepasse'] = $resultatbdd['motdepasse'];

            //  header("Location: /profil.php?id=" . $_SESSION['id']);
            // on redirige l'utilisateur connecté vers son profil
                
                
            } else {

            $errors["fdfs"] = 'dsffds';
            
            }

        } else {

            
        }
    }
} */ 







// On encode en json pour pouvoir récuper la variable plus facilement après. Transformation du PHP vers le Java Script.

// echo json_encode($erreurmdpmail);

?>