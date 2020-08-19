<!DOCTYPE html>
<html lang="fr">

<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<link rel="stylesheet" href="css/test.css">
</head>

<title>GBAF</title>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


<body>
	<div class="container-fluid">
		<div class="container">

			<form class="form-inline" role="form" method="POST" action="authentification/login.php">

				<p class="text-uppercase mr-2">CONNECTEZ-VOUS:</p>

				<div class="form-group mb-2">
					<input type="text" name="usernameCo" id="usernameCo" class="form-control input-lg" placeholder="Pseudo">
				</div>

				<div class="form-group mx-sm-3 mb-2">
					<input type="password" name="passwordCo" id="passwordCo" class="form-control input-lg" placeholder="password">
				</div>

				<button type="submit" class="btn btn-outline-primary mb-2">Se Connecter</button>
				
			</form>

			<div class="d-flex justify-content-end">
				<a class="btn btn-outline-danger" href="authentification/forget.php" role="button">Mot de passe oublié</a>
			</div>

			<h2 class="text-center" id="title">Le Groupement Banque Assurance Français</h2><img src="image/logo.png" alt="Groupement Banque Assurance Français" weight="60" height="60">

			<hr>
			<div class="row">
				<div class="col-md-2">

				</div>
				<div class="col-md-8">
				<form role="form" method="post" action="authentification/sign.php">
						<fieldset>
							<p class="text-uppercase pull-center">S'INSCRIRE.</p>
							<div class="form-group">
								<input type="text" name="nom" id="nom" class="form-control input-lg" placeholder="Nom" required>
							</div>
							<div class="form-group">
								<input type="text" name="prenom" id="prenom" class="form-control input-lg" placeholder="prenom" required>
							</div>
							<div class="form-group">
								<input type="text" name="username" id="username" class="form-control input-lg" placeholder="Pseudo" required>
							</div>
							<div class="form-group">
								<input type="password" name="password" id="password" class="form-control input-lg" placeholder="Mot de Passe" minlength="8" required>
							</div>
							<div class="form-group">

								<label for="question">Choississez votre question ?</label><br />
								<select class="form-control" name="question" id="question">
									<option value="couleur">Quelle est votre couleur préférée ?</option>
									<option value="ville">Quelle est votre ville favorite ?</option>
									<option value="ecole">Quelle était le nom de votre école primaire ?</option>

								</select>
							</div>

							<div class="form-group">
								<input type="text" name="reponse" id="reponse" class="form-control input-lg" placeholder="Tapez votre réponse secrète" size="30" required>
							</div>

							<div>
								<input type="submit" class="btn btn-outline-primary" value="Valider">
							</div>
						</fieldset>
						<strong><p style="display:<?php if($isSuccess) echo'block'; else echo'none';?> ;">Inscription Validé</p></strong>
					</form>
					
				</div>

				<div class="col-md-2">
					
				</div>

			</div>
		</div>

	</div>
</body>


</html>