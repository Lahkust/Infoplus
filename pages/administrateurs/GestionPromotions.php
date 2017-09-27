<!-- /**************************************************************************************************/
/* Fichier ...................... : GestionPromotions.php */
/* Type ......................... : Document PHP */
/* Titre ........................ : Gestion Promotions*/
/* Auteur ....................... : Guillaume Bergs */
/* Date de création ............. : 2017-08-27 */
/* Date de mise en ligne ........ : 2017-08-27 */
/* Date de mise à jour .......... : 2017-09-27 */
/*******************************************************************************************************************/
/* Permet de lister toutes les promotions, en créer de nuvelles, modifier les existantes et les appliquer en masse */
/*******************************************************************************************************************/
-->

<!doctype HTML>
<html lang="fr">
<?php	 session_start(); ?>
	
	<head>
		<meta charset="utf-8">
		<title>Connexion</title>
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
	try {
		$dbh = new PDO('mysql:host=localhost;dbname=infoplus', 'root', '');
		
			//Code pour le bouton d'ajout
			include_once '../../objects/Promotion.php';
			if (isset($_SESSION['administrateur'])) {
				if($_SESSION['administrateur'] == 1) {
					?>
					
					<div class='row'>
						<div class='col-9'></div>
						<div class='col-3 service_add'>
							<a href='#' onclick="addPromo()">
								Ajouter une promotion
							</a>
						</div>
					</div>
					
					<?php
				}
			}
			//Fin code pour le bouton d'ajout
		
		foreach($dbh->query('SELECT * from promotion') as $row) {
		?>
		
		
			<div class="row service_entry">
				<div class="col-md-6">
					<!-- Nom rabais -->
					<?php echo $row["promotion_titre"] ?>
				</div>
				<div class="col-md-5">
					<!-- Pourcentage rabais -->
					<?php echo $row["rabais"]*100 ?> %
				</div>
				<div class="col-md-1">
					<div class="btn-group">
						<button data-toggle="dropdown" class="btn btn-default dropdown-toggle">
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu">
							<li>
								<a href="#">Appliquer à tous les services</a>
							</li>
							<li>
								<a href="#">Modifier</a>
							</li>
							<li>
								<a href="#">Supprimer</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		
					<!-- promos -->
					<div class='row'>
					</div>
					<div class='col-1'></div>
				</div>
				<div class='row'>
					<div class='col-12'></div>
				</div>
			</div>		
			<?php
		}
		$dbh = null;
	} catch (PDOException $e) {
		print "Error!: " . $e->getMessage() . "<br/>";
		die();
	}
?>
	
	</body>
	
	<footer>
	</footer>
	
</html>