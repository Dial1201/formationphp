<?php
    require_once ("Database.php");
    require_once("functions.php");
    
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

    $db = Database::disconnect();

    $db_password = $resultat["password"];

    $nom = $prenom = $username = $currentpassword = $newpassword = $comfirmNew_password = $question = $reponse = "";
    $isSuccess = false;

	if(!empty($_POST)){
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

        // SI mot de passe actuelle coorespond à celui de la BDD on insert les données les nouvelles données
        if($check_password){ 
            $db = Database::connect();
            $statement = $db->prepare("UPDATE users SET nom = :nom, prenom = :prenom, username = :username, question = :question, reponse = :reponse WHERE id = :id");
            $statement->execute(array(
                'nom'=>$nom,
                'prenom'=>$prenom,
                'username'=>$username,
                'question'=>$question,
                'reponse'=>$reponse,
                'id'=>$id
            ));
           
            // SI MDP coorespond à la BDD et nouveau est égal au second de comfirmation on insert avec le newpassword
            if($check_password == true && $newpassword == $comfirmNew_password){

                // Hachage du nouveau mot de passe
                $pass_hache = password_hash($newpassword, PASSWORD_DEFAULT);
                
                $statement = $db->prepare("UPDATE users SET nom = :nom, prenom = :prenom, username = :username, password = :password, question = :question, reponse = :reponse WHERE id = :id");
                $statement->execute(array(
                    'nom'=>$nom,
                    'prenom'=>$prenom,
                    'username'=>$username,
                    'password'=>$pass_hache,
                    'question'=>$question,
                    'reponse'=>$reponse,
                    'id'=>$id
            ));
               
            }
            
            $statement = $db->prepare('SELECT id,nom,prenom,username FROM users WHERE id = ?');
            $statement->execute(array($id));
            $newpassword = $statement->fetch();

            session_start();
            $_SESSION['id'] = $newpassword['id'];
            $_SESSION['username'] = $newpassword['username'];
            $_SESSION['nom'] = $newpassword['nom'];
            $_SESSION['prenom'] = $newpassword['prenom'];
            // header("Location: accueil.php");
            redirection("accueil.php");     
        }
         
            $db = Database::disconnect();
            
        }

    /**
     *  On affiche
     */
    $pageTitle = "paramètre";
    ob_start();
    require('templates/articles/setting.html.php');
    $pageContent = ob_get_clean();

    require('templates/layout.html.php');
    ?>

    
    
    