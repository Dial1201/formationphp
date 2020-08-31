<!DOCTYPE html>
<html lang="fr">

<head>


<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

	<link rel="stylesheet" href="css/test.css">
	<title>GBAF</title>
</head>

<body>
	<div class="container-fluid">
		<div class="container">
		<a class="btn btn-outline-primary" href="authentification/login.php" role="button">Déjà membres</a>

			<h2 class="text-center" id="title">Le Groupement Banque Assurance Français</h2><img src="image/logo.png" alt="Groupement Banque Assurance Français">

			<hr>
			<div class="row">
				<div class="col-md-2">

				</div>
				<div class="col-md-8">
					<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">

						<p class="text-uppercase pull-center">S'INSCRIRE.</p>
						<div class="form-group">
							<input type="text" name="nom" id="nom" class="form-control input-lg" placeholder="Nom" value="<?php echo $nom; ?>">
							<p class="text-danger"><?php echo $nom_error; ?></p>
						</div>
						<div class="form-group">
							<input type="text" name="prenom" id="prenom" class="form-control input-lg" placeholder="prenom" value="<?php echo $prenom; ?>">
							<p class="text-danger"><?php echo $prenom_error; ?></p>
						</div>
						<div class="form-group">
							<input type="text" name="username" id="username" class="form-control input-lg" placeholder="Pseudo" value="<?php echo $username; ?>">
							<p class="text-danger"><?php echo $username_error; ?></p>
							<p class="text-danger"><?php echo $usernameNoValid; ?></p>
						</div>
						<div class="form-group">
							<input type="password" name="password" id="password" class="form-control input-lg" placeholder="Mot de Passe" minlength="8" value="<?php echo $password; ?>">
							<p class="text-danger"><?php echo $reponse_error; ?></p>
							<p class="text-danger"><?php echo $passwordNoSame; ?></p>
						</div>
						<div class="form-group">
							<input type="password" name="passwordValid" id="passwordValid" class="form-control input-lg" placeholder="Comfirmer Mot de Passe" minlength="8" value="<?php echo $passwordValid; ?>">
							<p class="text-danger"><?php echo $reponse_error; ?></p>
							<p class="text-danger"><?php echo $passwordNoSame; ?></p>
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
							<input type="text" name="reponse" id="reponse" class="form-control input-lg" placeholder="Tapez votre réponse secrète" size="30" value="<?php echo $reponse; ?>">
							<p class="text-danger"><?php echo $reponse_error; ?></p>
						</div>

						<div>
							<input type="submit" class="btn btn-outline-primary" value="Valider">
						</div>
						<strong>
							<p class="text-success" style="display:<?php if ($_SERVER["REQUEST_METHOD"] == "POST" && $isSuccess == true) echo 'block';
																	else echo 'none'; ?>;">Votre compte à bien été validé</p>
						</strong>

					</form>

				</div>

				<div class="col-md-2">

				</div>

			</div>
		</div>

	</div>
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
</body>

</html>