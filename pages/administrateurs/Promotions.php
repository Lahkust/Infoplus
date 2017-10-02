<!-- /**************************************************************************************************/
/* Fichier ...................... : Promotions.php */
/* Type ......................... : Document PHP */
/* Titre ........................ : Promotions*/
/* Auteur ....................... : Guillaume Bergs */
/* Date de création ............. : 2017-08-17 */
/* Date de mise en ligne ........ : 2017-08-17 */
/* Date de mise à jour .......... : 2017-10-01 */
/*******************************************************************************************************/
/* Permet d'ajouter ou modifier une promotion */
/*******************************************************************************************************/
-->
<!DOCTYPE HTML>
<html lang="fr">
  <?php    session_start();
		require_once '../../Objects/Connection.php';
$dbh = db_connect();  ?>
  <head>
    <meta name="generator" content="HTML Tidy for HTML5 (experimental) for Windows https://github.com/w3c/tidy-html5/tree/c63cc39" />
    <meta charset="utf-8" />
    <title>Erreur 404</title>
    <link rel="stylesheet" href="../../styles/style.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous" />
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
  </head>
  <body>
    <header>
      <?php include_once '../Entete.php'?>
    </header>
	<?php
		require_once '../../Objects/Connection.php';
		$dbh = db_connect();  
		
	if($_SERVER["REQUEST_METHOD"] == "POST") {
	//Le formulaire a été envoyé
	
	//vérifier les données
	//if(empty( $_POST['idPromo']))		{echo 'Promo';}
	//if(empty( $_POST['idPromoService'])){echo 'PromoService';}
	//if(empty( $_POST['idService']))		{echo 'Sevice';}
	
	//la promotion doit être associée à un service_entry
	$serviceExiste = false;
	//vérifier si idService existe
	if(empty( $_POST['idService']) == false)
	{	
		//il existe. vérifier s'il est valide
		foreach($dbh->query('SELECT * FROM service WHERE pk_service = ' . $_POST['idService']) as $row)
		{
			//il est valide.
			$serviceExiste = true;
		}
	}
	
	//si tout va bien, mettre à jour la base de données
	if($serviceExiste){
		//si la promo existe, la modifier
		$promoExiste = false;
		//vérifier si idPromo existe
		if(empty( $_POST['idPromo']) == false)
		{	
			//il existe. vérifier s'il est valide
			foreach($dbh->query('SELECT * FROM promotion WHERE pk_promotion = ' . $_POST['idPromo']) as $row)
			{
				//il est valide.
				$promoExiste = true;
				//Mettre à jour la base de données.
				//echo 'SQL UPDATE promotion';
				
				//statement
				$rabais = $_POST['rabais'] / 100;
				$sql = "UPDATE promotion SET rabais=". $rabais;
				$sql = $sql . ", promotion_titre='". $_POST['titrePromo'] ."'";
				$sql = $sql . " WHERE pk_promotion=" . $_POST['idPromo'];
				//var_dump($sql);
				// Preparer le statement
				$stmt = $dbh->prepare($sql);

				// exécuter la requête
				$stmt->execute();
					
			}
		}
		//si la promo n'existe pas, la créer
		if($promoExiste == false)
		{
			//echo 'SQL INSERT propmption';
			
			// Preparer le statement
			$stmt = $dbh->prepare("INSERT INTO promotion(promotion_titre, rabais) VALUES(?, ?)");

			// exécuter la requête
			$rabais = $_POST['rabais'] / 100;
			$stmt->execute(array($_POST['titrePromo'],$rabais));
			
		}
	
		//Obtenir le bon idPromo pour la fk de la suite
		$fkPromo = '';
		if($promoExiste){
			//la promo donnée a un id valide
			$fkPromo = $_POST['idPromo'];
		} else {
			//on a inséré une nouvelle promo dans la BD
			foreach($dbh->query('SELECT * FROM promotion') as $row)
			{
				$fkPromo = $row['pk_promotion'];
			}
		}
	
		//si la promoService existe, la modifier
		$promoServiceExiste = false;
		//vérifier si idPromoService existe
		if(empty( $_POST['idPromoService']) == false)
		{	
			//il existe. vérifier s'il est valide
			foreach($dbh->query('SELECT * FROM ta_promotion_service WHERE pk_promotion_service = ' . $_POST['idPromoService']) as $row)
			{
				//il est valide.
				$promoServiceExiste = true;
				//Mettre à jour la base de données.
				//echo 'SQL UPDATE ta';
				//statement
				$sql = "UPDATE ta_promotion_service SET fk_promotion=". $fkPromo;
				$sql = $sql . ", fk_service=". $_POST['idService'];
				$sql = $sql . ", date_debut='". $_POST['debut'] ."'";
				$sql = $sql . ", date_fin='". $_POST['fin'] ."'";
				$sql = $sql . ", code='". $_POST['code'] ."'";
				$sql = $sql . " WHERE pk_promotion_service=" . $_POST['idPromoService'];
				//var_dump($sql);
				// Preparer le statement
				$stmt = $dbh->prepare($sql);

				// exécuter la requête
				$stmt->execute();
			
			}
			
		}
		//si la promoService n'existe pas, la créer
			if($promoServiceExiste == false)
			{
				//echo 'SQL INSERT ta';				
				
				// Preparer le statement
				$stmt = $dbh->prepare("INSERT INTO ta_promotion_service(fk_promotion, fk_service, date_debut, date_fin, code) VALUES(?, ?, ?, ?, ?)");

				// exécuter la requête
				//$fkPromo;
				$fkService 	= $_POST['idService'];
				$dateDebut 	= $_POST['debut'];
				$dateFin 	= $_POST['fin'];
				$code 		= $_POST['code'];
				$stmt->execute( array($fkPromo, $fkService, $dateDebut, $dateFin, $code) );
			}
		//si tout va bien, fermer l'onglet
		
		echo "<script>window.close();</script>";
		}
	
	}
		
		$promo['date_debut'] 	= '2017-04-01';
		$promo['date_fin'] 		= '2017-04-01';
		$promo['code'] 			= '';
		$promo['titre'] = '';
		$promo['rabais'] 		= '0';
		$idPromo='';
		$idPromoService='';
		$idService = '';
	if(isset($_GET["idPromo"]) ) {
			
				$idPromo = $_GET['idPromo'];
				foreach($dbh->query('SELECT * FROM Promotion WHERE Promotion.pk_promotion = ' . $idPromo) as $row)
				{
					$promo['titre'] = $row['promotion_titre'];
					$promo['rabais'] 		= $row['rabais'] * 100;
				}
				
		if( isset($_GET["idPromoService"]) ) {
				$idPromoService = $_GET['idPromoService'];
				
				foreach($dbh->query('SELECT * FROM Promotion JOIN ta_promotion_service ON ta_promotion_service.fk_promotion = Promotion.pk_promotion AND ta_promotion_service.pk_promotion_service = ' . $idPromoService) as $row)
				{
					$promo['date_debut'] 	= $row['date_debut'];
					$promo['date_fin'] 		= $row['date_fin'];
					$promo['code'] 			= $row['code'];
					
				}
			}
	}
	if(isset($_GET["idService"]) ) {
		$idService = $_GET['idService'];
	}
	
	
