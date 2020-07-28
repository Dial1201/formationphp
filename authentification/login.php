<?php
require_once('../Database.php');

// l'utilisateur vient d'arriver sur la page 
// $usernameCo = $passwordCo = "";
$errorPassOrId = "'Mauvais identifiant ou mot de passe !'";
$verify = false;

// Vérifie si le pseudo et le mdp existe
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $verify = false;

    if (isset($_POST['usernameCo'],$_POST['passwordCo']) AND !empty('usernameCo') AND !empty('paswsordCo')) {
        $usernameCo = verifyinput($_POST["usernameCo"]);  // fonction pour la securite
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

<!-- <form action="<?php // echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
    <div class="form-group">
        <label class="col col-lg-5" for="username" >Username</label>
        <input class="col col-lg-6" type="text" name="usernameCo" id="username"  required>
        <p class="errorCo"><?php // echo $errorPassOrId; ?></p>                     
    </div>
                    
    <div class="form-group">
        <label class="col col-lg-5" for="password" >Mot de passe</label>
        <input class="col col-lg-6" type="password" name="passwordCo" id="password" required>
        <p class="errorCo"><?php // echo $errorPassOrId; ?></p>                  
    </div>

        <p><input type="submit" class="btn btn-primary" value="Valider"></p>
        <a href="forget.php" ><p>Mot de passe oublié</p></a>
</form> -->