 
<!-- HEADER -->

<?php include_once"libraries/header.php"; ?>

<!-- PARTENAIRE -->

<section class="acteurs">
    <div class="row">
        <div class="col"></div>

        <div class="col-6">
            <?php echo'<img src="image/'. $partenaire['logo'] .'" class="img-fluid" alt="Responsive image">'; ?>
        </div>

        <div class="col"></div>

    </div>

    <div class="row">
        <?php echo'<h2>'. $partenaire['titre'] .'</h2>'; ?>
        <?php echo'<p>'.$partenaire['texte'] .' </p>'; ?>
    </div>
</section>

<!-- COMMENTAIRE -->
<section class="commentaire">
    <div class="row">
        <div class="col-md-6">
            <h2><?= count($commentaires) ?> Commentaires</h2>
        </div>
<?php
        
        echo'<div class="col-md-6">';
            echo '<a href="save-comment.php?id=' .$partenaire['id'] .'"><button type="button" class="btn btn-outline-dark button2">Nouveau commentaire</button></a>';
            echo'<a href="action.php?type=1&id=' .$partenaire['id'] .'"><button type="button" class="btn btn-outline-dark button2">'.$likes." ".'<i class="fas fa-thumbs-up"></i></button></a>';
            echo'<a href="action.php?type=2&id=' .$partenaire['id'] .'"><button type="button" class="btn btn-outline-dark button2">'.$dislikes." ".'<i class="fas fa-thumbs-down"></i></button></a>';
        echo'</div>';
    echo'</div>';

    foreach ($commentaires as $commentaire) {
        echo '<div class="row detail">';
            echo'<div class="col">';
                echo '<div class="col author">'. $commentaire['id_user'] . '</div>';
            echo '</div>';
        echo'</div>';

        echo '<div class="row detail">';
            echo'<div class="col">';
                echo'<div class="col date">'. $commentaire['date_creation'] . '</div>';
            echo '</div>';
        echo'</div>';

        echo '<div class="row detail">';
            echo'<div class="col">';
                echo'<div class="col date">'. $commentaire['texte'] . '</div>';
            echo '</div>';
        echo'</div>';
    }

    ?>

</section>

<!-- FOOTER -->

<?php include_once"libraries/footer.php"; ?>



        