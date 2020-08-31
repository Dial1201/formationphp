<?php

$usernameCo = $passwordCo = "";
$empty_error = "";
$passwordCo_No_Valid = $username_no_valid = "";
$isSuccess = "";

// SI l'utilisateur à valider
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $isSuccess = true;
    $usernameCo = verifyinput($_POST['usernameCo']);  //fonction pour la securite (trim, stripcslashes, htmlspecialchars)
    $passwordCo = verifyinput($_POST['passwordCo']); // fonction pour la securite

    // Si les champs sont vide
    if (empty($usernameCo) || empty($passwordCo)) {
        $empty_error = "Vous devez remplir tous les champs !";
        $isSuccess = false;
    }
    // On se connecte à la base de données
    $db = Database::connect();

    //  Récupération du usernameCo et password hashé dans la base de donnees
    $query = $db->prepare('SELECT * FROM users WHERE username = :username');
    $query->execute(['username' => $usernameCo]);
    $resultat = $query->fetch();

    if ($resultat) {

        $isPasswordCorrect = password_verify($passwordCo, $resultat['password']);
        // Comparaison du pass haché envoyé via le formulaire avec la base de données

        if ($isPasswordCorrect) {

            // Si le mot de passe est correct on crée un cookie session et en renvoi sur le site web
            session_start();
            $isSuccess = true;
            $_SESSION['id'] = $resultat['id'];
            $_SESSION['username'] = $resultat['username'];
            $_SESSION['nom'] = $resultat['nom'];
            $_SESSION['prenom'] = $resultat['prenom'];
            $db = DataBase::disconnect();
        } else {
            $passwordCo_No_Valid = "Le mot de passe est incorrect !!!";
            $isSuccess = false;
        }

        if ($isSuccess) {

            redirection("../accueil.php");
        }
    }
}