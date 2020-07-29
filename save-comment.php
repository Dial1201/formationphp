<?php
require_once('Database.php');

$isSuccess = null;

/**
 * CE FICHIER DOIT ENREGISTRER UN NOUVEAU COMMENTAIRE EST REDIRIGER SUR L'ARTICLE !
 * 
*/
/**
  *  On doit d'abord récupérer le paramètre "id" qui sera présent en GET et vérifier son existence avec isset
  *  Si on n'a pas de param "id", on affiche un message erreur
  *  SINON, on va se connecter à la base de données,
  *  On met le résultat dans $getId
  */

 $getId = null;

  // On vérifie Si l'article existe avec la variable $_GET['id'] exsite avec isset
  // SI elle n'est pas vide avec !empty et que c'est un nombre entier avec ctype_digit
  // Si tout est ok ont met ca dans la variable $comment_id
  if(isset($_GET['id']) && !empty($_GET['id']) && ctype_digit($_GET['id'])) {
   $getId = $_GET['id'] ;
  }
  //Si il manque le paramètre "id" on le précise
  if(!$getId) {
    die("Ont doit préciser un paramètre dans l'URL");
}

// On se connecte à la base de données
$db = Database::connect();

//  On récupère un partenaire
  $query = $db-> prepare("SELECT id FROM partenaire WHERE id = :getId");
  $query->execute(['getId' => $getId]);
  // On met le résultat dans $getId
  $getId = $query->fetch();

/**
 * 1. On vérifie que les données ont bien été envoyées en POST
 */

$username = $commentaire = $article_id = null;

if($_SERVER["REQUEST_METHOD"] == "POST") {

  //fonction pour la securite (trim, stripcslashes, htmlspecialchars)
  $username = verifyinput($_POST['nom']);
  $commentaire = verifyinput($_POST["commentaire"]);
  // Vérifie que la chaine $_POST est un entier
  $article_id = ctype_digit($_POST['prodId']);

  /**
   * 2. Vérification que l'id de l'article pointe bien vers un article qui existe
   */
  $db = Database::connect();

  if ($query->rowCount() === 1) {
    $query = $db->prepare('SELECT * FROM partenaire WHERE id = :article_id');
    $query->execute(['article_id' => $article_id]);
  }
  else {
    // Sinon on crée une erreur
    die("Ho ! L'article $article_id n'existe pas !");
  }

  // 3. Insertion du commentaire
  $query = $db->prepare('INSERT INTO comments SET user_id = :username, texte = :commentaire, date_creation = NOW(), partenaire = :article_id');
  $query->execute(array(
    'username' => $username,
    'commentaire' => $commentaire,
    'article_id' => $article_id
  ));

  // 4. Redirection
  header('Location: article.php?id=' . $article_id);
  
 
}

/**
 * 5. On affiche
 * */
ob_start();
require('templates/articles/insert.html.php');
$pageContent = ob_get_clean();

require('templates/layout.html.php');



