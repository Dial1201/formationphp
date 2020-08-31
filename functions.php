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
	$query = $db->prepare('INSERT INTO comments(id_user, texte, date_creation,partenaire)
							VALUE(:username, :commentaire,NOW(),:article_id)');
	
  	$query->execute(array(
    'username' => $username,
    'commentaire' => $commentaire,
    'article_id' => $article_id
  ));
  $db = DataBase::disconnect();

}

function findUser(int $id) {
	$db = DataBase::connect();
    $req = $db->prepare('SELECT * FROM users WHERE id =?');
    $req->execute(array($id));
	$resultat = $req->fetch();
	$db = DataBase::disconnect();
	return $resultat;
}

function updateUser(string $nom, string $prenom, string $username, $question, string $reponse,int $id): void {
	$db = DataBase::connect();
	$statement = $db->prepare("UPDATE users SET nom = :nom, prenom = :prenom, username = :username, question = :question, reponse = :reponse WHERE id = :id");
            $statement->execute(array(
                'nom' => $nom,
                'prenom' => $prenom,
                'username' => $username,
                'question' => $question,
                'reponse' => $reponse,
                'id' => $id
			));
			$db = DataBase::disconnect();
}

function updateUserPassword(string $nom, string $prenom, string $username, $pass_hache, $question, string $reponse,int $id): void {
	$db = DataBase::connect();
	$statement = $db->prepare("UPDATE users SET nom = :nom, prenom = :prenom, username = :username, password = :password, question = :question, reponse = :reponse WHERE id = :id");
	$statement->execute(array(
		'nom' => $nom,
		'prenom' => $prenom,
		'username' => $username,
		'password' => $pass_hache,
		'question' => $question,
		'reponse' => $reponse,
		'id' => $id
	));
	$db = DataBase::disconnect();
}

function check_username(string $username, array $username_db): bool{
	return $check = $username === $username_db;
	
}

