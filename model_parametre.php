<?php

// On vérifie que la variable $_GET['id'] et $_GET['username'] exsite avec isset
// SI elle n'est pas vide avec !empty et que c'est un nombre entier avec ctype_digit
// Si tout est ok ont met on converti avec int la variable et on stock dans $id 

session_start();

if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
    $id = $_SESSION['id'];

    // $db = DataBase::connect();
    // $req = $db->prepare('SELECT * FROM users WHERE id =?');
    // $req->execute(array($id));
    // $resultat = $req->fetch();
    findUser($id);
    

    $nom_error = $prenom_error = $username_error = $password_error = $question_error = $reponse_error = "";
    $usernameNoValid = "";
    $isSuccess = false;

    // var_dump($resultat['id']);
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $isSuccess = true;
        $nom = verifyinput($_POST["nom"]); //fonction pour la securite (trim, stripcslashes, htmlspecialchars)
        $prenom = verifyinput($_POST["prenom"]);
        $username = verifyinput($_POST["username"]);
        $currentpassword = verifyinput($_POST["currentpassword"]);
        $newpassword = verifyinput($_POST["newpassword"]);
        $comfirmNew_password = verifyinput($_POST["comfirmNew_password"]);
        $question = verifyinput($_POST["question"]);
        $reponse = verifyinput($_POST["reponse"]);

        // Si les champs sont vide 
        if (empty($nom)) {
            $nom_error = "Vous devez remplir ce champs !";
            $isSuccess = false;
        }
        if (empty($prenom)) {
            $prenom_error = "Vous devez remplir ce champs !";
            $isSuccess = false;
        }
        if (empty($username)) {
            $username_error = "Vous devez remplir ce champs !";
            $isSuccess = false;
        }
        if (empty($currentpassword)) {
            $password_error = "Vous devez remplir ce champs 8 caractères !";
            $isSuccess = false;
        }
        if (empty($question)) {
            $question_error = "Vous devez remplir ce champs !";
            $isSuccess = false;
        }
        if (empty($reponse)) {
            $reponse_error = "Vous devez remplir ce champs !";
            $isSuccess = false;
        }

        
        //  Récupération des informations dans la base de donnees
       findUser($id);

        $db_password = $resultat["password"];
        // Vérifie que le mot de passe correspond au password de la BDD
        $check_password = password_verify($currentpassword, $db_password);

        // SI mot de passe actuelle coorespond à celui de la BDD on insert les données les nouvelles données
        if ($check_password == true) {

            updateUser($nom,$prenom,$username,$question,$reponse,$id);
        }

        // SI MDP coorespond à la BDD et nouveau est égal au second de comfirmation on insert avec le newpassword
        if ($check_password == true && !empty($newpassword) && $comfirmNew_password == $newpassword) {

            // Hachage du nouveau mot de passe
            $pass_hache = password_hash($newpassword, PASSWORD_DEFAULT);

            updateUserPassword($nom,$prenom,$username,$pass_hache,$question,$reponse,$id);
        }
        findUser($id);

        $_SESSION['username'] = $resultat['username'];
        $_SESSION['nom'] = $resultat['nom'];
        $_SESSION['prenom'] = $resultat['prenom'];
    }
}