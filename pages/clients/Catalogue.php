<!-- /**************************************************************************************************/
/* Fichier ...................... : Catalogue.php */
/* Type ......................... : Document PHP */
/* Titre ........................ : Catalogue*/
/* Auteur ....................... : Guillaume Bergs */
/* Date de création ............. : 2017-08-21 */
/* Date de mise en ligne ........ : 2017-08-21 */
/* Date de mise à jour .......... : 2017-09-06 */
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
	</head>
	
	<header>
		<?php include_once '../Entete.php' ?>
	</header>
	
	<body>
			
<?php
	try {
		$dbh = new PDO('mysql:host=localhost;dbname=infoplus', 'root', '');
		foreach($dbh->query('SELECT * from service') as $row) {
			
			print_r("<div class='service_entry'>");
				print_r("<img src='../../images/services/" . $row["image"]. ".png' class='img_service'/><br/>");
				print_r("<div class='service_title'>" . $row["service_titre"]. "</div><br/>");
				print_r("<div class='service_description'>" . $row["service_description"]. "</div><br/>");
				print_r("<div class='service_price'>" . $row["tarif"]. "</div><br/>");
				print_r("<div class='service_duration'>" . $row["duree"]. "</div><br/>");
				print_r("<div class='btn_add'><a href='http://www.perdu.com'><img src='../../images/icones/panier.png' class='btn_add'/></a></div>");
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