<?php
session_start();
?>

<div class="navbar">
    <nav>
        <ul>
            <li> <a href="/profil.php?id=<?php echo $_SESSION['id']?>"> Accueil </a></li>
            <li> <a href="/programmedaide.php"> Programme d'aide </a></li>
            <li> <a href="/index.php" class="button">
                    <img src="images/logodev.png" alt="Logo du site" />
                </a></li>
            <li> <a href="/contact.php"> Contact </a></li>
            <li> <a href="/editionprofil.php"> Mon profil </a></li>
            <li> <a href="/deconnexion.php"> Deconnexion </a> </li>
        </ul>
    </nav>
</div>