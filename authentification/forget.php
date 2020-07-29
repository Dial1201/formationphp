<?php
require_once('../Database.php');

// l'utilisateur vient d'arriver sur la page 
$username = $question = $reponse = "";
$errorPassOrId = "";
$isVerifed = false;

// Vérifie si le pseudo et le mdp existe
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $isVerifed = false;

    if (isset($_POST['username'],$_POST['question'],$_POST['reponse']) AND !empty('username') AND !empty('question') AND !empty('reponse')) {
        $username = verifyinput($_POST["username"]);  //fonction pour la securite (trim, stripcslashes, htmlspecialchars)
        $question = verifyinput($_POST["question"]); // fonction pour la securite
        $reponse = verifyinput($_POST["reponse"]); // fonction pour la securite
        $isVerifed = true;
    }
    else { // Sinon si le username et faux ou la question ou reponse et fause on indique
        $errorPassOrId = 'Mauvaise information pour la récupération du mot de passe !';     
    }
    // On se connecte à la base de données
    $db = Database::connect();

    //  Récupération du username dans la base de donnees
    $req = $db->prepare('SELECT * FROM users  WHERE username = :username ');
    $req->execute(array('username' => $username));
    $resultat = $req->fetch();
    
    // Comparaison du formulaire avec la base de données
    if ( $question === $resultat['question'] && $reponse === $resultat['reponse'] ) {
        $newPassword =  uniqid();
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $rep = $db->prepare('UPDATE users set password = :password WHERE username = :username');
        $rep->execute(array('password' => $hashedPassword,'username' => $username));

        if ($isVerifed) {
           echo"Voici votre nouveau mot de passe :<strong> $newPassword</strong> ";

           ?>
           <span><a href="../index.php">Connectez vous ici</a></span>
           <?php
        }

        
    }
    else {
        echo" La question ou la réponse n'existe pas dans le site";
    }
}

function verifyinput ($var) { // fonction pour la securite

    $var = trim($var); // trim — Supprime les espaces (ou d'autres caractères) en début et fin de chaîne
    $var = stripcslashes($var); // supprime tous les antislashs
    $var = htmlspecialchars($var); // Convertit les caractères spéciaux en entités HTML
    return $var;
}
?>

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