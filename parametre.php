<?php
	require 'Database.php';
    
    // On vérifie que la variable $_GET['id'] et $_GET['username'] exsite avec isset
  // SI elle n'est pas vide avec !empty et que c'est un nombre entier avec ctype_digit
  // Si tout est ok ont met on converti avec int la variable et on stock dans $id 
  /**
   * Ps: Quand je veux vérifier $_GET['username'] mon code affiche des erreur sur mon id donc je ne peux pas vérifier les deux valeur
   * GET
   */
  if(isset($_GET['id']) && !empty($_GET['id'])) {
    $id = (int) $_GET['id'] ;
    // $session_username =  $_GET['username'];
    }
    
    //Si il manque le paramètre "id" on le précise
    if(!$id) {
      die("Ont doit préciser un paramètre id dans l'URL");
    }

    $db = Database::connect();

    //  Récupération des informations dans la base de donnees
    $req = $db->prepare('SELECT * FROM users  WHERE id = :id ');
    $req->execute(array('id' => $id));
    $resultat = $req->fetch();

    $db_password = $resultat["password"];

    $nom = $prenom = $username = $currentpassword = $newpassword = $comfirmNew_password = $question = $reponse = "";
    $isSuccess = false;

	if(!empty($_POST)) {

		$nom = verifyinput($_POST["nom"]); //fonction pour la securite (trim, stripcslashes, htmlspecialchars)
		$prenom = verifyinput($_POST["prenom"]);
		$username = verifyinput($_POST["username"]);
        $currentpassword = verifyinput($_POST["currentpassword"]);
        $newpassword = verifyinput($_POST["newpassword"]);
        $comfirmNew_password = verifyinput($_POST["comfirmNew_password"]);
		$question = verifyinput($_POST["question"]);
		$reponse = verifyinput($_POST["reponse"]);
        $isSuccess = true;

        // Vérifie que le mot de passe correspond au password de la BDD
        $check_password = password_verify ( $currentpassword , $db_password );

        // SI mot de passe actuelle retourne vrai
        if ($check_password) {
            //Vérifie que le nouveau mot de passe correspond au mtp de comfirmation
            if ($newpassword === $comfirmNew_password) {
                // Hachage du nouveau mot de passe
                $pass_hache = password_hash($newpassword, PASSWORD_DEFAULT);
            }
            else {
                echo" Le nouveau mot de passe ne correspond pas au mot de passe comfirmer !!!";
            }
        }
        else {
            echo"Le mot de passe actuelle ne correspond pas au mot de passe enregistrer !!!";
        }
        
		if($isSuccess) {

			$db = DataBase::connect();

				$statement = $db->prepare("UPDATE users set nom = ?, prenom = ?, username = ?, password = ?, question = ?, reponse = ?, WHERE id = ?");
				$statement->execute(array($nom,$prenom,$username,$pass_hache,$question,$reponse,$id));
                $newresultat = $statement->fetch();
                session_start();
                $_SESSION['id'] = $newresultat['id'];
                $_SESSION['username'] = $newresultat['username'];
			
			DataBase::disconnect();
			header("Location: accueil.php");
		}

		
	}
	


	function verifyinput($data) {
		
		$data = trim($data);
		$data = stripcslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
 ?>

<!DOCTYPE html>
<html lang="fr">
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <link rel="stylesheet" href="css/test.css">
	</head>

	<title>GBAF</title>

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	
	<body>
	<div class="container-fluid">
		<div class="container">
			<h2 class="text-center" id="title">Le Groupement Banque Assurance Français</h2><img src="image/logo.png" alt="Groupement Banque Assurance Français" weight="60" height="60">
			
 			<hr>
			<div class="row">
				<div class="col-md">
 					<form role="form" method="post" action="">
						<fieldset>							
                            <p class="text-uppercase pull-center">Modifier vos informations</p>
                            <div class="form-group">
								<input type="text" name="nom" id="nom" class="form-control input-lg" placeholder="Tapez votre nom" required>
                            </div>
                            <div class="form-group">
								<input type="text" name="prenom" id="prenom" class="form-control input-lg" placeholder="Tapez votre prenom"  required>
							</div>	
 							<div class="form-group">
								<input type="text" name="username" id="username" class="form-control input-lg" placeholder="Tapez votre username"  required>
							</div>
							<div class="form-group">
                                <input type="password" name="currentpassword" id="password" class="form-control input-lg" placeholder="Mot de passe actuelle" minlength="8" required>
                            </div>
                            <div class="form-group">
                                <input type="password" name="newpassword" id="password" class="form-control input-lg" placeholder="Nouveau mot de passe" minlength="8" required>
                            </div>
                            <div class="form-group">
                                <input type="password" name="comfirmNew_password" id="password" class="form-control input-lg" placeholder="Comfirmer votre nouveau mot de passe" minlength="8" required>
							</div>
                            <div class="form-group">
			
								<label for="question">Choississez votre question ?</label><br />
									<select name="question" id="question"  required>
										<option value="couleur">Quelle est votre couleur préférée ?</option>
										<option value="ville">Quelle est votre ville favorite ?</option>
										<option value="ecole">Quelle était le nom de votre école primaire ?</option>

									</select>
							</div>

                            <div class="form-group">
								<input type="text" name="reponse" id="reponse" class="form-control input-lg" placeholder="Tapez votre réponse" size="30" required>
							</div>
							
 							<div>
 								<input type="submit" class="btn btn-lg btn-primary"   value="Valider">
 							</div>
						</fieldset>
					</form>
				</div>
			</div>
		</div>
		
	</div>
	</body>
	 

</html>