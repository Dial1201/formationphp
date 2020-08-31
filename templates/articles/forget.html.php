<!DOCTYPE html>
<html lang="fr">

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

    <link rel="stylesheet" href="../css/test.css">
</head>

<title>GBAF</title>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


<body>
    <div class="container-fluid">
        <div class="container">
            <h2 class="text-center" id="title">Le Groupement Banque Assurance Français</h2><img src="../image/logo.png" alt="Groupement Banque Assurance Français" weight="60" height="60">

            <br>
            <div class="row">
                <div class="col-md-6">
                    <form role="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                        <fieldset>
                            <div class="form-group">
                                <input type="text" name="username" id="username" class="form-control input-lg" placeholder="Pseudo" required>
                            </div>
                            <div>
                                <div class="form-group">
                                    <!-- <input type="text" name="question" id="question" class="form-control input-lg" placeholder="Tapez votre question secrète" size="30" required> -->
                                    <label for="question">Choississez votre question ?</label><br />
                                    <select name="question" id="question">
                                        <option value="couleur">Quelle est votre couleur préférée ?</option>
                                        <option value="ville">Quelle est votre ville favorite ?</option>
                                        <option value="ecole">Quelle était le nom de votre école primaire ?</option>

                                    </select>
                                </div>
                            </div>
                            <div>
                                <input type="text" name="reponse" id="reponse" size="30" class="form-control input-lg" placeholder="Tapez votre réponse secrète" required>
                            </div>

                            <p><input type="submit" class="btn btn-primary" value="Valider"></p>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
</body>


</html>