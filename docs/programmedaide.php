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

        <div id="taches">

        <p> Mes tâches </p>

            <?php

            if (count($tableauDonnees) === 0) {
                echo "<p>Aucune donnée à afficher</p>";
            } else
            {
            foreach ($tableauDonnees as $task)
            {
        
                $photos = $task["photo"];
                $id = $task["id"];

            ?>
        
                <div id="lestaches" draggable="true"> 
                <div id="contenu">
                <?= $task["titre"]; ?><br>
                <img src="<?= $photos; ?>"/>
                <?= $task["deadline"]; ?><br>
                <?= $task["description"];?><br>
                </div>
                <button onclick="deplacerafaire();"> A faire </button>
                <button onclick="deplacerencours();"> En cours </button>
                <button onclick="deplacertermine();"> Terminé </button>
                <form method="post" name="supprimertache">
                <input type="submit" name="supprimertache" value="Supprimer" />
                <input type="hidden" name="supprimer" value="<?= htmlentities($id) ;?>"/>
                </form>
                </div>

            

            <?php
                
            }
            }

            if (isset($_POST['supprimertache'])) {

                $supprimer = $_POST['supprimer'];
                $params = [
                    'supprimert' => $supprimer
                ];
    
                $suppressionbdd = "DELETE FROM todolist WHERE id= :supprimert;";
                $suppressiontache = $bdd->prepare($suppressionbdd);
                $sup = $suppressiontache->execute($params);
                dump($sup);
                dump($_POST);
            } 

            ?>

        </div>

        <div id="afaire">
            <p> A faire </p>
        </div>

        <div id="encours">
            <p> En cours </p>
        </div>

        <div id="termine">
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


    <section class="inspirationsdesign">

    <div class="galerie">
    
    <div class="galerieimage">

    <h1> Mes inspirations design </h1>

    <form method="post" enctype="multipart/form-data">
        <input type="file" name="fichier" accept='image/png, image/jpeg'/> <br><br>
        <input type="submit" value="Charger l'image">
    </form>
    <?php

    $selectsql = $bdd->prepare('SELECT url_fichier, nom FROM galerieimages');
    $selectsql->execute(array($fichier, $fichier_destination));
    $afficherimages = $selectsql->fetchAll();
    dump($afficherimages);




        if (count($afficherimages) === 0) {
            echo "<p>Aucune donnée à afficher</p>";
        } else {
            foreach ($afficherimages as $images) {
            $lenom = $images["nom"];
            echo '<img id="taillephoto" src="'.$lenom.'">';
            
            }
        }

    ?>

    </div>

    <?php
        dump($_FILES);

        if(!empty($_FILES)){

            $fichier = $_FILES['fichier']['name'];
            $extensions_fichier = strrchr($fichier, ".");
            $extensions_autorisees = array('.png', '.PNG','jpeg','JPEG');
            $fichier_tmp_name = $_FILES['fichier']['tmp_name'];
            $fichier_destination = 'fichiers/'.$fichier;

            if(in_array($extensions_fichier, $extensions_autorisees)){
                if(move_uploaded_file($fichier_tmp_name, $fichier_destination)){

                $user_id = $_SESSION['id'];

                $requete = $bdd->prepare('INSERT INTO galerieimages(user_id, url_fichier, nom) VALUES (?,?,?)');
                $requete->execute(array($user_id, $fichier, $fichier_destination));
                dump($requete);
                echo'Fichier envoyé avec succès';
            }
            } else {
                echo 'Seuls les fichiers png et jpeg sont autorisés';
            }
        }
    ?>

    </section>


<script type="text/javascript" src="veille.js"></script>
<script type="text/javascript" src="veilleyt.js"></script>
<script type="text/javascript" src="todolist.js"></script>
<script type="text/javascript" src="galerieimage.js"></script>

<?php

require("../footer.php")

?>