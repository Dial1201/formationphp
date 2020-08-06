<?php
require_once('Database.php');

$isSuccess = null;

/**
 * CE FICHIER DOIT ENREGISTRER UN NOUVEAU COMMENTAIRE EST REDIRIGER SUR L'ARTICLE !
 * 
*/
/**
  *  On doit d'abord récupérer le paramètre "id" qui sera présent en GET et vérifier son existence avec isset
  *  Si on n'a pas de param "id", on affiche un message erreur
  *  SINON, on va se connecter à la base de données,
  *  On met le résultat dans $article_id
  */

  $article_id = null;

  // On vérifie Si l'article existe avec la variable $_GET['id'] exsite avec isset
  // SI elle n'est pas vide avec !empty et que c'est un nombre entier avec ctype_digit
  // Si tout est ok ont met ca dans la variable $comment_id
  if(isset($_GET['id']) && !empty($_GET['id']) && ctype_digit($_GET['id'])) {
  $article_id = (int) $_GET['id'] ;
  }
  //Si il manque le paramètre "id" on le précise
  if(!$article_id) {
    die("Ont doit préciser un paramètre dans l'URL");
}

// On se connecte à la base de données
$db = Database::connect();

//  On récupère un partenaire
  $query = $db-> prepare("SELECT id FROM partenaire WHERE id = :article_id");
  $query->execute(['article_id' =>$article_id]);
  // On met le résultat dans$article_id
 $article_id = $query->fetch();

/**
 * 1. On vérifie que les données ont bien été envoyées en POST
 */

$username = $commentaire = null;

if($_SERVER["REQUEST_METHOD"] == "POST") {

  //fonction pour la securite (trim, stripcslashes, htmlspecialchars)
  $username = verifyinput($_POST['nom']);
  $commentaire = verifyinput($_POST["commentaire"]);
  // Vérifie que la chaine $_POST est un entier
  $article_id = ctype_digit($_POST['prodId']);

  /**
   * 2. Vérification que l'id de l'article pointe bien vers un article qui existe
   */
  $db = Database::connect();

  if ($query->rowCount() === 1) {
    $query = $db->prepare('SELECT * FROM partenaire WHERE id = :article_id');
    $query->execute(['article_id' => $article_id]);
  }
  else {
    // Sinon on crée une erreur
    die("Ho ! L'article $article_id n'existe pas !");
  }

  // 3. Insertion du commentaire
  $query = $db->prepare('INSERT INTO comments SET user_id = :username, texte = :commentaire, date_creation = NOW(), partenaire = :article_id');
  $query->execute(array(
    'username' => $username,
    'commentaire' => $commentaire,
    'article_id' => $article_id
  ));

  // 4. Redirection
  header('Location: article.php?id='. $article_id);
  
 
}

/**
 * 5. On affiche
 **/

ob_start();
require('templates/articles/insert.html.php');
$pageContent = ob_get_clean();

require('templates/layout.html.php');


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Font stylesheet -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/test.css">

    <title>GBAF <?= $pageTitle ?></title>
</head>
<body>
    <div class="container site">

    <!-- HEADER -->

<?php include_once"libraries/header.php"; ?>
 
 <div class="container-fluid">
     <div class="container">
         <h2 class="text-center" id="title">Ajouter un commentaire</h2><img src="image/logo.png" alt="Groupement Banque Assurance Français" weight="60" height="60">
     <br>
     <div class="row">
             <div class="col-md-6">
            <form role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" >
           <div class="form-group">
             <input type="text" name="nom" id="nom" class="form-control input-lg" value="<?php echo"$_SESSION[username]";?>" readonly required>
              </div>
            <div class="form-group">
            <input type="text" name="commentaire" id="commentaire" class="form-control input-lg" placeholder="Vous voulez réagir ? N'hésitez pas !"  >
            </div>
 
            <div class="form-actions">
           <button type="submit" value="<?= $article_id  ?>" class="btn btn-success"><i class="fas fa-pencil-alt"></i> Ajouter</button>
           <input id='prodId' name='prodId' type='hidden' value="<?= $article_id ?>">
            <a href="article.php?id=<?= $article_id ?>" class="btn btn-primary"><i class="fas fa-arrow-left"></i>Retour</a>
           </div>
           
         </form>
             </div>
     </div>
   </div>
 </div>
 
 <!-- FOOTER -->
 
 <?php include_once"libraries/footer.php";?>



    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>   
</body>
</html>
