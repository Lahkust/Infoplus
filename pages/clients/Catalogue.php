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
	if (isset($_SESSION['administrateur'])) 
	{
		echo "is set";
	}
		?>
<?php
	try {
		$dbh = new PDO('mysql:host=localhost;dbname=infoplus', 'root', '');
		foreach($dbh->query('SELECT * from service') as $row) {
			
			
			print_r("<div class='row'>");
			
				print_r("<div class='col-1'></div>");
				
				print_r("<div class='service_entry col-10'>");
				
					print_r("<div class='col-3'>");
						print_r("<img src='../../images/services/" . $row["image"]. ".png' class='img_service'/><br/>");
					print_r("</div>");
					
					print_r("<div class='col-7'>");
					
						print_r("<div class='row'>");
							print_r("<div class='col-7'>");
								print_r("<div class='service_title'>" . $row["service_titre"]. "</div><br/>");
							print_r("</div>");
						print_r("</div>");
						
						print_r("<div class='row'>");
							print_r("<div class='col-7'>");
								print_r("<div class='service_description'>" . $row["service_description"]. "</div><br/>");
							print_r("</div>");
						print_r("</div>");
						
						print_r("<div class='row'>");
						
							print_r("<div class='col-3'>");
								print_r("<div class='service_price'>" . $row["tarif"]. "</div><br/>");
							print_r("</div>");
							
							print_r("<div class='col-3'>");
								print_r("<div class='service_duration'>" . $row["duree"]. "</div><br/>");
							print_r("</div>");
							
							print_r("<div class='col-1'>");
								print_r("<div class='btn_add'><a href='http://www.perdu.com'><img src='../../images/icones/panier.png' class='btn_add'/></a></div>");
							print_r("</div>");
							
						print_r("</div>");
						
					print_r("</div>");
					
				print_r("</div");
				
				print_r("<div class='col-1'></div>");
				
			print_r("</div>");
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