<?php
require_once('Database.php');
/**
 * CE FICHIER DOIT AFFICHER UN PARTENAIRE ET SES COMMENTAIRES
 * 
 * On doit d'abord récupérer le paramètre "id" qui sera présent en GET et vérifier son existence avec isset
 * Si on n'a pas de param "id", on affiche un message erreur
 * 
 * SINON, on va se connecter à la base de données, récupérer les commentaires du plus ancien au plus récent
 * (SELECT * FROM comments WHERE partenaire_id = ?)
 * 
 * On va afficher un partenaire puis ses commentaires
 */

 /**
  * 1 Récupération du paramètre "id" et vérification
  */

  $partenaire_id = null;

  // On vérifie Si la variable $_GET['id'] n'est pas vide et que c'est un nombre entier 
  if(isset($_GET['id']) && !empty($_GET['id']) && ctype_digit($_GET['id'])) {
    $partenaire_id = $_GET['id'];
  }
  // Si il manque le paramètre "id" on le précise
  if(!$partenaire_id) {
      die("Ont doit préciser un paramètre dans l'URL");
  }

  /**
   * 2 On se connecte à la base de données
   */

  $db = Database::connect();

  /**
   * 3 On récupère un partenaire
   */
   $query = $db-> prepare("SELECT * FROM partenaire WHERE id = :partenaire_id");

   // On précise le paramètre de un partenaire
   $query->execute(['partenaire_id' => $partenaire_id]);

   // On met le résultat dans $partenaire
   $partenaire = $query->fetch();

   /**
    * 4 On récupère tous les commentaires de un partenaire
    */
    $query = $db->prepare("SELECT * FROM comments WHERE partenaire = :partenaire_id");
    $query->execute(['partenaire_id' => $partenaire_id]);
    $commentaires = $query->fetchAll();

    /**
     * 5 on calcul le nombre de likes et dislikes
     */
    $likes = $db->prepare('SELECT id FROM likes WHERE id_article = ?');
    $likes->execute(array($partenaire_id));
    $likes = $likes->rowCount();

    $dislikes = $db->prepare('SELECT id FROM dislikes WHERE id_article = ?');
    $dislikes->execute(array($partenaire_id));
    $dislikes = $dislikes->rowCount();

    /**
     * 6 On affiche
     */
    $pageTitle = "Article";
    ob_start();
    require('templates/articles/show.html.php');
    $pageContent = ob_get_clean();

    require('templates/layout.html.php');