?>
	
	<?php
	//Commence par vérifier si il a une variable administrateur
	if (isset($_SESSION['administrateur'])) {
		//si c'est un admin
		if ($_SESSION['administrateur'] == 1) {
			
			try {
			?>
				<div class="container-fluid">
				  <form method="post"  action = "" enctype="multipart/form-data">
					<div class="row">
					  <div class="col-md-1">
						<!-- Espace gauche -->
					  </div>
					  
					  <div class="col-md-10 service_entry">
					  
						<div class="row">
						  <div class="col-md-12">Ajouter la période et un code pour appliquer la promotion choisie.</div>
						</div>
						
						<div class="row">
						  <div class="col-md-12">Le code n'est pas obligatoire et ne sera pas exigé si la promotion est vide.</div>
						</div>
						
						<div class="row">
						  <div class="col-md-4">
						  
							<!-- Entrée du pourcentage -->
							<div class="row percent_input">
							  <div class="input-group">
								  <?php echo '<input name="rabais" type="text" class="form-control" placeholder="00" value="' . $promo['rabais'] . '" aria-label="Pourcentage" aria-describedby="basic-addon2"/>' ?>
								  <span class="input-group-addon" id="basic-addon2">%</span>
							  </div>
							</div>
							<div class="row">
							  <div class="col-md-12">
							  
								<!-- Promotions existantes -->
								
								<div class="btn-group">
									<button class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Choisir une promotion
									</button>
									<span class="caret"></span>
									<div class="dropdown-menu">
										<?php foreach($dbh->query('SELECT * FROM Promotion') as $row) {?>
										
											<?php 
											
											$ext='';
											if(isset($_GET["idPromoService"])){
												$ext = $ext . "&idPromoService=" . $_GET["idPromoService"];
											}
											if(isset($_GET["idService"])){
												$ext = $ext . "&idService=" . $_GET["idService"];
											}
											
											print_r('<a class="dropdown-item" href="Promotions.php?idPromo='. $row['pk_promotion'] . $ext .'" >'); 
											
											
											?>
												<?php print_r($row["promotion_titre"]); ?>
											 </a>
										<?php } ?>
									</div>
								</div>
								
								<!-- Fin promotions existantes -->
								
							  </div>
							</div>
							<div class='row'>
								<div class='col-md-12'>
									<?php echo '<input class="form-control" type="text" name="titrePromo" placeholder="Titre" value="' . $promo['titre'] . '">' ?>
								</div>
							</div>
						  </div>
						  <div class="col-md-8">
							<div class="row">
							  <div class="col-md-12">Période de la promotion</div>
							</div>
							<div class="row">
							  <div class="col-md-5">
								<!-- Date de début de la promotion -->
								<input class="form-control" type="date" name="debut" value=<?php echo $promo['date_debut']?>/>
							  </div>
							  <div class="col-md-2">à</div>
							  <div class="col-md-5">
								<!-- Date de fin de la promotion -->
								<input class="form-control" type="date" name="fin" value=<?php echo $promo['date_fin']?>/>
							  </div>
							</div>
							<div class="row">
							  <div class="col-md-12">Entrer un code s'il est requis pour appliquer la promotion lors de la création de la facture.</div>
							</div>
							<div class="row">
							  <div class="col-md-8">
								<!-- Code promotionnel -->
								<input type="text" class="form-control" name="code" value=<?php echo $promo['code']?> />
							  </div>
							  <div class="col-md-4">
								<!-- Espace vide pour les get passés en post -->
								<div class="row">
									<div class="col-md-1">
										<?php echo '<input type="text" class="invisible form-control" value ="' . $idService . '" name="idService"/>' ?>
									</div>
									<div class="col-md-1">
										<?php echo '<input type="text" class="invisible form-control" value ="' . $idPromo . '" name="idPromo"/>' ?>
									</div>
									<div class="col-md-1">
										<?php echo '<input type="text" class="invisible form-control" value ="' . $idPromoService . '" name="idPromoService"/>' ?>
									</div>
									<div class="col-md-9">
									</div>
								 </div>
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
				  </form>
				</div>
				<?php
				} catch (PDOException $e) {
						print "Error!: " . $e->getMessage() . "<br/>";
						die();
				}
			//si c'est un utilisateur
		}
			//sinon un visiteur
	}?>
  </body>
</html>
