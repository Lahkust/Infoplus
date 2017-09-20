<!-- /**************************************************************************************************/
/* Fichier ...................... : Promotions.php */
/* Type ......................... : Document PHP */
/* Titre ........................ : Promotions*/
/* Auteur ....................... : Guillaume Bergs */
/* Date de création ............. : 2017-08-17 */
/* Date de mise en ligne ........ : 2017-08-17 */
/* Date de mise à jour .......... : 2017-09-20 */
/*******************************************************************************************************/
/* Permet d'ajouter ou modifier une promotion */
/*******************************************************************************************************/
-->

<!doctype HTML>
	<html lang="fr">
	<?php	 session_start(); ?>

	<head>
		<meta charset="utf-8">
		<title>Erreur 404</title>
		<link rel="stylesheet" href="../../styles/style.css"/>

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
	</head>

	<header>
		<?php include_once '../Entete.php' ?>
	</header>

	<body>
		<?php
			//Commence par vérifier si il a une variable administrateur
			if (isset($_SESSION['administrateur'])) {
			//si c'est un admin
			if ($_SESSION['administrateur'] == 1) {
		?>	

		<div class="container-fluid">
			<div class="form">
				<div class="row">
					<div class="col-md-1">
						<!-- Espace gauche -->
					</div>
					<div class="col-md-10 service_entry">
						<div class="row">
							<div class="col-md-12">
								Ajouter la période et un code pour appliquer la promotion choisie.
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								Le code n'est pas obligatoire et ne sera pas exigé si la promotion est vide.
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<!-- Entrée du pourcentage -->
								<div class="row percent_input">
									<div class="col-md-10">
										10
									</div>
									<div class="col-md-2">
										%
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<!-- Promotions existantes -->
										<div class="btn-group">
											<button class="btn btn-default">
												Promotion
											</button> 
											<button data-toggle="dropdown" class="btn btn-default dropdown-toggle">
												<span class="caret"></span>
											</button>
											<ul class="dropdown-menu">
												<li>
													<a href="#">Promo1</a>
												</li>
												<li>
													<a href="#">Promo2</a>
												</li>
												<li>
													<a href="#">Promo3</a>
												</li>
											</ul>
										</div>
										<!-- Fin promotions existantes -->
									</div>
								</div>
							</div>
							<div class="col-md-8">
								<div class="row">
									<div class="col-md-12">
										Période de la promotion
									</div>
								</div>
								<div class="row">
									<div class="col-md-5">
										<!-- Date de début de la promotion -->
										<input type="date" name="debut">
									</div>
									<div class="col-md-2">
										à
									</div>
									<div class="col-md-5">
										<!-- Date de fin de la promotion -->
										<input type="date" name="fin">
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										Entrer un code s'il est requis pour appliquer la promotion lors de la création de la facture.
									</div>
								</div>
								<div class="row">
									<div class="col-md-8">
										<!-- Code promotionnel -->
										<input type="text" class="form-control" id="promo_code">
									</div>
									<div class="col-md-4">
										<!-- Espace vide~ -->
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<!-- Espace vide -->
							</div>
						</div>
						<div class="row">
							<div class="col-md-8">
								<!-- Espace vide -->
							</div>
							<div class="col-md-4">
								<!-- Bouton de validation -->
								<button type="submit" class="btn btn-default">Confirmer</button>
							</div>
						</div>
					</div>
					<div class="col-md-1">
						<!-- Espace droit -->
					</div>
				</div>
			</div>
		</div>

		<?php
		//si c'est un utilisateur
		} else { ?>



		<?php
		}
		//sinon un visiteur
		} else { ?>

		<?php } ?>

	</body>

	<footer>
	</footer>

</html>