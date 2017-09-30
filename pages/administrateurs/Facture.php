<!-- /**************************************************************************************************/
/* Fichier ...................... : Facture.php */
/* Type ......................... : Document PHP */
/* Titre ........................ : Facture*/
/* Auteur ....................... : Christopher Brown */
/* Date de création ............. : 2017-09-11 */
/* Date de mise en ligne ........ : 2017-09-11 */
/* Date de mise à jour .......... : 2017-09-27*/
/*******************************************************************************************************/
/* Facture des clients avec leurs informations */
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
			$i = 0;
			$dbh1 = db_connect();		
			foreach($dbh1->query('select * from client a join facture b on a.pk_client=b.fk_client join ta_facture_service c 
				on b.pk_facture=c.pk_facture_service ORDER BY b.date_service DESC') as $row) {
				$i++;
				?>
				<div class="container-fluid service_entry">
					<div class="row">
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-1">
								</div>
								<div class="col-md-10">
									<div class="row">
										<div class="col-md-2">
											<?php print_r($row["pk_facture"]); ?>
										</div>
										<div class="col-md-5">
											<?php print_r(" " . $row["prenom"] . " " . $row["nom"]); ?>
										</div>
										<div class="col-md-3">
											<?php print_r($row["date_service"]); ?>
										</div>
										<div class="col-md-2">
										</div>
									</div>
									<div class="row">
										<div class="col-md-2">
										</div>
										<div class="col-md-5">
											<?php print_r($row["no_confirmation"]); ?>
										</div>
										<div class="col-md-3">
										<?php
										try {
											$pk_facture = $row["pk_facture"];
											$stmt = $dbh1->prepare('SELECT SUM(tarif_facture) FROM ta_facture_service WHERE fk_facture = :fk_facture');
											$stmt->execute(['fk_facture' => $pk_facture]);
											$facture = $stmt->fetch();
											print $facture['SUM(tarif_facture)'];
										} catch (PDOException $e) {
											print "Error!: " . $e->getMessage() . "<br/>";
											die();
										}
										?>
										</div>
										<div class="col-md-2">
											 <a id="hide" class="collapsed" data-toggle="collapse" <?php echo 'href="#detail' . $i . '"';?> ><!--onclick="hideDetail()"-->Détail</a>	
										</div>
									</div>
									<div <?php echo 'id="detail' . $i . '"';?> class="collapse">
									<?php
									//Avoir les détails sur les produits achetés
									try {
										$stmt = $dbh1->prepare('SELECT * FROM ta_facture_service a join service b on a.fk_service = b.pk_service WHERE fk_facture = :fk_facture');
										$stmt->execute(['fk_facture' => $pk_facture]);
										$data = $stmt->fetchAll();
										foreach ($data as $row1)
										{
										?>
											<div class="row">
												<div class="col-md-3">
												</div>
												<div class="col-md-4">
													<?php echo $row1['service_titre']; ?>
												</div>
												<div class="col-md-3">
													<?php echo $row1['tarif']; ?>
												</div>
												<div class="col-md-2">
													 <a class="collapsed" data-toggle="collapse"  href="#detail" <!--onclick="hideDetail()"Réduire--></a>
												</div>
											</div>
											<?php
											$service = $row1['pk_service'];
											$stmt = $dbh1->prepare('SELECT pk_service, promotion_titre, rabais FROM service a join ta_promotion_service b 
											on a.pk_service = b.fk_service join promotion c on b.fk_promotion=c.pk_promotion');
											$stmt->execute(['fk_facture' => $service]);
											$data1 = $stmt->fetchAll();
											$facture = $stmt->fetch();
											print $facture['SUM(tarif_facture)'];
											?>
												<div class="row">
													<div class="col-md-3">
													</div>
													<div class="col-md-4">
														<?php echo $row1['service_titre']; ?>
													</div>
													<div class="col-md-3">
														<?php echo $row1['tarif']; ?>
													</div>
													<div class="col-md-2">
														 <a class="collapsed" data-toggle="collapse"  href="#detail" <!--onclick="hideDetail()"Réduire--></a>
													</div>
												</div>
											<?php
											}
										<?php
										}
									} catch (PDOException $e) {
										print "Error!: " . $e->getMessage() . "<br/>";
										die();
									}
									
									?>
									</div>
								</div>
							</div>
							<div class="col-md-1">
							</div>
						</div>
					</div>
				</div>
				<?php
			}
			
		} catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
			die();
		}
		$dbh1 = null;
		?>
		
		<script>
		function hideDetail() {
			var x = document.getElementById('hide');
			if (x.style.display === 'none') {
				x.style.display = 'block';
			} else {
				x.style.display = 'none';
			}
		}
		</script>
		
		<footer>
		</footer>
	</body>
</html>