<?php

/**
 * CE FICHIER A POUR BUT D'AFFICHER LA PAGE D'ACCUEIL !
 * 
 */
require_once('Database.php');
require_once("functions.php");
require_once('models/Article.php');

$model = new Article();
/**
 * 1. Récupération des articles 
 */
$articles = $model->findAll("join_date DESC");
/**
 * 2. Affichage
 */
$pageTitle = "Accueil";
ob_start();
require('templates/articles/accueil.html.php');
$pageContent = ob_get_clean();

require('templates/layout.html.php');
