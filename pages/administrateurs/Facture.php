<!-- /**************************************************************************************************/
/* Fichier ...................... : Facture.php */
/* Type ......................... : Document PHP */
/* Titre ........................ : Facture*/
/* Auteur ....................... : Christopher Brown */
/* Date de création ............. : 2017-09-11 */
/* Date de mise en ligne ........ : 2017-09-11 */
/* Date de mise à jour .......... : 2017-09-18 */
/*******************************************************************************************************/
/* Facture des clients avec leurs informations */
/*******************************************************************************************************/
-->

<!doctype html>
<html lang="fr">
	<?php 
		session_start();
	?>
	
	<head>
		<meta charset="utf-8">
		<title>Facture</title>
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
		
		<!--Verifie s'il y a un utilisateur de connecte-->
		<?php try {
			
			$dbh = new PDO('mysql:host=localhost;dbname=infoplus', 'root', '');
			$dbh->exec("set names utf8");
			foreach($dbh->query('select * from client a join facture b on a.pk_client=b.fk_client join ta_facture_service c on b.pk_facture=c.fk_facture 
					join service d on c.fk_service=d.pk_service ORDER BY b.date_service DESC') as $row) {
						
				print_r(" " . $row["prenom"] . " " . $row["nom"]);
				?>
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-1">
								</div>
								<div class="col-md-10">
									<div class="row">
										<div class="col-md-2">
											345
										</div>
										<div class="col-md-5">
										richard lard
										</div>
										<div class="col-md-3">
										21/03/2016
										</div>
										<div class="col-md-2">
										</div>
									</div>
									<div class="row">
										<div class="col-md-2">
										</div>
										<div class="col-md-5">
										no facture
										</div>
										<div class="col-md-3">
										180.00$
										</div>
										<div class="col-md-2">
											<div class="panel-group" id="panel-2644">
												<div class="panel panel-default">
													<div class="panel-heading">
														 <a class="panel-title collapsed" data-toggle="collapse" data-parent="#panel-2644" href="#panel-element-590125">Détail</a>
													</div>
												</div>
											</div>
										</div>
									</div>
									<!-- requete sql pour avoir le nombre de rows -->
									<div class="row">
										<div id="panel-element-590125" class="panel-collapse collapse">
											<div class="panel-body">
												<div class="col-md-3">
													</div>
													<div class="col-md-4">
														Excel débutant
													</div>
													<div class="col-md-3">
														120.00$
													</div>
													<div class="col-md-2">
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-1">
								</div>
							</div>
						</div>
					</div>
				</div><?php
			}
			$dbh = null;
		} catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
			die();
		}
		?>
		
	
		<footer>
		</footer>
	</body>
</html>