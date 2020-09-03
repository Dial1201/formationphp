<?php
require_once('Database.php');
require_once("functions.php");
require_once('models/Article.php');
require_once('models/Comment.php');

$articlemodel = new Article();
$commentmodel = new Comment();
/**
 * CE FICHIER DOIT AFFICHER UN PARTENAIRE ET SES COMMENTAIRES
 * 
 */

/**
 * 1 Récupération du paramètre "id" et vérification
 */

$article_id = null;

// On vérifie Si la variable $_GET['id'] n'est pas vide et que c'est un nombre entier 
if (isset($_GET['id']) && !empty($_GET['id']) && ctype_digit($_GET['id'])) {
  $article_id = $_GET['id'];
}
// Si il manque le paramètre "id" on le précise
if (!$article_id) {
  die("Ont doit préciser un paramètre dans l'URL");
}

/**
 * 1 On récupère un partenaire
 */

$article = $articlemodel->find($article_id);

/**
 * 2 On récupère tous les commentaires de un partenaire
 */

$commentaires = $commentmodel->findAllByArticle($article_id);


/**
 * 3 on calcul le nombre de likes et dislikes
 */

$likes = resultVotesLikes($article_id);

$dislikes = resultVotesDisLikes($article_id);

/**
 * 4 On affiche
 */
$pageTitle = "Article";
ob_start();
require('templates/articles/show.html.php');
$pageContent = ob_get_clean();

require('templates/layout.html.php');
