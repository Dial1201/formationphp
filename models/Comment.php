<?php

require_once('models/Model.php');

class Comment extends Model {

    protected $table = "comments";

    /**
     * Retourne la listes des commentaires d'un article
     */
    public function findAllByArticle(int $article_id):array {
        
        $query = $this->db->prepare('SELECT * FROM comments WHERE partenaire = :article_id ORDER BY join_date DESC');
        $query->execute(['article_id' => $article_id]);
        $commentaires = $query->fetchAll();

        return $commentaires;
        
    }

    /**
     * Insertion d'un commentaire d'un article
     */
    public function insert(string $username, string $commentaire, string $article_id):void  {
        
        $query = $this->db->prepare('INSERT INTO comments(id_user, texte, date_creation,partenaire)
                                VALUE(:username, :commentaire,NOW(),:article_id)');
        
        $query->execute(array(
        'username' => $username,
        'commentaire' => $commentaire,
        'article_id' => $article_id
        ));
    
    }
}