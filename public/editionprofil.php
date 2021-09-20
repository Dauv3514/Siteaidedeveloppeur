<?php

session_start();

require '../vendor/autoload.php';

include 'database.php';

// On récupère (on fait un select) les champs contenus dans la table "users" d'un utilisateur (identifiant, mot de passe, email...). Ensuite on peut les afficher dans les inputs avec un Echo



if (isset($_SESSION['id'])) {

    $requete = $bdd->prepare("SELECT id, avatar, motdepasse, prenom, email, nom FROM users WHERE id = ?");
    $requete->execute([$_SESSION['id']]);
    $utilisateur = $requete->fetch();


    // condition qui permet de modifier le profil de l'utilisateur

    if (isset($_POST['email']) and !empty($_POST['newemail']) and ($_POST['newemail']) != $utilisateur['email']); {
        $newemail = ($_POST['newemail']);
        $insertemail = $bdd->prepare("UPDATE users SET email = ? WHERE id = ? ");
        $insertemail->execute(array($newemail, $_SESSION['id']));

        
    }

    if (isset($_POST['motdepasse']) and !empty($_POST['newmotdepasse']) and ($_POST['newmotdepasse']) != $utilisateur['motdepasse']); {

        $newmotdepasse = ($_POST['newmotdepasse']);
        $insertmotdepasse = $bdd->prepare("UPDATE users SET motdepasse = ? WHERE id = ? ");
        $insertmotdepasse->execute(array($newmotdepasse, $_SESSION['id']));


    }

    if (isset($_POST['nom']) && !empty($_POST['newnom']) && ($_POST['newnom']) != $utilisateur['nom']); {
        $newnom = ($_POST['newnom']);
        $insertnom = $bdd->prepare("UPDATE users SET nom = ? WHERE id = ? ");
        $insertnom->execute(array($newnom, $_SESSION['id']));

        
    }


    if (isset($_POST['prenom']) and !empty($_POST['newprenom']) and ($_POST['newprenom']) != $utilisateur['prenom']); {

        $newprenom = ($_POST['newprenom']);
        $insertprenom = $bdd->prepare("UPDATE users SET prenom = ? WHERE id = ? ");
        $insertprenom->execute(array($newprenom, $_SESSION['id']));


    }

    if (isset($_POST['avatar']) and !empty($_POST['newavatar']) and ($_POST['newavatar']) != $utilisateur['avatar']); {

        $newavatar = ($_POST['newavatar']);
        $insertavatar = $bdd->prepare("UPDATE users SET avatar = ? WHERE id = ?");
        $insertavatar->execute(array($newavatar, $_SESSION['id']));


    }

    
    header('Location: /profil.php?id=' . $_SESSION['id']);

    exit();


?>

    <div class="editionprofil">

        <h2> Edition de mon profil </h2>
        <form method="POST" action="">
            <label> Mail:</label>
            <input type="email" name="newemail" placeholder="Entrez un nouveau Mail" value="<?php echo $utilisateur['email'] ?>" />
            <br><br>
            <label> Mot de passe :</label>
            <input type="password" name="newmotdepasse" placeholder="Entrez un nouveau Mot de passe" value="<?php echo $utilisateur['motdepasse'] ?>" />
            <br><br>
            <label> Nom :</label>
            <input type="text" name="newnom" placeholder="Entrez un nouveau Nom" value="<?php echo $utilisateur['nom'] ?>" />
            <br><br>
            <label> Prénom :</label>
            <input type="text" name="newprenom" placeholder="Entrez un nouveau Prénom" value="<?php echo $utilisateur['prenom'] ?>" />
            <br><br>
            <label> Avatar :</label>
            <input type="text" name="newavatar" placeholder="Entrez un nouvel avatar" value="<?php echo $utilisateur['avatar'] ?>" />
            <br><br>
            <input type="submit" name="modificationprofil" value="Mettre à jour mon profil" />
            <a href="'/profil.php?id=' . $_SESSION['id']"> Revenir à mon profil </a>
        </form>


    </div>

<?php

} else {

    header("Location: connexion.php");
    exit();

}

?>
