<?php
require_once('../Database.php');
require_once("../functions.php");

$messageValid = "Inscription validé :)";
$verify = false;

    if (isset($_POST['usernameCo'],$_POST['passwordCo'])) {
        $usernameCo = verifyinput($_POST['usernameCo']);  //fonction pour la securite (trim, stripcslashes, htmlspecialchars)
        $passwordCo = verifyinput($_POST['passwordCo']); // fonction pour la securite
        $verify = true;
    }
    elseif(empty($_POST['login'])) { // Sinon si le password ou username et faux ont indique à l'utilisateur
        		echo'<div class="alert alert-danger">';
				echo"Vous devez remplir tous les champs";
                echo"</div>";
                $verify = false;  
    }

    // On se connecte à la base de données
    $db = Database::connect();

    //  Récupération du usernameCo et password hashé dans la base de donnees
    $req = $db->prepare('SELECT id,nom,prenom,username,password FROM users WHERE username = :username ');
    $req->execute(array('username' => $usernameCo));
    $resultat = $req->fetch();
    
    // Comparaison du pass haché envoyé via le formulaire avec la base de données
    $isPasswordCorrect = null;
    $isPasswordCorrect = password_verify($passwordCo, $resultat['password']);

    if ($isPasswordCorrect) { // Si le mot de passe est correct on crée un cookie session et en renvoi sur le site web
        
        session_start();
        $verify = true;
        $_SESSION['id'] = $resultat['id'];
        $_SESSION['username'] = $resultat['username'];
        $_SESSION['nom'] = $resultat['nom'];
        $_SESSION['prenom'] = $resultat['prenom'];
        
        redirection("../accueil.php");
  
    }
    
?>