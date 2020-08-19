<?php

// Connexion à la base de données
require_once("../Database.php");
require_once("../functions.php");

$messageHome = "Vous allez être rediriger vers la page d'accueil dans un instant ...";
$isSuccess = false;
	// Vérification de la validité des informations

	if (isset($_POST["nom"],$_POST["prenom"],$_POST["username"],$_POST["password"],$_POST["question"],$_POST["reponse"]))
	{
		
		$nom = verifyinput($_POST["nom"]); //fonction pour la securite (trim, stripcslashes, htmlspecialchars)
		$prenom = verifyinput($_POST["prenom"]);
		$username = verifyinput($_POST["username"]);
		$password = verifyinput($_POST["password"]);
		$question = verifyinput($_POST["question"]);
		$reponse = verifyinput($_POST["reponse"]);
		$isSuccess = true;
		
		if ($isSuccess) {

			// On se connecte à la base de données
			$db = Database::connect();
			
			// Trouve le username correspondant au username
			$query = $db->prepare('SELECT * FROM users WHERE username = :username');
			$query->execute(['username' => $username]);
			$user = $query->fetch();
			
			if ($user === true) {
				
				echo'<div class="alert alert-danger">';
				echo"Le username existe déjà";
				echo"<br>"; 
				echo'<a href="../index.php"><strong>Changer votre username</strong></a>';
				echo"</div>"; 

			}

			// Hachage du mot de passe
			$pass_hache = password_hash($password, PASSWORD_DEFAULT);

			// Insertion des informations dans la base de donnees 
			$req = $db->prepare('INSERT INTO users(nom, prenom, username, password, question, reponse) 
								VALUES(?,?,?,?,?,?)');

			$req->execute(array($nom,$prenom,$username,$pass_hache,$question,$reponse));
			$db = Database::disconnect();

			echo'<div class="alert alert-success">'; 
           	echo"<strong> $messageHome</strong> ";
			echo"</div>";
			
			redirection("../index.php");   	
		}
	}


	