<?php
require_once('../Database.php');

$errorPassOrId = "'Mauvais identifiant ou mot de passe !'";
$verify = false;

    if (isset($_POST['usernameCo'],$_POST['passwordCo']) AND !empty('usernameCo') AND !empty('paswsordCo')) {
        $usernameCo = verifyinput($_POST["usernameCo"]);  //fonction pour la securite (trim, stripcslashes, htmlspecialchars)
        $passwordCo = verifyinput($_POST["passwordCo"]); // fonction pour la securite
        $verify = true;
    }
    else { // Sinon si le password ou username et faux ont indique à l'utilisateur
        echo"$errorPassOrId" ;     
    }
    // On se connecte à la base de données
    $db = Database::connect();

    //  Récupération du usernameCo et password hashé dans la base de donnees
    $req = $db->prepare('SELECT id,username,password FROM users  WHERE username = :username ');
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
        header('location:../accueil.php');
  
    }

    else { // Sinon si le password ou username et faux ont indique à l'utilisateur
        echo"$errorPassOrId" ; 
        $verify = false;
    }
// }
function verifyinput ($var) { // fonction pour la securite

    $var = trim($var); // trim — Supprime les espaces (ou d'autres caractères) en début et fin de chaîne
    $var = stripcslashes($var); // supprime tous les antislashs
    $var = htmlspecialchars($var); // Convertit les caractères spéciaux en entités HTML
    return $var;
}
?>