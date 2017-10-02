<!-- /**************************************************************************************************/
/* Fichier ...................... : GestionPromotions.php */
/* Type ......................... : Document PHP */
/* Titre ........................ : Gestion Promotions*/
/* Auteur ....................... : Guillaume Bergs */
/* Date de création ............. : 2017-08-27 */
/* Date de mise en ligne ........ : 2017-08-27 */
/* Date de mise à jour .......... : 2017-10-01 */
/*******************************************************************************************************************/
/* Permet de lister toutes les promotions, en créer de nuvelles, modifier les existantes et les appliquer en masse */
/*******************************************************************************************************************/
-->

<!doctype HTML>
<html lang="fr">
<?php	 session_start();
		require_once '../../Objects/Connection.php';
$dbh = db_connect();  

function random_num($size) {
	$key = '';
	$keys = range(0, 9);

	for ($i = 0; $i < $size; $i++) {
		$key .= $keys[array_rand($keys)];
	}

	return $key;
}

?>
	
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
	</head>
	
	<header>
		<?php include_once '../Entete.php' ?>
	</header>
	
	
	<?php 		
	// Si le bouton confirmer a été enclenché
	if($_SERVER["REQUEST_METHOD"] == "POST") {
	
	
	foreach ($_POST as $key => $value){
		if (substr($key, 0, 1) === 't') {
				//on retient le pourcentage
				$titre = $value;
			}
		
		if (substr($key, 0, 1) === 'r') {
				//on retient le rabais; seconde valeur
				$rabais = $value;
				$rabais = substr($rabais,0,-2);
				$rabais = $rabais /100;
				
				//on retient l'id de ce que l'on va tester
				$id = substr($key,7);
				
				//on vérifie si on doit modifier ou ajouter
				$ajout = true;
				foreach($dbh->query('SELECT * from promotion') as $row) {
					if($row['pk_promotion'] == $id){
						$ajout = false;
						//on doit faire une update
						//statement
						
						$sql = "UPDATE promotion SET rabais= ? , promotion_titre= ? WHERE pk_promotion= ? ";
						//var_dump($sql);
						// Preparer le statement
						$stmt = $dbh->prepare($sql);

						// exécuter la requête
						$stmt->execute(array($rabais,$titre,$id));
							}
						}
				
				if($ajout){
					//on doit faire un insert
			
					// Preparer le statement
					$stmt = $dbh->prepare("INSERT INTO promotion(promotion_titre, rabais) VALUES(?, ?)");

					// exécuter la requête
					$stmt->execute(array($titre,$rabais));
				}
						
						
				$titre = '';
				$rabais = '';
			}
		
		}
	
	
	}
	?>
	
	
	
	<body>
	<div class="container-fluid">		
	<form  method="post"  action = "" enctype="multipart/form-data" >
		<div class="row" id="container">
			<div class="col-md-1"></div>
			<div class="col-md-10" >
	<?php
		try {
			
		?>	
						<div class='row'>
							<div class='col-9'></div>
							<div class='col-3 service_add'>
								<a href='#' onclick="addPromo(<?php echo random_num(10) ?>)">
									Ajouter une promotion
								</a>
							</div>
						</div>
			<?php
			foreach($dbh->query('SELECT * from promotion') as $row) {
			?>

			
				<div class="row service_entry">
					<div class="col-md-6">
						<!-- Nom rabais -->
						<?php $promoTitre = $row["promotion_titre"];
						
						$ranNum = $row['pk_promotion'];
						
						$promoName = "titre_" . $ranNum;?>
						
						
						<?php echo '<input type="text" id="titre_' . $ranNum . '" class="form-control" name="' . $promoName . '" value="' . $promoTitre . '"disabled>' ?>
						
						
					</div>
					<div class="col-md-5">
						<!-- Pourcentage rabais -->
						
						<?php $promoRabais =$row["rabais"]*100;
						$promoRabais = $promoRabais . ' %';
						
						$rabaisName = "rabais_" . $ranNum;?>
						
						
						<?php echo '<input type="text" id="rabais_' . $ranNum . '" class="form-control" name="' . $rabaisName . '" value="' . $promoRabais . '"disabled>' ?>
						
						
					</div>
					<div class="col-md-1">
						<div class="btn-group">
							<button data-toggle="dropdown" class="btn btn-default dropdown-toggle">
								<span class="caret"></span>
							</button>
							<ul class="dropdown-menu">
								<li>
									<a href="#">Appliquer à tous les services</a>
								</li>
								<li>
									<a href="#" onclick="modifyPromo(<?php echo $ranNum ?>)">Modifier</a>
								</li>
								<li>
									<a href="#">Supprimer</a>
								</li>
							</ul>
						</div>
					</div>
					
					
				</div>

				<?php
			}
			$dbh = null;
		} catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
			die();
		}
	?>
						<div class='row' id="btnConfirm">
							<div class='col-9'></div>
							<div class='col-3 service_add'>
								<button type="submit" class="btn btn-warning">Confirmer</button>
							</div>
						</div>
						
					
			</div>
			<div class="col-md-1"></div>
		</div>
		</form>	
	</div>
	</body>
	
	<footer>
	</footer>
	
</html>