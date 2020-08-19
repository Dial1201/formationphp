<?php

/**
 * CE FICHIER A POUR BUT D'AFFICHER LA PAGE D'ACCUEIL !
 * 
 */
require_once('Database.php');
require_once("functions.php");

/**
 * 1. Récupération des articles 
 */
$articles = findAllArticles();
/**
 * 2. Affichage
 */
$pageTitle = "Accueil";
ob_start();
require('templates/articles/accueil.html.php');
$pageContent = ob_get_clean();

require('templates/layout.html.php');



