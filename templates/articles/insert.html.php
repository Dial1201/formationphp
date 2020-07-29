<!-- HEADER -->

<?php include_once"libraries/header.php"; ?>
 
<div class="container-fluid">
    <div class="container">
        <h2 class="text-center" id="title">Ajouter un commentaire</h2><img src="image/logo.png" alt="Groupement Banque Assurance Français" weight="60" height="60">
		<br>
		<div class="row">
            <div class="col-md-6">
 				<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" >
					<div class="form-group">
						<input type="text" name="nom" id="nom" class="form-control input-lg" value="<?php echo"$_SESSION[username]";?>" readonly required>
                	</div>
 					<div class="form-group">
 					<input type="text" name="commentaire" id="commentaire" class="form-control input-lg" placeholder="Vous voulez réagir ? N'hésitez pas !" value="<?php echo"$commentaire"; ?>" >
 					
 					</div>

					<?php
					
 					echo'<div class="form-actions">';
 					echo'<button type="submit" value="'.$getId['id'].'" class="btn btn-success"><i class="fas fa-pencil-alt"></i> Ajouter</button>';
 					echo'<a href="article.php?id='.$getId['id'] .'" class="btn btn-primary"><i class="fas fa-arrow-left"></i>Retour</a>';
					echo"</div>";
					?>
				</form>
            </div>
		</div>
	</div>
</div>

<!-- FOOTER -->

<?php include_once"libraries/footer.php";?>