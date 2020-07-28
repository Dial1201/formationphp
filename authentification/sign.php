<?php

// Connexion à la base de données
require_once("../Database.php");


// l'utilisateur vient d'arriver sur la page 

/*$nom = $prenom = $username = $password = $question = $reponse = "";
$error = "";

*/

// if($_SERVER["REQUEST_METHOD"] == "POST") { // l'utilisateur à valider l'inscription ont traite les infos sur la même page
$messageHome = "Vous allez être rediriger vers la page d'accueil dans un instant ...";
$isSuccess = false;
	// Vérification de la validité des informations

	if (isset($_POST["nom"],$_POST["prenom"],$_POST["username"],$_POST["password"],$_POST["question"],$_POST["reponse"]))
	{
		
		$nom = verifyinput($_POST["nom"]);
		$prenom = verifyinput($_POST["prenom"]);
		$username = verifyinput($_POST["username"]);
		$password = verifyinput($_POST["password"]);
		$question = verifyinput($_POST["question"]);
		$reponse = verifyinput($_POST["reponse"]);
		$isSuccess = true;

		if ($isSuccess) {

			// On se connecte à la base de données
			$db = Database::connect();

			// Hachage du mot de passe
			$pass_hache = password_hash($password, PASSWORD_DEFAULT);

			// Insertion des informations dans la base de donnees 
			$req = $db->prepare('INSERT INTO users(nom, prenom, username, password, question, reponse) 
								VALUES(?,?,?,?,?,?)');

			$req->execute(array($nom,$prenom,$username,$pass_hache,$question,$reponse));
				
			echo" <div class=\"messageHome\">$messageHome</div>";
		}

		header('location: ../accueil.php');
	}
		 else //if (empty($nom) OR empty($prenom) OR empty($username) OR empty($password) OR empty($question) OR empty($reponse))
		{ // SI ces champs sont vide

			// $error = "Vous devez remplir tous les champs !!!";
			$isSuccess = false;
		}
		
		
//}
	
	function verifyinput ($var) { // fonction pour la securite
		
		$var = trim($var); // trim — Supprime les espaces (ou d'autres caractères) en début et fin de chaîne
		$var = stripcslashes($var); // supprime tous les antislashs
		$var = htmlspecialchars($var); // Convertit les caractères spéciaux en entités HTML
		return $var;
	}

?>

<!-- <div class="row">
			<form action="<?php // echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
				<div class="form-group">
					<label class="col col-md-4" for="nom" >Nom</label>
					<input class="col col-md-6" type="text" name="nom" id="nom" placeholder="Olivier" required>
						
                </div>
                
                <div class="form-group">
					<label class="col col-md-4" for="prenom" >Prenom</label>
					<input class="col col-md-6" type="text" name="prenom" id="prenom" placeholder="Martin" required>
						
                </div>
                
                <div class="form-group">
					<label class="col col-md-4" for="username" >Username</label>
					<input class="col col-md-6" type="text" name="username" id="username" placeholder="@joe01" required>
						
				</div>
					
				<div class="form-group">
					<label class="col col-md-4" for="password" >Mot de passe</label>
					<input class="col col-md-6" type="password" name="password" id="password" placeholder="********" minlength="8" required>
					
				</div>
						
				<div class="form-group">
					<label class="col col-md-4" for="question" >Question secrèt</label>
					<input class="col col-md-6" type="text" name="question" id="question" placeholder="Comment s'appelle ma tante ?" size="30" required>
						
                </div>
                
                <div class="form-group">
					<label class="col col-md-4" for="reponse" > Réponse à la question secrète</label>
					<input class="col col-md-6" type="text" name="reponse" id="reponse" placeholder="Ma tante s'appelle Anna" size="30" required>
					
				</div>
					
				<p><input type="submit" class="btn btn-primary" value="Valider"></p>

				 <p><?php // echo '<strong>' . $error . '</strong>'; ?></p>
				<p class="comfirmation" style="display: <?php // if($isSuccess) echo'block'; else echo'none'; ?> ">Votre inscription à bien été valider.</p>
			</form>
		</div>
	</div> -->