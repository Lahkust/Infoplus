<!-- /**************************************************************************************************/
/* Fichier ...................... : Profil.php */
/* Type ......................... : Document PHP */
/* Titre ........................ : Profil*/
/* Auteur ....................... : Christopher Brown */
/* Date de création ............. : 2017-08-30 */
/* Date de mise en ligne ........ : 2017-08-30 */
/* Date de mise à jour .......... : 2017-09-10 */
/*******************************************************************************************************/
/* Inscription ou modification du profil pour un utilisateur */
/*******************************************************************************************************/
-->
<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "infoplus";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	
	// Valeur de base pour les champs du formulaire
	$nom = "Nom";
	$prenom = "Prénom";
	$nocivic = "No civique";
	$rue = "Rue";
	$ville = "Ville";
	$pk_ville = "";
	$codepostal = "Code postal";
	$telephone = "Numéro de téléphone";
	$courriel = "Courriel";
	$confirmercourriel = "Confirmer Courriel";
	$motdepasse = "Password";
	$infolettre = "1";
	
	session_start();
?>
<!doctype html>
<html lang="fr">
	
	<head>
		<meta charset="utf-8">
		<title>Profil</title>
		<link rel="stylesheet" href="../../styles/style.css">
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
	
	</head>
	
	<header>
		<?php include_once '../Entete.php' ?>
	</header>
	
	<body>
		<!--Verifie s'il y a un utilisateur de connecte-->
		<?php if (isset($_SESSION['pk_utilisateur'])) { 
			
			$sql = "select * from utilisateur a join client b on a.pk_utilisateur=b.fk_utilisateur join adresse c on b.fk_adresse=c.pk_adresse 
				join ville d on c.fk_ville=d.pk_ville where a.pk_utilisateur=5";
			$result = mysqli_query($conn, $sql);

			if (mysqli_num_rows($result) > 0) {
				// rechercher chaque donnees pour le formulaire
				while($row = mysqli_fetch_assoc($result)) {
					$nom = $row['nom'];
					$prenom = $row['prenom'];
					$nocivic = $row['no_civique'];
					$rue = $row['rue'];
					$ville = $row['ville'];
					$pk_ville = $row['pk_ville'];
					$codepostal = $row['code_postal'];
					$telephone = $row['telephone'];
					$courriel = $row['courriel'];
					$confirmercourriel = $row['courriel'];
					$motdepasse = $row['mot_de_passe'];
					$infolettre = $row['infolettre'];
				}
			} else {
				echo "Erreur or 0 results";
			}

			mysqli_close($conn);
		}
		?>
		<form method="post" action="cible.php" enctype="multipart/form-data">
			<fieldset>
				<p class="textNoir">Remplissez ce formulaire pour créer votre profil</p>
				<p class="textRouge">Tous les champs sont obligatoires</p>
				
				<input type="text" name="nom" value="<?php echo $nom;?>" required>
				<input type="text" name="prenom" value="<?php echo $prenom;?>" required><br/>
				
				<input type="text" name="nocivic" value="<?php echo $nocivic;?>" required>
				<input type="text" name="rue" value="<?php echo $rue;?>" required>
				
				<select name="ville" required>
					<option value="<?php echo $pk_ville?>"><?php echo $ville?></option>
					<?php					
						// Create connection
						$conn = mysqli_connect($servername, $username, $password, $dbname);
						// Check connection
						if (!$conn) {
							die("Connection failed: " . mysqli_connect_error());
						}
						
						$sql = "SELECT ville FROM ville";
						$result = mysqli_query($conn, $sql);

						if (mysqli_num_rows($result) > 0) {
							// output data of each row
							while($row = mysqli_fetch_assoc($result)) {
								print_r("<option value='". $row["pk_ville"] . "'>" . $row["ville"] . " </option>");
							}
						} else {
							echo "0 results";
						}

						mysqli_close($conn);
					?>
				</select><br/>
				
				<input type="text" name="codepostal" value="<?php echo $codepostal;?>" required>
				<input type="text" name="notelephone" value="<?php echo $telephone;?>" required>
				
				<p class="textNoir">Votre courriel servira à vous identifier lors de votre prochaine visite</p>
				<p class="textRouge">Le mot de passe doit avoir au moins 1 chiffre, 1 lettre, et 8 caractères minimum</p>
				
				<!-- Courriel -->
				<input type="email" name="mail" value="<?php echo $courriel;?>" required/>
				<input type="email" name="confirmermail" value="<?php echo $confirmercourriel;?>" required/><br/>
				
				<!-- Mot de passe -->
				<input type="password" name="password" value="<?php echo $motdepasse;?>" required/>
				<input type="password" name="confirmerpassword" value="<?php echo $motdepasse;?>" required/>
				<br/>
				
				<?php
					//verifer si infolettre est checked
					if ($infolettre == 1) {
						print_r("<input type='checkbox' name='infolettre' value='infolettre' checked> Souhaitez-vous recevoir les promotions et les nouveautés<br/>");
					} else {
						print_r("<input type='checkbox' name='infolettre' value='infolettre' > Souhaitez-vous recevoir les promotions et les nouveautés<br/>");
					}
				?>

				<!-- Confirmer -->
				<a href="#">
					<img src="../../images/icones/boutonConfirmer.png" class="button"/>
				</a>
				<br/>
				
			</fieldset>
		</form>
	</body>
	
	<footer>
	</footer>
	
</html>