<!-- /**************************************************************************************************/
/* Fichier ...................... : index.php */
/* Type ......................... : Document PHP */
/* Titre ........................ : index*/
/* Auteur ....................... : Guillaume Bergs */
/* Date de création ............. : 2017-08-23 */
/* Date de mise en ligne ........ : 2017-08-23 */
/* Date de mise à jour .......... : 2017-09-06 */
/*******************************************************************************************************/
/* index */
/*******************************************************************************************************/
-->

<!doctype HTML>
<html lang="fr">
	<?php	 session_start(); ?>
	
	<head>
		<meta charset="utf-8">
		<title>Connexion</title>
		
		<link rel="stylesheet" href="styles/style.css">
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
	</head>
	
	<header>
		<?php include_once 'pages/Entete.php' ?>
	</header>
	
	<body>
		<main>
			<form method="post"  action = "" enctype="multipart/form-data">
				<!-- Intitulé -->
				<div class="row">
					<div class="col-3"></div>
					<div class="col-6">
						Veuillez-vous identifier pour avoir la possibilité d'acheter des formations.
					</div>
					<div class="col-3"></div>
				</div>
				
				<!-- Courriel -->
				<div class="row">
					<div class="col-4"></div>
					<input type = "text" name = "mail" class = "box col-4" required/>
					<div class="col-4"></div>
				</div>
				
				<!-- Mot de passe -->
				<div class="row">
					<div class="col-4"></div>
					<input type = "password" name = "password" class = "box col-4" required/>
					<div class="col-4"></div>
				</div>
				
				<!-- Mot de passe oublié -->
				<div class="row">
					<div class="col-4"></div>
					<div class="col-4">
						<a href="http://www.perdu.com">Mot de passe oublié<a>
					</div>
					<div class="col-4"></div>
				</div>
				
				<!-- Connexion -->
				<div class="row">
					<div class="col-2"></div>
					<div class="col-4">
						<input type="image" src="images/icones/boutonConnexion.png" class="imgButton" alt="Connexion" />
					</div>
					<!-- S'inscrire -->
					<div class="col-4">
						<a href="pages/clients/Inscription.php">
							<img src="images/icones/boutonInscription.png" class="imgButton" alt="Inscription"/>
						</a>
					</div>
					<div class="col-2"></div>
				</div>
				
				<!-- Connexion avec Facebook -->
				<div class="row">
					<div class="col-4"></div>
					<div class="col-4">
						<a href="http://www.perdu.com">
							<img src="images/icones/facebook.png" class="imgButton"/>
						</a>
					</div>
					<div class="col-4"></div>
				</div>
			</form>
		</main>
	</body>
	
	<footer>
	</footer>
	
</html>