<?php 

session_start();

require("../header.php") ;

require '../vendor/autoload.php';

include 'database.php';

if(!empty($_SESSION['id'])) {
    echo 'utilisateur connecté';
} else {
    header("Location: connexion.php");
    exit();
}

$id = $_SESSION['id'];

$sql = "SELECT id, titre, photo, deadline, description, user_id FROM todolist WHERE user_id='$id'";
$resultats = $bdd->prepare($sql);
$resultats->execute();
$tableauDonnees = $resultats->fetchAll(PDO::FETCH_ASSOC);
dump($tableauDonnees); 

?>

<section classe ="todolist">

<div id="ajouttache">

<div class="ajouttache">

<h1> Programme d'aide </h1>

<h1> Mes tâches à faire (Todolist) </h1>

<a href="ajouttache.php"><button name="button"> Ajouter une tache</button></a>

</div>

</div>

<div class="placement">

<div class="taches">
<?php

if(count($tableauDonnees) === 0)
{
    echo"<p>Aucune donnée à afficher</p>";

} else
{
    foreach ($tableauDonnees as $code)
    {

        $photos = $code["photo"];

        echo"<div class='code'>";
        echo"<div id='contenu' style='display:block;'>";
        echo"{$code["titre"]}<br>";
        echo'<img src="'.$photos.'"/>';
        echo"{$code["deadline"]}<br>";
        echo"{$code["description"]}<br>";
        echo"</div>";
        echo"<button onclick='cacher();'> Déplacer vers le tableau A faire </button>";
        echo"<button name='button' id='encours'> Déplacer vers le tableau En cours </button>";
        echo"<button name='button' id='termine'> Déplacer vers le tableau Terminé </button>";
        echo"</div>";
        
    }
    

}

?>

</div>

<div class="afaire">
    <p> A faire </p>
    <div id="texteafaire"></div>
</div>

<div class="encours">
    <p> En cours </p>
</div>

<div class="termine">
    <p> Terminé </p>
</div>

</div>

</section>











<h1 id="maveille"> Ma veille effectuée </h1>

<div class="containeryt">

<section class="veillegg">

<div class="veillegoogle">

<h3> Veille Google </h3>

<form method="POST" id="formveillegoogle" name="formveillegoogle">
<input type="submit" name="formveillegoogle" id="newveille" value="Ajouter une veille" />

<div class="liengoogle">
    <label for="liengoogle"> Insérer un Lien Google : </label>
    <input type="text" placeholder="Inserer un lien google" id="liengoogle" name="liengoogle">
</div>

<div class="imagegoogle">
    <label for="imagegoogle"> Insérer une Image Google : </label>
    <input type="text" placeholder="Inserer une image google" id="imagegoogle" name="imagegoogle">
</div>
</form>

</div>


<?php

//affichage des données sur la page programmedaide

$id = $_SESSION['id'];

$requetesql = "SELECT id, user_id, lien, image FROM veillegoogle WHERE user_id='$id'";
$affichage = $bdd->prepare($requetesql);
$affichage->execute();
$tableauDonnees = $affichage->fetchAll(PDO::FETCH_ASSOC);

if(count($tableauDonnees) === 0)
{
    echo"<p>Aucune donnée à afficher</p>";

} else
{
    foreach ($tableauDonnees as $code)
    {
        $images = $code["image"];
        $liens = $code["lien"];

        echo"<div class='affichageveille'>";
        echo"<div id='positionnement'>";
        echo"<div id='affichage'>";
        echo'<img src="'.$images.'"/>';
//      echo"<div id='liens'>";
//       echo"{$code["lien"]}";
        echo'<a href="'.$liens.'"> Lien vers ma veille </a>';
//      echo"</div>";
//      echo"<a href='programmedaide.php'><button type='submit'                 
//      name='supprimerveille'> <img src='images/croix.png'></button></a>";
        echo"<form method='post' name='supprimerveille'> 
            <input type='submit' src='images/croix.png' name='supprimerveille' id='croix' value='X'/>
            </form>";
        echo"</div>";
        echo"</div>";
        echo"</div>";
        
    }
    
}

// supprimer une veille (1 ligne de la base de donnée)

if(isset($_POST['supprimerveille'])) {

    $requeteid = "SELECT * FROM veillegoogle WHERE id = ...";
    $recupererid = $bdd->prepare($requeteid);
    $recupererid->execute();
    $id = $recupererid->fetchAll();
    dump($id);

    $supprimer ="DELETE FROM veillegoogle WHERE id = ";
    $supprimerveille = $bdd->prepare($supprimer);
    $suppression = $supprimerveille->execute();
    dump($supprimerveille);
    echo 'Données supprimées';
    
}

?>
</section>

<section class="veilleyt">

<div class="veilleyoutube">

<h3> Veille Youtube </h3>

<form method="POST" id="formveilleyoutube" name="formveilleyoutube">
<input type="submit" name="formveilleyoutube" id="newveilleyt" value="Ajouter une veille" />

<div class="lienyoutube">
    <label for="lienyoutube"> Insérer un Lien Youtube : </label>
    <input type="text" placeholder="Inserer un lien youtube" id="lienyoutube" name="lienyoutube">
</div>

<div class="imageyoutube">
    <label for="imageyoutube"> Insérer une Image Youtube : </label>
    <input type="text" placeholder="Inserer une image youtube" id="imageyoutube" name="imageyoutube">
</div>
</form>

</div>

<?php

//affichage des données sur la page programmedaide

$id = $_SESSION['id'];

$requetesql = "SELECT id, user_id, lien, image FROM veilleyoutube WHERE user_id='$id'";
$affichage = $bdd->prepare($requetesql);
$affichage->execute();
$tableauDonnees = $affichage->fetchAll(PDO::FETCH_ASSOC);

if(count($tableauDonnees) === 0)
{
    echo"<p>Aucune donnée à afficher</p>";

} else
{
    foreach ($tableauDonnees as $code)
    {
        $images = $code["image"];
        $liens = $code["lien"];

        echo"<div class='affichageveilleyt'>";
        echo"<div id='positionnementyt'>";
        echo"<div id='affichageyt'>";
        echo'<img src="'.$images.'"/>';
//      echo"<div id='liens'>";
//      echo"{$code["lien"]}";
        echo'<a href="'.$liens.'"> Lien vers ma veille </a>';
//      echo"</div>";
//      echo"<a href='programmedaide.php'><button type='submit'                 
//      name='supprimerveille'> <img src='images/croix.png'></button></a>";
        echo"<form method='post' name='supprimerveilleyt'> 
            <input type='submit' name='supprimerveilleyt' id='croixyt' value='X' src='images/croix.png'/>
            </form>";
        echo"</div>";
        echo"</div>";
        echo"</div>";
        
    }
    
}

// supprimer une veille (1 ligne de la base de donnée)

if(isset($_POST['supprimerveilleyt'])) {

$requete = "SELECT id FROM veilleyoutube";
$recupid = $bdd->prepare($requete);
$recupid->execute();
$recupid = $id;
dump($id);
$supprimer ="DELETE FROM veilleyoutube WHERE id = $id";
$supp = $bdd->prepare($supprimer);
$suppression = $supp->execute();
echo 'Données supprimées';

}

?>

</section>
</div>


<script type="text/javascript" src="veille.js"></script>
<script type="text/javascript" src="veilleyt.js"></script>
<script type="text/javascript" src="todolist.js"></script>

<?php

require("../footer.php")

?>




