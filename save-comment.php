<?php
require_once('Database.php');

$isSuccess = null;

/**
 * CE FICHIER DOIT ENREGISTRER UN NOUVEAU COMMENTAIRE EST REDIRIGER SUR L'ARTICLE !
 * 
*/
/**
  *  Récupération du partenaire avec "id" et vérification
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

/**
 * On se connecte à la base de données
 */
$db = Database::connect();

/**
   * 3 On récupère un partenaire
   */
  $query = $db-> prepare("SELECT * FROM partenaire WHERE id = :getId");

  // On précise le paramètre de un partenaire
  $query->execute(['getId' => $getId]);

  // On met le résultat dans $getId
  $getId = $query->fetch();



  
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


