<?php
function verifyinput ($var) { // fonction pour la securite
		
        $var = trim($var); // trim — Supprime les espaces (ou d'autres caractères) en début et fin de chaîne
        $var = stripcslashes($var); // supprime tous les antislashs
        $var = htmlspecialchars($var); // Convertit les caractères spéciaux en entités HTML
        return $var;
    }

function redirection (string $url): void{
    header("Location: $url");
    exit(); 
}

/**
 * Retourne la liste des articles classées par date de création
 * @return array
 */
function findAllArticles():array {
	$db = Database::connect();
	$resultats = $db->query('SELECT * FROM partenaire ORDER BY join_date DESC');
	$articles = $resultats->fetchAll();

	return $articles;
}

/**
 * Retourne un article par rapport à son id
 */
function findArticle(int $id) {
	$db = Database::connect();
	$query = $db-> prepare("SELECT * FROM partenaire WHERE id = :article_id");
    $query->execute(['article_id' => $id]);
    $article = $query->fetch();

   return $article;
}

/**
 * Retourne la listes des commentaires d'un article
 */
function findAllComments(int $article_id):array {
	$db = Database::connect();
	$query = $db->prepare("SELECT * FROM comments WHERE partenaire = :article_id ORDER BY date_creation DESC");
    $query->execute(['article_id' => $article_id]);
	$commentaires = $query->fetchAll();

	return $commentaires;
}

/**
 * Retourne le nombre de likes
 */
function resultVotesLikes(int $article_id) {
	$db = Database::connect();
	$likes = $db->prepare('SELECT id FROM likes WHERE id_article = ?');
    $likes->execute(array($article_id));
	$likes = $likes->rowCount();
	
	return $likes;
}

/**
 * Retourne le nombre de dislikes
 */
function resultVotesDisLikes(int $article_id) {
	$db = Database::connect();
	$dislikes = $db->prepare('SELECT id FROM dislikes WHERE id_article = ?');
    $dislikes->execute(array($article_id));
	$dislikes = $dislikes->rowCount();
	
	return $dislikes;
}

/**
 * Insertion d'un commentaire d'un article
 */
function insertComment(string $username, string $commentaire, string $article_id):void  {
	$db = Database::connect();
	$query = $db->prepare('INSERT INTO comments SET id_user = :username, texte = :commentaire, date_creation = NOW(), partenaire = :article_id');
  	$query->execute(array(
    'username' => $username,
    'commentaire' => $commentaire,
    'article_id' => $article_id
  ));

}

function check_user_connect() {
	if (!isset($_SESSION['username'])) {
		header('Location: index.php');
		exit();
	}
}

function verify_username($username): int {
	$db = Database::connect();
	$check = $db->prepare('SELECT username FROM users WHERE = username = :username');
	$check->execute(array(
		'username' => $username
	));
	$verified = $check->rowCount();

	return $verified;
}

