<!-- HEADER -->

<?php include_once"libraries/header.php"; ?>


<!-- PRESENTATION -->

<?php include_once"libraries/presentation.php"; ?>


<!-- PARTENAIRE -->

<?php
echo'<section class="acteurs">';
    echo'<h2 class="text-center">Partenaires</h2>';
        echo'<p class="text-center"> Laisser un commentaire sur les partenaires sur les produits et services bancaires et financiers.</p>';
        echo'<div class="row"> ';
        foreach ($articles as $article) {
            echo'<div class="col-md-4 logo_acteurs">';
                echo'<img src="image/'. $article['logo'] .'" class="img-thumbnail" alt="logo formation_co">';
            echo'</div>';
            echo'<div class="col-md-8 pb-5 textuel">';
                echo'<h3>'. $article['titre'] .'</h3>';
                echo'<p>'.$article['extrait'] .' </p>';
                echo'<a href="article.php?id=' . $article['id'] . '" class="button1 btn btn-outline-danger">lire la suite</a>';
            echo' </div>';
            
        }
        echo'<br>';
            
        echo' </div>';
echo'</section>';
?>
<br>

<!-- FOOTER -->

<?php include_once"libraries/footer.php"; ?>

   
    

