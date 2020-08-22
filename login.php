<?php
require_once('../Database.php');
require_once("../functions.php");

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

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <title>GBAF</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

    <link rel="stylesheet" href="../css/test.css">
</head>

<body>
    <div class="container-fluid">
        <div class="container">
            <div class="d-flex justify-content-end">
                <a class="btn btn-outline-danger" href="forget.php" role="button">Mot de passe oublié</a>
            </div>
            <hr>
            <h2 class="text-center" id="title">Le Groupement Banque Assurance Français</h2><img src="../image/logo.png" alt="Groupement Banque Assurance Français">
            <p class="text-center">Le GBAF est le représentant de la profession bancaire et des assureurs sur tous  les axes de la réglementation financière française.<br>
                Site répertoriant un grand nombre d’informations  sur les partenaires et acteurs du groupe ainsi que sur les produits et services  bancaires et financiers.</p>
            <br>
            <div class="row">
                <div class="col-md-2"></div>

                <div class="col-md-8">

                    <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
                        <p class="text-uppercase pull-center font-weight-bold">CONNECTEZ-VOUS:</p>

                        <div class="form-group">
                            <input type="text" name="usernameCo" id="usernameCo" class="form-control input-lg" placeholder="Pseudo" value="<?php echo $usernameCo; ?>">
                            <p class="text-danger"><?php echo $username_no_valid; ?></p>
                        </div>

                        <div class="form-group">
                            <input type="password" name="passwordCo" id="passwordCo" class="form-control input-lg" placeholder="password">

                            <p class="text-danger"><?php echo $passwordCo_No_Valid; ?></p>
                        </div>

                        <div>
                            <input type="submit" class="btn btn-outline-primary" value="Se Connecter">
                        </div>
                        <p class="text-danger font-weight-bold"><?php echo $empty_error; ?></p>
                    </form>

                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
</body>

</html>