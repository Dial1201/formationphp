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