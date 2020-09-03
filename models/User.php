<?php

require_once('models/Model.php');

class User extends Model {

    protected $table = "users";

    function findUser(int $id) {
        
        $req = $this->db->prepare('SELECT * FROM users WHERE id =?');
        $req->execute(array($id));
        $resultat = $req->fetch();
        
        return $resultat;
    }
    
    function updateUser(string $nom, string $prenom, string $username, $question, string $reponse,int $id): void {
        
        $statement = $this->db->prepare("UPDATE users SET nom = :nom, prenom = :prenom, username = :username, question = :question, reponse = :reponse WHERE id = :id");
                $statement->execute(array(
                    'nom' => $nom,
                    'prenom' => $prenom,
                    'username' => $username,
                    'question' => $question,
                    'reponse' => $reponse,
                    'id' => $id
                ));
                
    }
    
    function updateUserPassword(string $nom, string $prenom, string $username, $pass_hache, $question, string $reponse,int $id): void {
        
        $statement = $this->db->prepare("UPDATE users SET nom = :nom, prenom = :prenom, username = :username, password = :password, question = :question, reponse = :reponse WHERE id = :id");
        $statement->execute(array(
            'nom' => $nom,
            'prenom' => $prenom,
            'username' => $username,
            'password' => $pass_hache,
            'question' => $question,
            'reponse' => $reponse,
            'id' => $id
        ));
        
    }
}