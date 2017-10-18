<!-- /**************************************************************************************************/
/* Fichier ...................... : Catalogue.php */
/* Type ......................... : Document PHP */
/* Titre ........................ : Catalogue*/
/* Auteur ....................... : Guillaume Bergs */
/* Date de création ............. : 2017-08-21 */
/* Date de mise en ligne ........ : 2017-08-21 */
/* Date de mise à jour .......... : 2017-10-02 */
/*******************************************************************************************************/
/* Catalogue */
/*******************************************************************************************************/
-->
<!doctype HTML>
<html lang="fr">
<?php	 session_start(); 
		require_once '../../Objects/Connection.php';
$dbh = db_connect();  ?>
	
	<head>
		<meta charset="utf-8">
		<title>Connexion</title>
		<link rel="stylesheet" href="../../styles/style.css"/>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="../../scripts/GestionPromotions.js"></script>
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
		
		
		
		
		<script>
		//Por supprimer une association 
		
		function deleteConnection(idPromoService)
		{
			$.ajax({
			method: "POST",
			url: "../../Objects/deleteOffer.php",
			data: { promoService: idPromoService }
			})
			.done(function( msg ) {
			alert( "The deed is done." );
			});
				
		}
		
		
		</script>
	</head>
	
	<header>
		<?php include_once '../Entete.php' ?>
	</header>
	
	<body>

    <!--la fenêtre modal service-->
    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content" id="requete">
            <?php //include_once '../administrateurs/GestionService.php' ?>
        </div>

    </div>

<?php
	try {
		
			//Code pour le bouton d'ajout
			include_once '../../objects/Promotion.php';
			if (isset($_SESSION['administrateur'])) {
				if($_SESSION['administrateur'] == 1) {
					?>
					
					<div class='row'>
						<div class='col-9'></div>
						<div class='col-3 service_add'>
							<a href='#' id="ajouterService">
								Ajouter un service
							</a>
						</div>
					</div>
					
					<?php
				}
			}
			//Fin code pour le bouton d'ajout
		
		foreach($dbh->query('SELECT * from service') as $row) {
		?>
			<div class='row'>
			
				<div class='col-1'></div>
				
				<div class='service_entry col-10'>
				<?php
						//Code pour le bouton d'admin
						include_once '../../objects/Promotion.php';
						if (isset($_SESSION['administrateur'])) {
							if($_SESSION['administrateur'] == 1) {
							?>	
								<div class='row'>
									<div class='col-11'></div>
									<div class='col-1'>
										<div class='btn-group'>
											<button data-toggle='dropdown' class='btn btn-default dropdown-toggle'>
												<span class='caret'></span>
											</button>
											<ul class='dropdown-menu'>
												<li>
													<a href='../administrateurs/GestionService.php?idService=<?php echo $row['pk_service'] ?>' id="modifierService" target="_blank">
														Modifier
													</a>
												</li>
												<li>
													<a href='#'>
														Désactiver
													</a>
												</li>
											</ul>
										</div>
									</div>
								</div>
								<?php
							}
						}
						//Fin code pour le bouton d'admin
						?>
					<!-- articles -->
					<div class='row'>
					
						<div class='col-3'>
							<?php print_r("<img src='../../images/services/" . $row["image"]. ".png' class='img_service'/><br/>"); ?>
						</div>
						
						<div class='col-9'>
						
							<div class='row'>
								<div class='col-6'>
									<?php print_r("<div class='service_title'>" . $row["service_titre"]. "</div><br/>"); ?>
								</div>
								<div class='col-6'></div>
							</div>
							
							<div class='row'>
								<div class='col-12'>
									<?php print_r("<div class='service_description'>" . $row["service_description"]. "</div><br/>"); ?>
								</div>
							</div>
							
							<div class='row'>
								<div class='col-6'>
									<?php print_r("<div class='service_price'>Tarif : " . $row["tarif"]. "$</div><br/>"); ?>
								</div>
								
								<div class='col-4'>
									<?php print_r("<div class='service_duration'>Durée : " . $row["duree"]. "h</div><br/>"); ?>
								</div>
								
								<div class='col-2'>
								<?php
									if (isset($_SESSION['administrateur'])) {
										if($_SESSION['administrateur'] == 0) {
											?>
												<div class='btn_add'>
													<a href='#' id="ajouterPanier">
														<img src='../../images/icones/panier.png' class='btn_add imgButton'/>
													</a>
												</div>
											<?php
										}
									}
									?>
								</div>
							</div>
						</div>
					</div>
						
					<div class='row'>
					<?php
						//Code pour Services
						
						include_once '../../objects/Promotion.php';
						if (isset($_SESSION['administrateur'])) {
							if($_SESSION['administrateur'] == 1) {
								?>
								
									<div class='col-3'>
										<div class='service_duration'> 
											Promotions : 
										</div>
									</div>
									
									<div class='col-8'>
										<ul class="nav nav-pills nav-justified">
											<?php
												$promos;
												foreach($dbh->query('SELECT * FROM promotion JOIN ta_promotion_service ON promotion.pk_promotion = ta_promotion_service.fk_promotion AND ta_promotion_service.fk_service = '.$row["pk_service"]) as $row2) {
							
													$promos[$row2["pk_promotion_service"]] = new Promotion($row2);
													?>
													
													<li class="nav-item dropdown">
														<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
															<?php print_r($promos[$row2["pk_promotion_service"]]->getPercent() . "%"); ?><br/>
															<?php print_r($promos[$row2["pk_promotion_service"]]->getTitre()); ?>
														</a>
														<div class="dropdown-menu">
															<?php echo '<a class="dropdown-item" href="../administrateurs/Promotions.php?idService='. $row['pk_service'] . '&idPromo='. $row2['fk_promotion'] .'&idPromoService='. $row2['pk_promotion_service'] .'" target="_blank">Modifier</a>'; ?>
															
															<?php echo'<a class="dropdown-item" href="#" onclick="deleteConnection('.$row2['pk_promotion_service'].')">Supprimer</a>' ?>
													</li>
													
													<?php
												}
											?>
											<!-- Bouton d'ajout d'une promotion -->
											<li class="nav-item">
												<?php echo' <a class="nav-link"  href="../administrateurs/Promotions.php?idService='. $row['pk_service'] .'" target="_blank">' ?>
													<div class='row'>
														<div class='col-md-12'>
															<!--img src='../../images/icones/plus.png' class='btn_add imgButton'/-->
															+
														</div>
													</div>
												</a>
											</li>
										</ul>
									</div>
									
									<div class='col-1'>
										<a href='http://www.perdu.com'>
											<img src='../../images/icones/medias sociaux.jpeg' class='btn_sociaux imgButton'/>
										</a>
									</div>
									<?php
							}
						}
						?>
						</div>
						<!-- Fin code pour services -->
						
				</div>
				<div class='col-1'></div>
			</div>
			
			<div class='row'>
				<div class='col-12'></div>
			</div>
			
			<?php
		}
		$dbh = null;
	} catch (PDOException $e) {
		print "Error!: " . $e->getMessage() . "<br/>";
		die();
	}
