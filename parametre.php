<?php
require_once("Database.php");
require_once("functions.php");

// On vérifie que la variable $_GET['id'] et $_GET['username'] exsite avec isset
// SI elle n'est pas vide avec !empty et que c'est un nombre entier avec ctype_digit
// Si tout est ok ont met on converti avec int la variable et on stock dans $id 

session_start();

if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
    $id = $_SESSION['id'];

    $db = DataBase::connect();
    $req = $db->prepare('SELECT * FROM users WHERE id =?');
    $req->execute(array($id));
    $resultat = $req->fetch();
    $db = DataBase::disconnect();

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

        $db = DataBase::connect();
        //  Récupération des informations dans la base de donnees
        $req = $db->prepare('SELECT * FROM users WHERE id = :id');
        $req->execute(array('id' => $id));
        $resultat = $req->fetch();

        $db_password = $resultat["password"];
        // Vérifie que le mot de passe correspond au password de la BDD
        $check_password = password_verify($currentpassword, $db_password);

        // SI mot de passe actuelle coorespond à celui de la BDD on insert les données les nouvelles données
        if ($check_password == true) {

            $statement = $db->prepare("UPDATE users SET nom = :nom, prenom = :prenom, username = :username, question = :question, reponse = :reponse WHERE id = :id");
            $statement->execute(array(
                'nom' => $nom,
                'prenom' => $prenom,
                'username' => $username,
                'question' => $question,
                'reponse' => $reponse,
                'id' => $id
            ));
        }

        // SI MDP coorespond à la BDD et nouveau est égal au second de comfirmation on insert avec le newpassword
        if ($check_password == true && !empty($newpassword) && $comfirmNew_password == $newpassword) {

            // Hachage du nouveau mot de passe
            $pass_hache = password_hash($newpassword, PASSWORD_DEFAULT);

            $statement = $db->prepare("UPDATE users SET nom = :nom, prenom = :prenom, username = :username, password = :password, question = :question, reponse = :reponse WHERE id = :id");
            $statement->execute(array(
                'nom' => $nom,
                'prenom' => $prenom,
                'username' => $username,
                'password' => $pass_hache,
                'question' => $question,
                'reponse' => $reponse,
                'id' => $id
            ));
        }
        $statement = $db->prepare('SELECT * FROM users WHERE id = ?');
        $statement->execute(array($id));
        $resultat = $statement->fetch();

        $_SESSION['username'] = $resultat['username'];
        $_SESSION['nom'] = $resultat['nom'];
        $_SESSION['prenom'] = $resultat['prenom'];
    }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Font stylesheet -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/test.css">
    <title>parametre</title>
</head>

<body>
    <div class="container site">

        <!-- HEADER -->

        <?php include_once "libraries/header.php"; ?>

        <div class="container-fluid">
            <div class="container">
                <h2 class="text-center" id="title">Le Groupement Banque Assurance Français</h2><img src="image/logo.png" alt="Groupement Banque Assurance Français" weight="60" height="60">
                <br>
                <div class="row">
                    <div class="col-md">
                        <form method="post" action="parametre.php">
                            <fieldset>
                                <p class="text-uppercase pull-center">Modifier vos informations</p>
                                <div class="form-group">
                                    <input type="text" name="nom" id="nom" class="form-control input-lg" value="<?= $resultat['nom']; ?>" placeholder="Tapez votre nom">
                                    <p class="text-danger"><?php echo $nom_error; ?></p>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="prenom" id="prenom" class="form-control input-lg" value="<?= $resultat['prenom']; ?>" placeholder="Tapez votre prenom">
                                    <p class="text-danger"><?php echo $prenom_error; ?></p>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="username" id="username" class="form-control input-lg" value="<?= $resultat['username']; ?>" placeholder="Tapez votre username">
                                    <p class="text-danger"><?php echo $username_error; ?></p>
                                    <p class="text-danger"><?php echo $usernameNoValid; ?></p>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="currentpassword" id="password" class="form-control input-lg" placeholder="Mot de passe actuelle" minlength="8">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="newpassword" id="password" class="form-control input-lg" placeholder="Nouveau mot de passe" minlength="8">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="comfirmNew_password" id="password" class="form-control input-lg" placeholder="Comfirmer votre nouveau mot de passe" minlength="8">
                                </div>
                                <div class="form-group">

                                    <label for="question">Modifier votre question ?</label><br />
                                    <select class="form-control" name="question" id="question" value="">
                                        <option value="couleur">Quelle est votre couleur préférée ?</option>
                                        <option value="ville">Quelle est votre ville favorite ?</option>
                                        <option value="ecole">Quelle était le nom de votre école primaire ?</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="reponse" id="reponse" class="form-control input-lg" value="<?= $resultat['reponse']; ?>" placeholder="Tapez votre réponse" size="30">
                                    <p class="text-danger"><?php echo $reponse_error; ?></p>
                                </div>
                                <div>
                                    <input type="submit" class="btn btn-lg btn-primary" value="Valider">
                                </div>
                                <p class="text-success" style="display:<?php if ($_SERVER["REQUEST_METHOD"] == "POST" && $isSuccess == true) echo 'block';
                                                                        else echo 'none'; ?>;">Votre compte à bien été modifié</p>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- FOOTER -->

        <?php include_once "libraries/footer.php"; ?>

    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
</body>

</html>