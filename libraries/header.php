 
<?php
require_once('Database.php');

session_start();


echo'<header>';
            echo'<div class="row">';
                echo'<div class="col-md-6 logo">';
                    echo'<a href="accueil.php"><img src="image/logo.png" alt="logo du site web GBAF"></a> ';
                echo'</div>';
                echo'<div class="col-md-6  profil">';
                    echo'<p><i class="fas fa-user"></i>'.' '.$_SESSION['username']. '</p>';
                echo'</div>'; 
            echo'</div>';
        echo'</header>';

