<?php

session_start();

require("../header.php");

require '../vendor/autoload.php';

include 'database.php';

if (!empty($_SESSION['id'])) {
    echo 'utilisateur connecté';
} else {
    header("Location: connexion.php");
    exit();
}

// Partie TODOLIST

$id = $_SESSION['id'];

$sql = "SELECT id, titre, photo, deadline, description, user_id FROM todolist WHERE user_id='$id'";
$resultats = $bdd->prepare($sql);
$resultats->execute();
$tableauDonnees = $resultats->fetchAll(PDO::FETCH_ASSOC);
dump($tableauDonnees);

?>

<section classe="todolist">

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

            if (count($tableauDonnees) === 0) {
                echo "<p>Aucune donnée à afficher</p>";
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








<!-- PARTIE VEILLE -->


<h1 id="maveille"> Ma veille effectuée </h1>

<div class="containerytgg">

    <section class="veillegg">

        <div class="veillegoogle">

            <h3> Veille Google </h3>

            <div id="formveillegoogle">
                <button id="newveille"> Ajouter une veille </button>

                <div class="liengoogle">
                    <label for="liengoogle"> Insérer un Lien Google : </label>
                    <input type="text" placeholder="Inserer un lien google" id="liengoogle">
                </div>

                <div class="imagegoogle">
                    <label for="imagegoogle"> Insérer une Image Google : </label>
                    <input type="text" placeholder="Inserer une image google" id="imagegoogle">
                </div>
            </div>

        </div>


        <?php

        //affichage des données sur la page programmedaide

        $id = $_SESSION['id'];

        $requetesql = "SELECT id, user_id, lien, image FROM veillegoogle WHERE user_id='$id'";
        $affichage = $bdd->prepare($requetesql);
        $affichage->execute();
        $tableauDonnees = $affichage->fetchAll(PDO::FETCH_ASSOC);

        if (count($tableauDonnees) === 0) {
            echo "<p> Aucune donnée à afficher </p>";
            dump($tableauDonnees);
        } else {
            foreach ($tableauDonnees as $code) {
                $images = $code["image"];
                $liens = $code["lien"];
                $id = $code["id"];

        ?>

                <div class="affichageveille">
                    <div id="positionnement">
                        <div id="affichage">

                            <img id="recimages" src="<?= $images; ?>" />

                            <a id="recliens" href="<?= $liens; ?>'"> Lien vers ma veille </a>

                            <!-- <div name="supprimerveille">
                                <input type="submit" src="images/croix.png" name="supprimerveille" id="croix" value="X" />
                                <input type="hidden" name="idveillegg" value="<?= htmlentities($id);  ?>" />
                            </div>  -->

                            <form method="post" name="supprimerveille">
                                <input type="submit" src="images/croix.png" name="supprimerveille" id="croixyt" value="X" />
                                <input type="hidden" name="idveillegg" value="<?= htmlentities($id) ;?>" />
                            </form>

                        </div>
                    </div>
                </div>

        <?php

            }
        }

        // supprimer une veillegoogle (1 ligne de la base de donnée)
        
        
        if (isset($_POST['supprimerveille'])) {

            $veilleidgg = $_POST['idveillegg'];
            $params = [
                'veilleidgg' => $veilleidgg
            ];

            $supprimer = "DELETE FROM veillegoogle WHERE id= :veilleidgg;";
            $supprimerveille = $bdd->prepare($supprimer);
            $suppression = $supprimerveille->execute($params);
            dump($supprimerveille);
            dump($_POST);
        } 

        // ANCIENNE MANIERE D'AFFICHER MES DONNEES

        /* if(count($tableauDonnees) === 0)
{
    echo"<p>Aucune donnée à afficher</p>";

} else
{
    foreach ($tableauDonnees as $code)
    {
        $images = $code["image"];
        $liens = $code["lien"];
        $id = $code["id"];

        echo"<div class='affichageveille'>";
        echo"<div id='positionnement'>";
        echo"<div id='affichage'>";
        echo'<img src="'.$images.'"/>';
//      echo"<div id='liens'>";
        echo'<a href="'.$liens.'"> Lien vers ma veille </a>';
//      echo"</div>";
//      echo"<a href='programmedaide.php'><button type='submit'                 
//      name='supprimerveille'> <img src='images/croix.png'></button></a>";
        echo"<form method='post' name='supprimerveille'>";
        echo"<input type='submit' src='images/croix.png' name='supprimerveille' id='croix' value='X'/>";
        echo"<input type='hidden' name='idveillegg' value='$id'/>";
        echo"</form>";
        echo"</div>";
        echo"</div>";
        echo"</div>";
        
    }
    
} */

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

        if (count($tableauDonnees) === 0) {
            echo "<p>Aucune donnée à afficher</p>";
        } else {
            foreach ($tableauDonnees as $code) {
                $images = $code["image"];
                $liens = $code["lien"];
                $id = $code["id"];

        ?>

                <div class="affichageveilleyt">
                    <div id="positionnementyt">
                        <div id="affichageyt">

                            <img src="<?php echo $images ?>" />

                            <a href="<?php echo $liens ?>"> Lien vers ma veille </a>

                            <form method="post" name="supprimerveilleyt">
                                <input type="submit" src="images/croix.png" name="supprimerveilleyt" id="croixyt" value="X" />
                                <input type="hidden" name="idveilleyt" value="<?php echo $id ?>" />
                            </form>

                        </div>
                    </div>
                </div>

        <?php

            }
        }

        // supprimer une veilleyoutube (1 ligne de la base de donnée)

        if (isset($_POST['supprimerveilleyt'])) {

            $veilleidyt = $_POST['idveilleyt'];
            $parametres = [
                'veilleidyt' => $veilleidyt
            ];

            $supprimer = "DELETE FROM veilleyoutube WHERE id= :veilleidyt;";
            $supp = $bdd->prepare($supprimer);
            $suppression = $supp->execute($parametres);
            echo 'Données supprimées';
            dump($_POST);
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