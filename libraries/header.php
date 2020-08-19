 
<?php
require_once('Database.php');
require_once('functions.php');

session_start();
check_user_connect();
?>


<header>
    <div class="row">
        <div class="col-8"></div>
        <div class="col-4">
        <a href="authentification/logout.php" class="btn btn-outline-dark"><p>Déconnexion</p></a>  
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 logo">
            <a href="accueil.php"><img src="image/logo.png" alt="logo du site web GBAF"></a> 
        </div>
        <div class="col-md-6  profil">
            <p><i class="fas fa-user"></i> <?= $_SESSION['nom'] . ' ' . $_SESSION['prenom'] ; ?></p>
        </div>
        <div class="col-md-2 logo">
            <a href="parametre.php?id=<?= $_SESSION['id']; ?>&amp,username=<?= $_SESSION['username']; ?>"><p><i class="fas fa-cog"></i> Paramètres</p></a> 
        </div> 
    </div>
</header>

