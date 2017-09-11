<!-- /**************************************************************************************************/
/* Fichier ...................... : Catalogue.php */
/* Type ......................... : Document PHP */
/* Titre ........................ : Catalogue*/
/* Auteur ....................... : Guillaume Bergs */
/* Date de création ............. : 2017-08-21 */
/* Date de mise en ligne ........ : 2017-08-21 */
/* Date de mise à jour .......... : 2017-09-10 */
/*******************************************************************************************************/
/* Catalogue */
/*******************************************************************************************************/
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
		foreach($dbh->query('SELECT * from service') as $row) {
			
			
			print_r("<div class='row'>");
			
				print_r("<div class='col-1'></div>"); //blanc à gauche
				
				print_r("<div class='service_entry col-10'>"); 	//article col-10
					print_r("<div class='row'>");				//article row
					
						print_r("<div class='col-3'>");
							print_r("<img src='../../images/services/" . $row["image"]. ".png' class='img_service'/><br/>");
						print_r("</div>");
						
						print_r("<div class='col-9'>");
						
							print_r("<div class='row'>");
								print_r("<div class='col-6'>");
									print_r("<div class='service_title'>" . $row["service_titre"]. "</div><br/>");
								print_r("</div>");
								print_r("<div class='col-6'></div>");
							print_r("</div>");
							
							print_r("<div class='row'>");
								print_r("<div class='col-12'>");
									print_r("<div class='service_description'>" . $row["service_description"]. "</div><br/>");
								print_r("</div>");
							print_r("</div>");
							
							print_r("<div class='row'>");
							
								print_r("<div class='col-6'>");
									print_r("<div class='service_price'>Tarif : " . $row["tarif"]. "$</div><br/>");
								print_r("</div>");
								
								print_r("<div class='col-4'>");
									print_r("<div class='service_duration'>Durée : " . $row["duree"]. "h</div><br/>");
								print_r("</div>");
								
								print_r("<div class='col-2'>");
									if (isset($_SESSION['administrateur'])) {
										if($_SESSION['administrateur'] == 0) {
												print_r("<div class='btn_add'><a href='http://www.perdu.com'><img src='../../images/icones/panier.png' class='btn_add imgButton'/></a></div>");
										}
									}
								print_r("</div>");
								
							print_r("</div>"); //row
						
						print_r("</div>"); //col-9
					print_r("</div"); 	//article row
						
						
						//Code pour Services
						include_once '../../objects/Promotion.php';
						if (isset($_SESSION['administrateur'])) {
							if($_SESSION['administrateur'] == 1) {
								
								print_r("<div class='row'>");
								
									print_r("<div class='col-3'>");
										print_r("<div class='service_duration'> Promotions : </div>");
									print_r("</div>");
									
									print_r("<div class='col-8'>");
									
										$promos;
										foreach($dbh->query('SELECT * FROM promotion JOIN ta_promotion_service ON promotion.pk_promotion = ta_promotion_service.fk_promotion AND ta_promotion_service.fk_service = '.$row["pk_service"]) as $row2) {
						
											$promos[$row2["pk_promotion_service"]] = new Promotion($row2);
							
											$promos[$row2["pk_promotion_service"]]->insertImg();
										}
										
										print_r("<div class='btn_add'><a href='http://www.perdu.com'><img src='../../images/icones/plus.png' class='btn_add imgButton'/></a></div>");
				
									print_r("</div>"); //col-8
									
									
									print_r("<div class='col-1'>");
										print_r("<div class='btn_sociaux'><a href='http://www.perdu.com'><img src='../../images/icones/medias sociaux.jpeg' class='btn_sociaux imgButton'/></a></div>");
									print_r("</div>");
									
								print_r("</div>"); //row
							}
							
							
						}
						//Fin code pour services
						
					
						
				print_r("</div");		//article col-10
				
				print_r("<div class='col-1'></div>"); //blanc à droite
				
			print_r("</div>"); //row principal
			
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