<!-- HEADER -->

<?php include_once"libraries/header.php"; ?>
 
<div class="container-fluid">
		<div class="container">
			<h2 class="text-center" id="title">Le Groupement Banque Assurance Français</h2><img src="image/logo.png" alt="Groupement Banque Assurance Français" weight="60" height="60">
 			    <br>
			<div class="row">
				<div class="col-md">
 					<form role="form" method="post" action="">
						<fieldset>							
                            <p class="text-uppercase pull-center">Modifier vos informations</p>
                            <div class="form-group">
								<input type="text" name="nom" id="nom" class="form-control input-lg" value="<?= $resultat['nom']; ?>" placeholder="Tapez votre nom" required>
                            </div>
                            <div class="form-group">
								<input type="text" name="prenom" id="prenom" class="form-control input-lg" value="<?= $resultat['prenom']; ?>" placeholder="Tapez votre prenom" required>
							</div>	
 							<div class="form-group">
								<input type="text" name="username" id="username" class="form-control input-lg" value="<?=$resultat['username'] ?>" placeholder="Tapez votre username" required>
							</div>
							<div class="form-group">
                                <input type="password" name="currentpassword" id="password" class="form-control input-lg"  placeholder="Mot de passe actuelle" minlength="8" required>
                            </div>
                            <div class="form-group">
                                <input type="password" name="newpassword" id="password" class="form-control input-lg"  placeholder="Nouveau mot de passe" minlength="8" >
                            </div>
                            <div class="form-group">
                                <input type="password" name="comfirmNew_password" id="password" class="form-control input-lg"  placeholder="Comfirmer votre nouveau mot de passe" minlength="8" >
							</div>
                            <div class="form-group">
			
								<label for="question">Modifier votre question ?</label><br />
									<select class="form-control" name="question" id="question" value="<?=$resultat['question'] ?>" required>
                            
										<option value="couleur">Quelle est votre couleur préférée ?</option>
										<option value="ville">Quelle est votre ville favorite ?</option>
										<option value="ecole">Quelle était le nom de votre école primaire ?</option>

									</select>
							</div>

                            <div class="form-group">
								<input type="text" name="reponse" id="reponse" class="form-control input-lg" value="<?=$resultat['reponse'] ?>" placeholder="Tapez votre réponse" size="30" required>
							</div>
							
 							<div>
 								<input type="submit" class="btn btn-lg btn-primary"   value="Valider">
 							</div>
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	</div>

<!-- FOOTER -->

<?php include_once"libraries/footer.php";?>