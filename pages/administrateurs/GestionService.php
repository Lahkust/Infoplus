<!-- /**************************************************************************************************/
/* Fichier ...................... : GestionService.php */
/* Type ......................... : Document PHP */
/* Titre ........................ : Facture*/
/* Auteur ....................... : Christopher Brown */
/* Date de création ............. : 2017-10-01 */
/* Date de mise en ligne ........ : 2017-10-01 */
/* Date de mise à jour .......... : 2017-10-02*/
/*******************************************************************************************************/
/* Permet de créer, désactiver ou modifer un service */
/*******************************************************************************************************/
-->

<!doctype html>
<html lang="fr">
	<?php 
		session_start();
		require_once '../../Objects/Connection.php';
		$dbh = db_connect();
		
		//Vérifier si le bouton confirmer a été pressé
		if($_SERVER["REQUEST_METHOD"] == "POST") {
			//Vérifier si les données sont valides
			if(true){
				//Si les données sont valides
				
				//Vérifier si on a un id pour le service
				$idServiceInvalide = true;
				if(isset($_GET["idService"])){
					$idService		=	$_GET["idService"];
					//Si on en a un, vérifier s'il est valide
					foreach($dbh->query('SELECT * FROM Service WHERE pk_service=' . $idService) as $row){
						//Si on a un id valide, mettre à jour la table
						$idServiceInvalide = false;
						
						//statement
						$sql = "UPDATE Service SET service_titre= ? , service_description= ? , duree= ? , tarif= ? , actif= ? WHERE pk_service= ? ";
						
						// Preparer le statement
						$stmt = $dbh->prepare($sql);
					
						$titre			=	$_POST['titre'];
						$description	=	$_POST['description'];
						$duree			=	$_POST['duree'];
						$tarif			=	$_POST['tarif'];
						$actif			=	$_POST['activer'];
						// exécuter la requête
						$stmt->execute(array($titre, $description, $duree, $tarif, $actif, $idService));
						
					}
				}		
				// Si on a pas d'id ou un id invalide, ajouter une entrée à la table
				if($idServiceInvalide){
					
					//statement
					$sql = "INSERT INTO Service(service_titre, service_description, duree, tarif, actif) VALUES(?, ?, ?, ?, ?)";
					
					// Preparer le statement
					$stmt = $dbh->prepare($sql);
				
					$titre			=	$_POST['titre'];
					$description	=	$_POST['description'];
					$duree			=	$_POST['duree'];
					$tarif			=	$_POST['tarif'];
					$actif			=	$_POST['activer'];
					// exécuter la requête
					$stmt->execute(array($titre, $description, $duree, $tarif, $actif));
				}
				
				//Fermer l'onglet
				echo "<script>window.close();</script>";
					
			} else {
				//Si les données sont invalides
				
				//Avertissements
			}
		}
		
		$titre			=	'';
		$description	=	'';
		$duree			=	'';
		$tarif			=	'';
		$actif			=	'';
		//Vérifier si on a un id pour le service
		if(isset( $_GET["idService"] )){
			$idService		=	$_GET["idService"];
			//Si on en a un, vérifier s'il est valide
			foreach($dbh->query('SELECT * FROM Service WHERE pk_service=' . $idService) as $row){
				//Si on a un id valide, enregistrer les valeurs dedans
				$titre			=	$row['service_titre'];
				$description	=	$row['service_description'];
				$duree			=	$row['duree'];
				$tarif			=	$row['tarif'];
				$actif			=	$row['actif'];
			}
		}
				
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
			<form method="post"  action = "" enctype="multipart/form-data">
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
										<input type="text" name="titre" placeholder="Titre" value="<?php echo $titre ?>" required>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<textarea name="description" placeholder="Description" rows="5" cols="50" required> <?php echo $description ?> </textarea>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<input type="text" name="duree" placeholder="Durée" value="<?php echo $duree ?>" required>
									</div>
									<div class="col-md-6">
										<input type="text" name="tarif" placeholder="Tarif" value="<?php echo $tarif ?>" required>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
							</div>
							<div class="col-md-8">
								<div class='textBleu'>
									<input type='checkbox' name='activer' value='<?php echo $actif ?>' > Activer le service dans le catalogue
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- Bouton de validation -->
				<button type="submit" class="btn btn-default">Confirmer</button>
			</form>
		</div>
		
		
		<footer>
		</footer>
	</body>
</html>