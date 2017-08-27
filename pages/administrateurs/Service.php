<!-- /**************************************************************************************************/
/* Fichier ...................... : Service.php */
/* Type ......................... : Document PHP */
/* Titre ........................ : Service*/
/* Auteur ....................... : Guillaume Bergs */
/* Date de création ............. : 2017-08-21 */
/* Date de mise en ligne ........ : 2017-08-21 */
/* Date de mise à jour .......... : 2017-08-21 */
/*******************************************************************************************************/
/* Permet de gérer les services offerts et les promotions associées */
/*******************************************************************************************************/
-->


<!doctype HTML>
<html lang="fr">
	
	<head>
		<meta charset="utf-8">
		<title>Service</title>
		<link rel="stylesheet" href="../../styles/style.css"/>
	</head>
	
	<header>
		<?php include_once 'EnteteAdmin.php' ?>
	</header>
	
	<body>
		
<?php
	try {
		$dbh = new PDO('mysql:host=localhost;dbname=infoplus', 'root', '');
		foreach($dbh->query('SELECT * FROM service') as $row) {
			
			print_r("<div class='service_entry'>");
				print_r("<img src='../../images/services/" . $row["image"]. ".png' class='img_service'/><br/>");
				print_r("<div class='service_title'>" . $row["service_titre"]. "</div><br/>");
				print_r("<div class='service_description'>" . $row["service_description"]. "</div><br/>");
				print_r("<div class='service_price'>" . $row["tarif"]. "</div><br/>");
				print_r("<div class='service_duration'>" . $row["duree"]. "</div><br/>");
				print_r("<div class='promotion_title'>Promotions</div><br/>");
				foreach($dbh->query('SELECT * FROM promotion JOIN ta_promotion_service ON promotion.pk_promotion = ta_promotion_service.fk_promotion AND ta_promotion_service.fk_service = '.$row["pk_service"]) as $row2) {
					//
					print_r($row2["rabais"]);
				}
				
				print_r("<div class='btn_add'><a href='http://www.perdu.com'><img src='../../images/icsones/medias sociaux.jpeg' class='btn_add'/></a></div>");
				
				
			print_r("</div");
			print_r("<br/><br/>");
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