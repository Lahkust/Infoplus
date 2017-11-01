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
		<script src="../../scripts/GestionPromotions.js"></script>
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>


        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
		
		<script>
		//Por supprimer une association 
		
		/*function deleteConnection(idPromoService)
		{
			$.ajax({
			method: "POST",
			url: "../../Objects/deleteOffer.php",
			data: { promoService: idPromoService }
			})
			.done(function( msg ) {
			alert( "The deed is done." );
			});
				
		}*/
		  <!-- Load Facebook SDK for JavaScript -->
		  <div id="fb-root"></div>
		  <script>(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1";
			fjs.parentNode.insertBefore(js, fjs);
		  }(document, 'script', 'facebook-jssdk'));</script>
		
		</script>
		
		<!-- Placez cette balise dans l'en-tête ou juste avant la balise de fermeture du corps de texte. -->
		<script src="https://apis.google.com/js/platform.js" async defer>
		  {lang: 'fr'}
		</script>
	</head>
	
	<header>
		<?php include_once '../Entete.php' ?>
	</header>
	
	<body>

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
													<a href="#" >
														<img <?php echo 'id="ajouterPanier_' . $row['pk_service'] . '"'?> src='../../images/icones/panier.png' class='btn_add imgButton'/>
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
										<ul class="nav nav-pills nav-justified">
											<li class="nav-item dropdown">
												<a class="nav-item dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
													<img src='../../images/icones/medias_sociaux.jpeg' class='btn_sociaux imgButton'/>
												</a>
												<div class="dropdown-menu">
													<a class="dropdown-item" href="#">
														  <!-- Your share button code -->
														  <div class="fb-share-button"  data-href="http://www.your-domain.com/your-page.html"  data-layout="button_count">
															Partager Sur Facebook
														  </div>
													</a>
													
													
													<a class="dropdown-item" target="_blank" href="https://twitter.com/intent/tweet?text=<?php echo $row["tarif"] . '%24%20pour%20un%20cours%20sur%20' . $row["service_titre"] . '%3F!%20'?>Magnifique%20offre%20chez%20%40Infoplusplus%20!%20%23bonplan%20%23viking">
															Partager sur Twitter
													</a>
													<a class="dropdown-item" href="#">
														<!-- Placez cette balise où vous souhaitez faire apparaître le gadget bouton "Partager". -->
														<div class="g-plus" data-action="share" data-annotation="none"></div>
													</a>
												</div>
											</li>
										</ul>
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


    <!-- The Modal -->
    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content" id="requete">
            //contenu de la fenetre modale
        </div>

    </div>

	</body>
	<script type="text/javascript">

        //fenetre modale
        var modal = document.getElementById('myModal');

        $(document).ready(function() {
            //Gestion des services
            /*$("#ajouterService").click(function() {
                modal.style.display = "block";
                //var string = "include '../administrateurs/GestionService.php';
                //$("#ajouterService").html(string);
            });*/

            //Fenetre pour ajouter au panier un service
            $("img[id^='ajouterPanier']").click(function (event) {

                //Aller rechercher l'id complet de l'image cliquer
                var IdPanier = event.target.id;
                console.log(IdPanier);

                //separer la string pour avoir l'id
                var res = IdPanier.split("_");
                console.log(res[1]);

                //string qui contient id du service pour l'envoyer dans la rqt ajax
                var dataString = {'id': res[1]};

                //Faire apparaitre notre fenetre modale
                modal.style.display = "block";

                $.ajax({
                    type:"POST",
                    url:"../../scripts/InfoService.php",
                    data: dataString,
                    success: function(data){
                        var result = JSON.parse(data);

                        var string = "<div class='row'>" + "<div class='col-md-10'>" + result.service_titre + "</div>" +
                            "<div class='col-md-2'>" + result.tarif + "</div>" + "</div>" + "<div class='row'>" +
                            "<div class='col-md-12'>" + result.service_description + "</div>" + "</div>" + "<div class='row'>" +
                            "<div class='col-md-12'>" + "<a href='#' id='panierService_" + result.pk_service + "'" + ">Ajouter au panier</a>" + "</div>" + "</div>";



                        $("#requete").html(string);
                    },
                    error: function(jqXHR,textStatus,errorThrown){
                        alert(JSON.stringify(jqXHR)+" "+textStatus+" "+errorThrown);
                        //alert("error occurred");
                    }
                });
            });

            //$().on('click', function(event) {
            $(document).on('click', "a[id^='panierService_']", function(){

                //Aller chercher l'id du service
                var IdPanier = event.target.id;
                console.log(IdPanier);
                var res = IdPanier.split("_");
                console.log(res[1]);

                $.post("../../scripts/AjouterServicePanier.php", {"id_service": res[1]});
                location.reload();
            });

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