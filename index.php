<?php

// Connexion à la base de données
require_once("Database.php");
require_once("functions.php");

$nom = $prenom = $username = $password = $passwordValid = $question = $reponse = "";
$nom_error = $prenom_error = $username_error = $password_error = $question_error = $reponse_error = "";
$usernameNoValid = $passwordNoSame = "";
$isSuccess = "";

// SI l'utilisateur à valider
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$isSuccess = true;
	$nom = verifyinput($_POST["nom"]); //fonction pour la securite (trim, stripcslashes, htmlspecialchars)
	$prenom = verifyinput($_POST["prenom"]);
	$username = verifyinput($_POST["username"]);
	$password = verifyinput($_POST["password"]);
	$passwordValid = verifyinput($_POST["passwordValid"]);
	$question = verifyinput($_POST["question"]);
	$reponse = verifyinput($_POST["reponse"]);
	

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
	if (empty($password)) {
		$password_error = "Vous devez remplir ce champs 8 caractères !";
		$isSuccess = false;
	}
	if (empty($passwordValid)) {
		$password_error = "Vous devez comfirmer le mot de passe  !";
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

	/**
	 * On se connect à la base de données ensuite on vérifie que le username existe pas
	 * Si le username existe déjà on informe l'utilisateur
	 * Sinon on valid le username
	 *  */
	$db = Database::connect();
	$query = $db->prepare('SELECT * FROM users WHERE username = :username');
	$query->execute(['username' => $username]);
	$resultat = $query->rowCount();
	$db = Database::disconnect();

	if ($resultat == 0) {
		if ($password == $passwordValid) {

			// Hachage du mot de passe
			$pass_hache = password_hash($password, PASSWORD_DEFAULT);
		} else {
			$passwordNoSame = "Les mots de passe ne sont identique !!!";
			$isSuccess = false;
		}
	} else {
		$usernameNoValid = "Le username est déjà utilisé !!!";
		$isSuccess = false;
	}

	if ($isSuccess) {
		
		$db = Database::connect();
		// Insertion des informations dans la base de donnees 
		$req = $db->prepare('INSERT INTO users(nom, prenom, username, password, question, reponse) 
				VALUES(?,?,?,?,?,?)');

		$req->execute(array($nom, $prenom, $username, $pass_hache, $question, $reponse));

		$db = Database::disconnect();

		// redirection("index.php");
	}
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<link rel="stylesheet" href="css/test.css">
</head>

<title>GBAF</title>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


<body>
	<div class="container-fluid">
		<div class="container">

			<form class="form-inline" role="form" method="POST" action="authentification/login.php">

				<p class="text-uppercase mr-2">CONNECTEZ-VOUS:</p>

				<div class="form-group mb-2">
					<input type="text" name="usernameCo" id="usernameCo" class="form-control input-lg" placeholder="Pseudo">
				</div>

				<div class="form-group mx-sm-3 mb-2">
					<input type="password" name="passwordCo" id="passwordCo" class="form-control input-lg" placeholder="password">
				</div>

				<button type="submit" class="btn btn-outline-primary mb-2">Se Connecter</button>
				
			</form>

			<div class="d-flex justify-content-end">
				<a class="btn btn-outline-danger" href="authentification/forget.php" role="button">Mot de passe oublié</a>
			</div>

			<h2 class="text-center" id="title">Le Groupement Banque Assurance Français</h2><img src="image/logo.png" alt="Groupement Banque Assurance Français" weight="60" height="60">

			<hr>
			<div class="row">
				<div class="col-md-2">

				</div>
				<div class="col-md-8">
					<form role="form" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
						
							<p class="text-uppercase pull-center">S'INSCRIRE.</p>
							<div class="form-group">
								<input type="text" name="nom" id="nom" class="form-control input-lg" placeholder="Nom" value="<?php echo $nom; ?>">
								<p class="text-danger"><?php echo $nom_error; ?></p>
							</div>
							<div class="form-group">
								<input type="text" name="prenom" id="prenom" class="form-control input-lg" placeholder="prenom" value="<?php echo $prenom; ?>">
								<p class="text-danger"><?php echo $prenom_error; ?></p>
							</div>
							<div class="form-group">
								<input type="text" name="username" id="username" class="form-control input-lg" placeholder="Pseudo" value="<?php echo $username; ?>">
								<p class="text-danger"><?php echo $username_error; ?></p>
								<p class="text-danger"><?php echo $usernameNoValid; ?></p>
							</div>
							<div class="form-group">
								<input type="password" name="password" id="password" class="form-control input-lg" placeholder="Mot de Passe" minlength="8" value="<?php echo $password; ?>">
								<p class="text-danger"><?php echo $reponse_error; ?></p>
								<p class="text-danger"><?php echo $passwordNoSame; ?></p>
							</div>
							<div class="form-group">
								<input type="password" name="passwordValid" id="passwordValid" class="form-control input-lg" placeholder="Comfirmer Mot de Passe" minlength="8" value="<?php echo $passwordValid; ?>">
								<p class="text-danger"><?php echo $reponse_error; ?></p>
								<p class="text-danger"><?php echo $passwordNoSame; ?></p>
							</div>
							<div class="form-group">

								<label for="question">Choississez votre question ?</label><br />
								<select class="form-control" name="question" id="question">
									<option value="couleur">Quelle est votre couleur préférée ?</option>
									<option value="ville">Quelle est votre ville favorite ?</option>
									<option value="ecole">Quelle était le nom de votre école primaire ?</option>

								</select>
							</div>

							<div class="form-group">
								<input type="text" name="reponse" id="reponse" class="form-control input-lg" placeholder="Tapez votre réponse secrète" size="30" value="<?php echo $reponse; ?>">
								<p class="text-danger"><?php echo $reponse_error; ?></p>
							</div>

							<div>
								<input type="submit" class="btn btn-outline-primary" value="Valider">
							</div>
							<strong>
							<p class="text-success" style="display:<?php if($_SERVER["REQUEST_METHOD"] == "POST" && $isSuccess == true) echo'block'; else echo'none'; ?>;">Votre compte à bien été validé</p>
							</strong>
						
					</form>

				</div>

				<div class="col-md-2">

				</div>

			</div>
		</div>

	</div>
</body>

</html>