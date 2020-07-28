<?php
require_once('Database.php');

/**
 * CE FICHIER DOIT ENREGISTRER UN NOUVEAU COMMENTAIRE EST REDIRIGER SUR L'ARTICLE !
 * 
*/
/**
  * 1 Récupération du paramètre "id" et vérification
  */

  $comment_id = null;

  // On vérifie Si la variable $_GET['id'] exsite avec isset SI elle n'est pas vide avec !empty et que c'est un nombre entier avec ctype_digit
  // Si tout est ok ont met ca dans la variable $comment_id
  if(isset($_GET['id']) && !empty($_GET['id']) && ctype_digit($_GET['id'])) {
    $comment_id = $_GET['id'];
  }
  // Sinon il manque le paramètre "id" on le précise
  else {
      die("Ont doit préciser un paramètre dans l'URL");
  }

   /**
   * 2 On se connecte à la base de données
   */

  $db = Database::connect();

  $commentaireError = "";

  $isSuccess = false;

  /**
   * 3 On vérifie si les POST existe et si il sont pas vide
   */

	if(isset($_POST['name'],$_POST['commentaire']) && !empty($_POST['name']) && !empty($_POST['commentaire'])) {

		$name 		     = verifyinput($_POST['name']);
    $commentaire   = verifyinput($_POST['commentaire']);

        
        // Vérification que l'id de l'article pointe bien vers un article qui existe  
        $query = $pdb->prepare('SELECT * FROM partenaire WHERE id = :comment_id');
        $query->execute(['comment_id' => $comment_id]);

        // Si l'article existe pas, on fait une erreur
        if ($query->rowCount() === 0) {
            die("Ho ! L'article $comment_id n'existe pas !");
        }

		$isSuccess = true;
		
		if (empty($commentaire)) {
			$commentaireError = 'Ce champs ne peut pas être vide';
			$isSuccess = false;
    }

		if($isSuccess) {
            // Insertion du commentaire
			
			$statement = $db->prepare("INSERT INTO comments (id_user,texte,date_creation,partenaire)
                                 value (:id_user,:texte,NOW(),:comment_id");

      $statement->execute(array('id_user' => $name,
                                ':texte' =>$commentaire,
                                'comment_id' => $comment_id));
    
      // Redirection vers l'article en question
			header("Location: article.php?id=" . $comment_id);
		}


  }
  
  function verifyinput ($var) { // fonction pour la securite

    $var = trim($var); // trim — Supprime les espaces (ou d'autres caractères) en début et fin de chaîne
    $var = stripcslashes($var); // supprime tous les antislashs
    $var = htmlspecialchars($var); // Convertit les caractères spéciaux en entités HTML
    return $var;
}
    
    /**
     * 4 On affiche
     */
    ob_start();
    require('templates/articles/insert.html.php');
    $pageContent = ob_get_clean();

    require('templates/layout.html.php');
 ?>


