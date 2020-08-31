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