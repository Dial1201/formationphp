<?php
require_once('Database.php');

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

/**
 * 1. On vérifie que les données ont bien été envoyées en POST
 */

$username = null;
$commentaire = null;

$isSuccess = null;

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

  $query = $db->prepare('SELECT * FROM partenaire WHERE id = :article_id');
  $query->execute(['article_id' => $article_id]);

  
// Si rien n'est revenu, on fait une erreur
  if ($query->rowCount() === 0) {
    die("Ho ! L'article $article_id n'existe pas !");
  }
  
  // 3. Insertion du commentaire
  $query = $db->prepare('INSERT INTO comments SET id_user = :username, texte = :commentaire, date_creation = NOW(), partenaire = :article_id');
  $query->execute(array(
    'username' => $username,
    'commentaire' => $commentaire,
    'article_id' => $article_id
  ));

  // 4. Redirection
  header('Location: article.php?id='. $article_id);
  
 
}
function verifyinput ($var) { // fonction pour la securite
		
  $var = trim($var); // trim — Supprime les espaces (ou d'autres caractères) en début et fin de chaîne
  $var = stripcslashes($var); // supprime tous les antislashs
  $var = htmlspecialchars($var); // Convertit les caractères spéciaux en entités HTML
  return $var;
}
?>

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
           <button type="submit" value="<?= $article_id ?>" class="btn btn-success"><i class="fas fa-pencil-alt"></i> Ajouter</button>
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