?>
	</div>
	</body>
	<script type="text/javascript">

        //fenetre modale
        var modal = document.getElementById('myModal');
        var ajServ = document.getElementById('ajouterService');
        //var modServ = document.getElementById('modifierService');
        var ajPan = document.getElementById('ajouterPanier');

        $(document).ready(function() {
            $("#ajouterService").click(function() {
                modal.style.display = "block";
                //var string = "include '../administrateurs/GestionService.php';
                //$("#ajouterService").html(string);
            });

            $("#ajouterPanier").click(function() {
                modal.style.display = "block";
                var Id = $(this).attr('id');
                var txt = document.getElementById(Id).innerText;


                var dataString = { 'id': id};

                $.ajax({
                    type:"POST",
                    url:"",
                    data: dataString,
                    success: function(data){
                        var result = JSON.parse(data);

                        var string = "<div class='container-fluid'><div class='row'><div class='col-md-10'>Titre</div><div class='col-md-2'>" +
                            "Prix</div></div><div class='row'><div class='col-md-12'>Description</div></div><div class='row'><div class='col-md-12'>" +
                            "<a href='#'>Ajouter au panier</a></div></div></div>";

                        $("#requete").html(string);
                    },
                    error:      function(jqXHR,textStatus,errorThrown){
                        alert(JSON.stringify(jqXHR)+" "+textStatus+" "+errorThrown);
                        //alert("error occurred");
                    }
                });
            });

            /*$(modServ).click(function() {
                modal.style.display = "block";
                $("#requete").html(string);
            });*/
        });


        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }


    </script>
	<footer>
	</footer>
	
</html>