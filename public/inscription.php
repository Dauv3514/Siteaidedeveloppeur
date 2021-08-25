<?php

/*
//variable qui stockent le nom du serveur, le mot de passe et le nom de l'utilisateur.
$serveur = '127.0.0.1';
$nomutilisateur = 'root';
$motdepasse = 'root';
$dbname ='devme';

//on essaie de se connecter
try { 
$bdd= new PDO('mysql:dbname=' . $dbname . ';host=' . $serveur.";port=8000" ,$nomutilisateur, $motdepasse);
//On définit le mode d'erreur de PDO sur Exception
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
echo 'Connexion réussie';
}
//On capture les exceptions si une exception est lancée et on affiche
les informations relatives à celle-ci
catch(PDOException $e){
    echo "Erreur : " . $e->getMessage();
}
*/

/* Connexion à une base MySQL avec l'invocation de pilote */

include 'database.php';

if(isset($_POST['formulaireinscription']))
{ 
    if(!empty($_POST['email']) 
    AND !empty($_POST['nom']) 
    AND !empty($_POST['prenom']) 
    AND !empty($_POST['avatar']) 
    AND !empty($_POST['password']))

    {
        echo "ok";
        
        $email = htmlspecialchars($_POST['email']);
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $avatar = htmlspecialchars($_POST['avatar']);
        $mdp = htmlspecialchars($_POST['password']);
        $mdp= sha1($_POST['password']);

        // verification que l'email entré par l'utilisateur n'existe pas déjà dans la base de données.

        $verification = $bdd->prepare("SELECT email FROM users WHERE email = :email");
        $verification->execute(['email' => $email]);
        $resultats = $verification->rowCount();

        // la fonction rowCount retourne le nombre de lignes affectées par la dernière requête DELETE, INSERT ou UPDATE exécutée par l'objet PDOStatement correspondant.

        // on affiche le résultat (pour débuguer)

        echo $resultats;

        // la condition if nous permet de vérifier si l'email existe déjà ou non dans la bdd

        if($resultats == 0){

        $insertmbr = $bdd->prepare("INSERT INTO users(email, nom, prenom, avatar, motdepasse) VALUES(?,?,?,?,?)");
        $insertmbr->execute(array($email, $nom, $prenom, $avatar, $mdp));
        var_dump($_POST);
        echo "Le compte a été crée";
        } else {
        echo "Un email existe déjà";
        }

    }
    else
    {
        echo "non";
    }

}


?>


<div class="inscription">
    <h1> Inscription </h1>
    <br><br>
    <form method="POST" action="">
        <table>
            <tr>
                <td>
                <label for="email"> Email : </label>
                <input type="email" placeholder="Entrez votre addresse mail" id="email" name="email">
                </td>
            </tr>
            <tr>
                <td>
                <label for="nom"> Nom : </label>
                <input type="text" placeholder="Entrez votre nom" id="nom" name="nom">
                </td>
            </tr>
            <tr>
                <td>
                <label for="prenom"> Prenom : </label>
                <input type="text" placeholder="Entrez votre prenom" id="prenom" name="prenom">
                </td>
            </tr>
            <tr>
                <td>
                <label for="avatar"> Avatar : </label>
                <input type="text" placeholder="Entrez votre avatar" id="avatar" name="avatar">
                </td>
            </tr>
            <tr>
                <td>
                <label for="mot de passe"> Mot de passe : </label>
                <input type="password" placeholder="Entrez votre mot de passe" id="password" name="password">
                </td>
            </tr>
        </table>
        <input type="submit" value="S'inscrire" name="formulaireinscription">
    </form>
    <a href="connexion.php"> Se connecter </a>

</div>