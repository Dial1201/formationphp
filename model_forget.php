<?php

// l'utilisateur vient d'arriver sur la page 
$username = $question = $reponse = "";
$errorPassOrId = "";
$isVerifed = false;

// Vérifie si le pseudo et le mdp existe
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $isVerifed = false;

    if (isset($_POST['username'], $_POST['question'], $_POST['reponse']) and !empty('username') and !empty('question') and !empty('reponse')) {
        $username = verifyinput($_POST["username"]);  //fonction pour la securite (trim, stripcslashes, htmlspecialchars)
        $question = verifyinput($_POST["question"]); // fonction pour la securite
        $reponse = verifyinput($_POST["reponse"]); // fonction pour la securite
        $isVerifed = true;
    } else { // Sinon si le username et faux ou la question ou reponse et fause on indique
        $errorPassOrId = 'Mauvaise information pour la récupération du mot de passe !';
    }
    // On se connecte à la base de données
    $db = Database::connect();

    //  Récupération du username dans la base de donnees
    $req = $db->prepare('SELECT * FROM users  WHERE username = :username ');
    $req->execute(array('username' => $username));
    $resultat = $req->fetch();

    // Comparaison du formulaire avec la base de données
    if ($question === $resultat['question'] && $reponse === $resultat['reponse']) {
        $newPassword =  uniqid();
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $rep = $db->prepare('UPDATE users set password = :password WHERE username = :username');
        $rep->execute(array('password' => $hashedPassword, 'username' => $username));

        if ($isVerifed) {
            echo '<div class="alert alert-success">';
            echo "Voici votre nouveau mot de passe :<strong> $newPassword</strong> ";
            echo "</div>";
?>
            <div class="alert alert-success">
                <span><a href="../index.php">Connectez vous ici</a></span>
            </div>

<?php
        }
    } else {
        echo '<div class="alert alert-danger">';
        echo " La question ou la réponse n'existe pas dans le site";
        echo "</div>";
    }
}