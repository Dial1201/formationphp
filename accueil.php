<?php
require_once('Database.php');
/**
 * CE FICHIER A POUR BUT D'AFFICHER LA PAGE D'ACCUEIL !
 * 
 * On va donc se connecter à la base de données, récupérer les articles du plus récent au plus ancien (SELECT * FROM articles ORDER BY created_at DESC)
 * puis on va boucler dessus pour afficher chacun d'entre eux
 */

/**
 * 1. Connexion à la base de données 
 * 
 */
 
 $db = Database::connect();

/**
 * 2. Récupération des articles
 */

$resultats = $db->query('SELECT * FROM partenaire ORDER BY join_date DESC');

$articles = $resultats->fetchAll();

/**
 * 3. Affichage
 */
$pageTitle = "Accueil";
ob_start();
require('templates/articles/accueil.html.php');
$pageContent = ob_get_clean();

require('templates/layout.html.php');