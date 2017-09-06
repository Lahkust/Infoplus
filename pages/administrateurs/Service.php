<!-- /**************************************************************************************************/
/* Fichier ...................... : Service.php */
/* Type ......................... : Document PHP */
/* Titre ........................ : Service*/
/* Auteur ....................... : Guillaume Bergs */
/* Date de création ............. : 2017-08-21 */
/* Date de mise en ligne ........ : 2017-08-21 */
/* Date de mise à jour .......... : 2017-09-06 */
/*******************************************************************************************************/
/* Permet de gérer les services offerts et les promotions associées */
/*******************************************************************************************************/
-->


<!doctype HTML>
<html lang="fr">
	<?php	 session_start(); ?>
	<head>
		<meta charset="utf-8">
		<title>Service</title>
		<link rel="stylesheet" href="../../styles/style.css"/>
	</head>
	
	<header>
		<?php include_once '../Entete.php' ?>
	</header>
	
	<body>
		
<?php
include_once '../../objects/Promotion.php';
	try {
		$dbh = new PDO('mysql:host=localhost;dbname=infoplus', 'root', '');
		foreach($dbh->query('SELECT * FROM service') as $row) {
			print_r("<div class='service_entry'>");
			print_r("<img src='../../images/services/" . $row["image"]. ".png' class='img_service'/><br/>");
			print_r("<div class='service_title'>" . $row["service_titre"]. "</div><br/>");
			print_r("<div class='service_description'>" . $row["service_description"]. "</div><br/>");
			print_r("<div class='service_price'>" . $row["tarif"]. "$</div><br/>");
			print_r("<div class='service_duration'>" . $row["duree"]. "h</div><br/>");
			print_r("<div class='promotion_title'>Promotions</div><br/>");
			
			$promos;
			foreach($dbh->query('SELECT * FROM promotion JOIN ta_promotion_service ON promotion.pk_promotion = ta_promotion_service.fk_promotion AND ta_promotion_service.fk_service = '.$row["pk_service"]) as $row2) {
				
				$promos[$row2["pk_promotion_service"]] = new Promotion($row2);
					
				$promos[$row2["pk_promotion_service"]]->insertImg();
			}
			
			print_r("<div class='btn_add'><a href='http://www.perdu.com'><img src='../../images/icones/plus.png' class='btn_add'/></a></div>");
			
			print_r("<div class='btn_sociaux'><a href='http://www.perdu.com'><img src='../../images/icones/medias sociaux.jpeg' class='btn_sociaux'/></a></div>");
					
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