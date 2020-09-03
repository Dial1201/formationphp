<?php
function verifyinput ($var) { // fonction pour la securite
		
        $var = trim($var); // trim — Supprime les espaces (ou d'autres caractères) en début et fin de chaîne
        $var = stripcslashes($var); // supprime tous les antislashs
		$var = htmlspecialchars($var); // Convertit les caractères spéciaux en entités HTML
		$str = preg_replace('/s/', '', $var);
        return $var;
    }

function redirection (string $url): void{
    header("Location: $url");
    exit(); 
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



function check_username(string $username, array $username_db): bool{
	return $check = $username === $username_db;
	
}

