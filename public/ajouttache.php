<?php 

session_start();

require '../vendor/autoload.php';

include 'database.php';

if(!empty($_SESSION['id'])) {
} else {
    header("Location: connexion.php");
    exit();
}


if(isset($_POST['formtache'])){ 

    if (
        !empty($_POST['titre'])
        and !empty($_POST['description'])
        and !empty($_POST['photo'])
        and !empty($_POST['deadline'])

    ) {
        echo "ok";


        $titre = htmlspecialchars($_POST['titre']);
        $description = htmlspecialchars($_POST['description']);
        $photo = htmlspecialchars($_POST['photo']);
        $deadline = htmlspecialchars($_POST['deadline']);
        $user_id = $_SESSION['id'];

        $nouvelletache = $bdd->prepare("INSERT INTO todolist(titre, description, photo, deadline, id, user_id) VALUES(?,?,?,?,?,?)");
        $nouvelletache->execute(array($titre, $description, $photo, $deadline, $id, $user_id));
        header("Location: programmedaide.php");

    
    } else {
        echo'non';
    }
    
    }

?>



<div class="ajouttache">
    <h1> Ajouter une tâche à ma todo list </h1>
    <br><br>
    <div class="ajout">
        <div class="container5">
            <form method="POST" target="_blank" id="formtache">
        
                <div id="titre">
                    <label for="titre"> Titre : </label>
                    <input type="text" placeholder="Entrez un titre" id="titre" name="titre" required >
                </div>
                <div id="description">
                    <label for="description"> Description : </label>
                    <input type="text" placeholder="Entrez une description" id="description" name="description" required >
                </div>
                <div id="photo">
                    <label for="photo"> Photo : </label>
                    <input type="text" placeholder="Insérer le lien d'une photo" id="photo" name="photo" required >
                </div>
                <div id="deadline">
                    <label for="deadline"> Deadline : </label>
                    <input type="date" placeholder="Entrez une deadline" id="deadline" name="deadline" required>
                </div>
                <input type="submit" value="Ajouter" name="formtache">
            </form>
        </div>
    </div>