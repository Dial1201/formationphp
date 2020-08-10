<!-- HEADER -->

<?php include_once"libraries/header.php"; ?>
 
<div class="container-fluid">
    <div class="container">
        <h2 class="text-center" id="title">Ajouter un commentaire</h2><img src="image/logo.png" alt="Groupement Banque Assurance Français" weight="60" height="60">
		<br>
		<div class="row">
            <div class="col-md-6">
 				<form role="form" action="" method="POST" >
					<div class="form-group">
						<input type="text" name="nom" id="nom" class="form-control input-lg" value="<?php echo"$_SESSION[username]";?>" readonly required>
                	</div>
 					<div class="form-group">
 					<input type="text" name="commentaire" id="commentaire" class="form-control input-lg" placeholder="Vous voulez réagir ? N'hésitez pas !"  >
 					</div>
					 <div class="form-group">
 					<input type="hidden" name="partenaire" id="partenaire" value="<?= $_GET['id'] ?>">
 					</div>
 					<div class="form-actions">
					<button type="submit" class="btn btn-success"><i class="fas fa-pencil-alt"></i> Ajouter</button>
					<!-- <input id='prodId' name='prodId' type='hidden' value="<?= $article_id ?>"> -->
 					<a href="article.php?id=<?= $article_id ?>" class="btn btn-primary"><i class="fas fa-arrow-left"></i>Retour</a>
					</div>
					
				</form>
            </div>
		</div>
	</div>
</div>

<!-- FOOTER -->

<?php include_once"libraries/footer.php";?>