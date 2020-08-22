 <!-- HEADER -->

 <?php include_once "libraries/header.php"; ?>

 <!-- article -->

 <section class="acteurs">
     <div class="row">
         <div class="col"></div>

         <div class="col-6">
             <?php echo '<img src="image/' . $article['logo'] . '" class="img-fluid" alt="Responsive image">'; ?>
         </div>

         <div class="col"></div>

     </div>

     <div class="row">
         <?php echo '<h2>' . $article['titre'] . '</h2>'; ?>
         <?php echo '<p>' . $article['texte'] . ' </p>'; ?>
     </div>
 </section>

 <!-- COMMENTAIRE -->
 <section class="commentaire">
     <div class="row">
         <div class="col-md-6">
             <h2><?= count($commentaires) ?> Commentaires</h2>
         </div>
         <?php

            echo '<div class="col-md-6 mt-2">';
            echo '<a href="save-comment.php?id=' . $article['id'] . '"><button type="button" class="btn btn-outline-dark button2">Nouveau commentaire</button></a>';
            echo '<a href="action.php?type=1&id=' . $article['id'] . '"><button type="button" class="btn btn-outline-dark button2">' . $likes . " " . '<i class="fas fa-thumbs-up"></i></button></a>';
            echo '<a href="action.php?type=2&id=' . $article['id'] . '"><button type="button" class="btn btn-outline-dark button2">' . $dislikes . " " . '<i class="fas fa-thumbs-down"></i></button></a>';
            echo '</div>';
            echo '</div>';

            foreach ($commentaires as $commentaire) {

            ?>

             <br>
             <div class="card" style="width: 18rem;">
                 <div class="row">
                     <div class="card-body">
                         <h5 class="card-title"><?= $commentaire['id_user']; ?></h5>
                         <h6 class="card-subtitle mb-2 text-muted"><?= $commentaire['date_creation'] ?></h6>
                         <p class="card-text"><?= $commentaire['texte'] ?></p>
                     </div>
                 </div>
             </div>

             <br>

         <?php
            }

            ?>


         <!-- FOOTER -->

         <?php include_once "libraries/footer.php"; ?>