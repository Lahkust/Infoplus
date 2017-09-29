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
	<body>
		<header>
			<?php include_once '../Entete.php' ?>
		</header>
	
		<!--Verifie s'il y a un utilisateur de connecte-->
		<?php if (isset($_SESSION['pk_utilisateur'])) { 
			
			$sql = "select * from utilisateur a join client b on a.pk_utilisateur=b.fk_utilisateur join adresse c on b.fk_adresse=c.pk_adresse 
				join ville d on c.fk_ville=d.pk_ville where a.pk_utilisateur= " . $_SESSION['pk_utilisateur'] . "";
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
		<div class="center">
			<form name="profil" class="borderForm" method="post">
				
				<div class="row">
					<div class="textNoir col-12">Remplissez ce formulaire pour créer votre profil</div>
				</div>
				<div class="row">
					<div class="textRouge col-12">Tous les champs sont obligatoires</div>
				</div>	
					<input type="text" name="nom" placeholder="Nom" value="<?php echo $nom;?>" required>
					<input type="text" name="prenom" placeholder="Prénom" value="<?php echo $prenom;?>" required><br/>
					
					<input class="rue" type="text" name="nocivic" placeholder="No civique" value="<?php echo $nocivic;?>" required>
					<input class="adresse" type="text" name="rue" placeholder="Rue" value="<?php echo $rue;?>" required>
					
					<select name="ville" required>
						<option value="" disabled selected>Ville</option>
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
									if($row['ville'] == $ville) {
										print_r("<option value='". $row["ville"] . "' Selected>" . $row["ville"] . " </option>");
									} else {
										print_r("<option value='". $row["ville"] . "'>" . $row["ville"] . " </option>");
									}
								}
							} else {
								echo "0 results";
							}

							mysqli_close($conn);
						?>
					</select><br/>
					
					<input type="text" name="codepostal" id="codepostal" placeholder="Code postal" value="<?php echo $codepostal;?>" onblur="Valider('codepostal')" required>
					<input type="text" name="telephone" id="telephone" placeholder="Téléphone" value="<?php echo $telephone;?>" onblur="Valider('telephone')" required>
					<br/>
					<div class="textNoir"><br/>Votre courriel servira à vous identifier lors de votre prochaine visite</div>
					<div class="textRouge">Le mot de passe doit avoir au moins 1 chiffre, 1 lettre, et 8 caractères minimum</div>
					
					<!-- Courriel -->
					<input type="email" name="courriel1" id="courriel1" placeholder="Courriel" value="<?php echo $courriel;?>" onblur="Valider('courriel1')" required/>
					<input type="email" name="courriel2" id="courriel2" placeholder="Confirmer Courriel" value="<?php echo $confirmercourriel;?>" onblur="Valider('courriel2')" required/><br/>
					
					<!-- Mot de passe -->
					<input type="password" name="password1" placeholder="Mot de passe" value="<?php echo $motdepasse;?>" required/>
					<input type="password" name="password2" placeholder="Confirmer mot de passe" value="<?php echo $motdepasse;?>" onblur="verifierPassword()" required/>
					<br/>
					
					<?php
						//verifer si infolettre est checked
						if ($infolettre == 1) {
							print_r("<div class='textBleu'><input type='checkbox' name='infolettre' value='infolettre' checked> Souhaitez-vous recevoir les promotions et les nouveautés</div>");
						} else {
							print_r("<div class='textBleu'><input type='checkbox' name='infolettre' value='infolettre' > Souhaitez-vous recevoir les promotions et les nouveautés</div>");
						}
					?>

					<!-- Confirmer -->
					<a href="#" onclick="return verifyPassEmail();">
						<img src="../../images/icones/boutonConfirmer.png" class="imgButton confirmer" title="Confirmer" alt="Confirmer"/>
					</a>
					<br/>
					
					<?php
					/*if ($_SERVER["REQUEST_METHOD"] == "POST") {
						if(isset($_POST['email']) && !empty($_POST['email'])){
							try{
								$dbh = new PDO('mysql:host=localhost;dbname=infoplus', 'root', '');
								if (isset($_SESSION['pk_utilisateur'])) {
									//profil
									foreach($dbh->query('SELECT * from utilisateur') as $row) {
										if(($row["courriel"]==$_POST["courriel1"]))
										{
											 echo '<script type="text/javascript">';
											 echo 'alert("Le courriel est déja utilisé");';
											 echo '</script>';
											 //break
										} 
									}
									//update profil
									
									
								} else {
									//inscrire nouveau profil dans la base de données
									$sql = '';
									if ($dbh->query($sql) === true) {
										echo "Utilisateur inscrit";
									} 
								}
								
								$dbh = null;
							} catch (PDOException $e) {
								print "Error!: " . $e->getMessage() . "<br/>";
								die();
							}
							
						}							
					}*/
					?>
				
			</form>
		</div>
		
		<script type="text/javascript">
			//Vérifier user input
			function Valider(input) {	
				switch(input) {
					case "telephone":
						if(!/^(\(?)([0-9]{0,3})(\)?)(\.|\s|-)([0-9]{3})(\.|\s|-)([0-9]{4})$/.test(document.profil.telephone.value)) {
							alert('Erreur téléphone : (999) 999-9999 | (999)999-9999 | (999) 999.9999 | (999)999.9999 | 999.999.9999 | 999-999-9999 | 999.9999 | 999-9999');
							setTimeout(function(){ 
							document.profil.telephone.focus(); 
							}, 0001);
						}
						break;
					case "codepostal":
						if(!/^[a-z][0-9][a-z](\s|-)?[0-9][a-z][0-9]$/i.test(document.profil.codepostal.value)) {
							alert('Erreur code postal : A9A 9A9 | A9A-9A9 | A9A9A9');
							setTimeout(function(){ 
							document.profil.codepostal.focus();
							}, 0001);
						}
						break;
					case "courriel1":
						if(!/^([a-z0-9._-]+)@([a-z0-9._-]+)\.([a-z]{2,6})$/i.test(document.profil.courriel1.value)) {
							alert('Erreur courriel : compte@domaine.ext | compte@255.255.255.0');	
							setTimeout(function(){ 
							document.profil.courriel1.focus(); 
							}, 0001);
						}
						break;
					case "courriel2":
						if(!/^([a-z0-9._-]+)@([a-z0-9._-]+)\.([a-z]{2,6})$/i.test(document.profil.courriel2.value)) {
							alert('Erreur courriel : compte@domaine.ext | compte@255.255.255.0');	
							setTimeout(function(){ 
							document.profil.courriel2.focus(); 
							}, 0001);
						}
						break;
				}
			}
			
			//Vérifier les deux email et les deux passsword
			function verifyPassEmail() {
				if (document.profil.courriel1.value != document.profil.courriel2.value ) {
					alert("Courriel différent");
					return false;
				} else if (document.profil.password1.value != document.profil.password2.value) {
					alert("Mot de passe différent");
					return false;
				} else {
					return true;
				}
			}
		
		</script>
	
		<footer>
		</footer>
	</body>
</html>