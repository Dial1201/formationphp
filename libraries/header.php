 
<?php
require_once('Database.php');

session_start();
?>


<header>
    <div class="row">
        <div class="col-md-4 logo">
            <a href="accueil.php"><img src="image/logo.png" alt="logo du site web GBAF"></a> 
        </div>
        <div class="col-md-6  profil">
            <p><i class="fas fa-user"></i><?= $_SESSION['username']; ?></p>
        </div>
        <div class="col-md-2 logo">
            <a href="parametre.php?id=<?= $_SESSION['id']; ?>&amp,username=<?= $_SESSION['username']; ?>"><p><i class="fas fa-cog"></i> Paramètres</p></a> 
        </div> 
    </div>
</header>

