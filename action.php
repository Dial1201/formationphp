<?php
require_once('Database.php');
session_start();

   /**
   * 1 On se connecte à la base de données
   */

  $db = Database::connect();

  /**
   * 2 on vérifie SI get=type and get=id existe et si les variable sont pas vide
   */

if (isset($_GET['type'],$_GET['id']) && !empty($_GET['type']) && !empty($_GET['id'])) {
    $get_id = (int) $_GET['id']; // ON le converti en int pour la securité 
    $get_type = (string) verifyinput($_GET['type']); // fonction securite
    $sessionUserName = $_SESSION['username'];

    // on vérifie SI l'article existe
    $check = $db->prepare('SELECT id FROM partenaire WHERE id = ?');
    $check->execute(array($get_id));

    // Si l'article existe il doit retourner une valeur (1) 
    if($check->rowCount() == 1) { 

        // SI la valeur correspond à likes 
        if ($get_type == 'likes') {
            $check_user = $db->prepare('SELECT id FROM likes WHERE id_article = ? AND id_user = ?');
            $check_user->execute(array($get_id,$sessionUserName));

            // SI il existe un aricle qui à déjà un like de id_user(l'utilisateur fait un 2e like)
            if ($check_user->rowCount() == 1) {
                // on ne prend pas en compte et on efface un like en plus
                $check_del = $db->prepare('DELETE FROM likes WHERE id_article = ? AND id_user = ?');
                $check_del->execute(array($get_id,$sessionUserName));
            } 
            else {
                // on insert le like avec le $sessionUserName
                $ins = $db->prepare('INSERT INTO likes (id_article, id_user) VALUE (?,?)');
                $ins->execute(array($get_id, $sessionUserName));
            }
            

        }
        // SI la valeur correspond à dislikes
        elseif ($get_type == 'dislikes') {
            $check_user = $db->prepare('SELECT id FROM dislikes WHERE id_article = ? AND id_user = ?');
            $check_user->execute(array($get_id,$sessionUserName));


            if ($check_user->rowCount() == 1) {
                $check_del = $db->prepare('DELETE FROM dislikes WHERE id_article = ? AND id_user = ?');
                $check_del->execute(array($get_id,$sessionUserName));
            } 
            else {
                
                $ins = $db->prepare('INSERT INTO dislikes (id_article, id_user) VALUE (?,?)');
                $ins->execute(array($get_id, $sessionUserName));
            }
            
        }
        header('location: article.php?id=' . $get_id);
    }
    else {
        exit('Erreur fatale1');
    }
}
else {
    exit('Erreur fatale2');
}
function verifyinput ($var) { // fonction pour la securite

    $var = trim($var); // trim — Supprime les espaces (ou d'autres caractères) en début et fin de chaîne
    $var = stripcslashes($var); // supprime tous les antislashs
    $var = htmlspecialchars($var); // Convertit les caractères spéciaux en entités HTML
    return $var;
}