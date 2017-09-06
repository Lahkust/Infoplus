<!-- /**************************************************************************************************/
/* Fichier ...................... : Inscription.php */
/* Type ......................... : Document PHP */
/* Titre ........................ : Inscription*/
/* Auteur ....................... : Christopher Brown */
/* Date de création ............. : 2017-08-30 */
/* Date de mise en ligne ........ : 2017-08-30 */
/* Date de mise à jour .......... : 2017-08-30 */
/*******************************************************************************************************/
/* Inscription pour un utilisateur */
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
?>
<!doctype html>
<html lang="fr">
	
	<head>
		<meta charset="utf-8">
		<title>Connexion</title>
		<link rel="stylesheet" href="../../styles/style.css"/>
	</head>
	
	<header>
		<?php include_once '../Entete.php' ?>
	</header>
	
	<body>
		<?php if (isset($_SESSION['administrateur'])) { ?>
		
				<?php
					$sql = "SELECT ville FROM ville";
					$result = mysqli_query($conn, $sql);

					if (mysqli_num_rows($result) > 0) {
						// output data of each row
						while($row = mysqli_fetch_assoc($result)) {
							print_r("<option value='". $row["ville"] . "'>" . $row["ville"]. "</option>");
						}
					} else {
						echo "0 results";
					}

					mysqli_close($conn);
				?>
				<form method="post" action="cible.php" enctype="multipart/form-data">
					<fieldset>	
						<p>
							Remplissez ce formulaire pour créer votre profil
							Tous les champs sont obligatoires
						</p>
					
						<input type="text" name="nom" value="<?php echo $nom;?>" required>
						<input type="text" name="prenom" value="Prénom" required><br/>
						
						<input type="text" name="nocivic" value="No civic" required>
						<input type="text" name="rue" value="Rue" required>
						<select name="ville" value="Ville" required>
							<option value="Test"</option>
						</select><br/>
						
						<input type="text" name="codepostal" value="Code Postal" required>
						<input type="text" name="notelephone" value="Numéro de téléphone" required>
						
						<p>
							Votre courriel servira à vous identifier lors de votre prochaine visite
							Le mot de passe doit avoir au moins 1 chiffre, 1 lettre, et 8 caractères minimum
						</p>
						<!-- Courriel -->
						<input type="email" name="mail" value="Courriel" required/>
						<input type="email" name="confirmermail" value="Confirmer Courriel" required/><br/>
						
						<!-- Mot de passe -->
						<input type="password" name="password" value="Mot de passe" required/>
						<input type="password" name="confirmerpassword" value="Confirmer Mot de passe" required/>
						<br/>
						
						<input type="checkbox" name="infolettre" value="infolettre" checked> Souhaitez-vous recevoir les promotions et les nouveautés<br>
						
						<!-- Confirmer -->
						<a href="#">
							<img src="../../images/icones/boutonConfirmer.png" class="button"/>
						</a>
						<br/>
						
					</fieldset>
				</form>
			<?php } else {
				?>
				<form method="post" action="cible.php" enctype="multipart/form-data">
					<fieldset>
						<p>
							Remplissez ce formulaire pour créer votre profil
							Tous les champs sont obligatoires
						</p>
						<input type="text" name="nom" value="Nom" required>
						<input type="text" name="prenom" value="Prénom" required><br/>
						
						<input type="text" name="nocivic" value="No civic" required>
						<input type="text" name="rue" value="Rue" required>
						<select name="ville" value="Ville" required>
							<?php
								$sql = "SELECT ville FROM ville";
								$result = mysqli_query($conn, $sql);

								if (mysqli_num_rows($result) > 0) {
									// output data of each row
									while($row = mysqli_fetch_assoc($result)) {
										print_r("<option value='". $row["ville"] . "'>" . $row["ville"]. "</option>");
									}
								} else {
									echo "0 results";
								}

								mysqli_close($conn);
							?>
						</select><br/>
						
						<input type="text" name="codepostal" value="Code Postal" required>
						<input type="text" name="notelephone" value="Numéro de téléphone" required>
						
						<p>
							Votre courriel servira à vous identifier lors de votre prochaine visite
							Le mot de passe doit avoir au moins 1 chiffre, 1 lettre, et 8 caractères minimum
						</p>
						<!-- Courriel -->
						<input type="email" name="mail" value="Courriel" required/>
						<input type="email" name="confirmermail" value="Confirmer Courriel" required/><br/>
						
						<!-- Mot de passe -->
						<input type="password" name="password" value="Mot de passe" required/>
						<input type="password" name="confirmerpassword" value="Confirmer Mot de passe" required/>
						<br/>
						
						<input type="checkbox" name="infolettre" value="infolettre" checked> Souhaitez-vous recevoir les promotions et les nouveautés<br>
						
						<!-- Confirmer -->
						<a href="#">
							<img src="../../images/icones/boutonConfirmer.png" class="button"/>
						</a>
						<br/>
						
					</fieldset>
				</form>
			<?php } ?>
	</body>
	
	<footer>
	</footer>
	
</html>