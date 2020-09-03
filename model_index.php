<?php
require_once("DataBase.php");

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

	// Si les champs est vide 
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
	$db = DataBase::connect();
	$query = $db->prepare('SELECT * FROM users WHERE username = :username');
	$query->execute(['username' => $username]);
	$resultat = $query->rowCount();
	$db = DataBase::disconnect();

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

		$db = DataBase::connect();
		// Insertion des informations dans la base de donnees 
		$req = $db->prepare('INSERT INTO users(nom, prenom, username, password, question, reponse) 
				VALUES(?,?,?,?,?,?)');

		$req->execute(array($nom, $prenom, $username, $pass_hache, $question, $reponse));

		$db = DataBase::disconnect();

		
	}
	// redirection("authentification/login.php");
}