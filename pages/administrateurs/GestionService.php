<!-- /**************************************************************************************************/
/* Fichier ...................... : GestionService.php */
/* Type ......................... : Document PHP */
/* Titre ........................ : Facture*/
/* Auteur ....................... : Christopher Brown */
/* Date de création ............. : 2017-10-01 */
/* Date de mise en ligne ........ : 2017-10-01 */
/* Date de mise à jour .......... : 2017-10-01*/
/*******************************************************************************************************/
/* Permet de créer, désactiver ou modifer un service */
/*******************************************************************************************************/
-->

<!doctype html>
<html lang="fr">
	<?php 
		session_start();
		require_once '../../Objects/Connection.php';
	?>
	
	<head>
		<meta charset="utf-8">
		<title>GestionService</title>
		<link rel="stylesheet" href="../../styles/style.css">
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
	
	</head>
	<body>
		<header>
			<?php include_once '../Entete.php' ?>
		</header>
		
		<div class="container-fluid borderFacture">
			<div class="row">
				<div class="col-md-12">
					<div class="textNoir">Vous pouvez modifier les informations du service</div>
					<div class="textRouge">Tous les champs sont obligatoires</div>
					<div class="row">
						<div class="col-md-4">
						</div>
						<div class="col-md-8">
							<div class="row">
								<div class="col-md-12">
									<input type="text" name="titre" placeholder="Titre" value="" required>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<textarea name="description" placeholder="Description" rows="5" cols="50" required></textarea>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<input type="text" name="duree" placeholder="Durée" value="" required>
								</div>
								<div class="col-md-6">
									<input type="text" name="tarif" placeholder="Tarif" value="" required>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
						</div>
						<div class="col-md-8">
							<div class='textBleu'>
								<input type='checkbox' name='activer' value='0' > Activer le service dans le catalogue
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		
		<footer>
		</footer>
	</body>
</html>