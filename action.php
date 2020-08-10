<?php
require_once('Database.php');
require_once("functions.php");
session_start();

   /**
   * 1 On se connecte à la base de données
   */

  $db = Database::connect();

  /**
   * 2 on vérifie SI get=type and get=id existe et si les variable sont pas vide
   */

if (isset($_GET['type'],$_GET['id'],$_SESSION['id']) && !empty($_GET['type']) && !empty($_GET['id'])) {
    $get_id = (int) $_GET['id']; // ON le converti en int pour la securité 
    $get_type = (int) $_GET['type']; 
    $sessionid = $_SESSION['id'];

    // on vérifie SI l'article existe
    $check = $db->prepare('SELECT id FROM partenaire WHERE id = ?');
    $check->execute(array($get_id));

    //on vérifie que le $_session['id'], existe et qu'elle est activée
    if (session_status() == PHP_SESSION_NONE || PHP_SESSION_DISABLED) { 
        // si la session est activées, mais qu'elle n'existe pas ou la session est désactivée.
        echo" La session id n'est pas présent !";
    }

    // Si l'article existe il doit retourner une valeur  
    if($check->rowCount() == 1) { 
        // SI la valeur correspond à 1 
        if ($get_type == 1) {
            // on vérifie si l'utilisateurà un like 
            $check_like = $db->prepare('SELECT id FROM likes WHERE id_article = ? && id_user = ?');
            $check_like->execute(array($get_id,$sessionid));
            
            $del = $db->prepare('DELETE FROM dislikes WHERE id_article = ? && id_user = ?');
            $del->execute(array($get_id,$sessionid));
            // SI un like existe déjà on efface
            if($check_like->rowCount() == 1) {
                $del = $db->prepare('DELETE FROM likes WHERE id_article = ? && id_user = ?');
                $del->execute(array($get_id,$sessionid));
            }
            // SINON on ajoute le like
            else {
                $ins = $db->prepare('INSERT INTO likes (id_article, id_user) VALUE (?,?)');
                $ins->execute(array($get_id,$sessionid));
            }

        } 
        // SINON SI la valeur correspond à 2
        elseif ($get_type == 2) {
            // on vérifie si l'utilisateurà un like 
            $check_like = $db->prepare('SELECT id FROM dislikes WHERE id_article = ? && id_user = ?');
            $check_like->execute(array($get_id,$sessionid));

            $del = $db->prepare('DELETE FROM likes WHERE id_article = ? && id_user = ?');
            $del->execute(array($get_id,$sessionid));
            // SI un like existe déjà on efface
            if($check_like->rowCount() == 1) {
                $del = $db->prepare('DELETE FROM dislikes WHERE id_article = ? && id_user = ?');
                $del->execute(array($get_id,$sessionid));
            }
            // SINON on ajoute le like
            else {
                $ins = $db->prepare('INSERT INTO dislikes (id_article, id_user) VALUE (?,?)');
                $ins->execute(array($get_id,$sessionid));
            }
        
        }
    // header('Location: article.php?id='.$get_id);  
        redirection("article.php?id=$get_id");
    }
    
}