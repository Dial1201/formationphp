<?php
require_once('Database.php');
require_once("../functions.php");

/**
 * CE FICHIER DOIT ENREGISTRER UN NOUVEAU COMMENTAIRE EST REDIRIGER SUR L'ARTICLE !
 * 
*/
/**
  *  On doit d'abord récupérer le paramètre "id" qui sera présent en GET et vérifier son existence avec isset
  *  Si on n'a pas de param "id", on affiche un message erreur
  *  SINON, on va se connecter à la base de données,
  *  On met le résultat dans $article_id
  */

  $article_id = null;

  // On vérifie Si l'article existe avec la variable $_GET['id'] exsite avec isset
  // SI elle n'est pas vide avec !empty et que c'est un nombre entier avec ctype_digit
  // Si tout est ok ont met ca dans la variable $comment_id
  if(isset($_GET['id']) && !empty($_GET['id']) && ctype_digit($_GET['id'])) {
  $article_id = (int) $_GET['id'] ;
  }
  //Si il manque le paramètre "id" on le précise
  if(!$article_id) {
    die("Ont doit préciser un paramètre dans l'URL");
}

/**
 * 1. On vérifie que les données ont bien été envoyées en POST
 */

$username = null;
$commentaire = null;

$isSuccess = null;



if($_SERVER["REQUEST_METHOD"] == "POST") {

  //fonction pour la securite (trim, stripcslashes, htmlspecialchars)
  $username = verifyinput($_POST['nom']);
  $commentaire = verifyinput($_POST["commentaire"]);
  

  /**
   * 2. Vérification que l'id de l'article pointe bien vers un article qui existe
   */
  $db = Database::connect();

  $query = $db->prepare('SELECT * FROM partenaire WHERE id = ?');
  $query->execute([$article_id]);

  
// Si rien n'est revenu, on fait une erreur
  if ($query->rowCount() === 0) {
    die("Ho ! L'article $article_id n'existe pas !");
  }
  
  // 3. Insertion du commentaire
  $query = $db->prepare('INSERT INTO comments SET id_user = :username, texte = :commentaire, date_creation = NOW(), partenaire = :article_id');
  $query->execute(array(
    'username' => $username,
    'commentaire' => $commentaire,
    'article_id' => $article_id
  ));
 
  // 4. Redirection
  header('Location: article.php?id='. $article_id);
  
 
}

/**
     * 5 On affiche
     */
    $pageTitle = "commentaire";
    ob_start();
    require('templates/articles/insert.html.php');
    $pageContent = ob_get_clean();

    require('templates/layout.html.php');

