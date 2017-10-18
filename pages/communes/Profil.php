<!-- /**************************************************************************************************/
/* Fichier ...................... : Profil.php */
/* Type ......................... : Document PHP */
/* Titre ........................ : Profil*/
/* Auteur ....................... : Christopher Brown */
/* Date de création ............. : 2017-08-30 */
/* Date de mise en ligne ........ : 2017-08-30 */
/* Date de mise à jour .......... : 2017-10-01 */
/*******************************************************************************************************/
/* Inscription ou modification du profil pour un utilisateur */
/*******************************************************************************************************/
Todo : validation form; critère mot de passe; update profil; changer css avec bootstrap
-->
<?php
	require_once '../../Objects/Connection.php';
	session_start();
	
	$nom="";
	$prenom="";
	$nocivic="";
	$rue="";
	$ville="";
	$codepostal="";
	$telephone="";
	$courriel="";
	$motdepasse="";
	$infolettre = "";
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
			
			try {
				$utilisateur = $_SESSION['pk_utilisateur'];
				$dbh = db_connect();
				$stmt = $dbh->prepare('select * from utilisateur a join client b on a.pk_utilisateur=b.fk_utilisateur join adresse c on b.fk_adresse=c.pk_adresse 
					join ville d on c.fk_ville=d.pk_ville where a.pk_utilisateur= :pk_utilisateur ');
				$stmt->execute(['pk_utilisateur' => $utilisateur]);
				$profil = $stmt->fetch();

				if (is_array($profil)) {
					$nom = $profil['nom'];
					$prenom = $profil['prenom'];
					$nocivic = $profil['no_civique'];
					$rue = $profil['rue'];
					$ville = $profil['ville'];
					$pk_ville = $profil['pk_ville'];
					$codepostal = $profil['code_postal'];
					$telephone = $profil['telephone'];
					$courriel = $profil['courriel'];
					$confirmercourriel = $profil['courriel'];
					$motdepasse = $profil['mot_de_passe'];
					$infolettre = $profil['infolettre'];
				} 
				
				$dbh = null;
			} catch (PDOException $e) {
				print "Error!: " . $e->getMessage() . "<br/>";
				die();
			}
		}
		?>
		<div class="center">
			<form name="profil" class="borderForm" method="post" action = "" enctype="multipart/form-data">
				
				<div class="row">
					<div class="textNoir col-12">Remplissez ce formulaire pour créer votre profil</div>
				</div>
				<div class="row">
					<div class="textRouge col-12">Tous les champs sont obligatoires</div>
				</div>	
					<input type="text" name="nom" placeholder="Nom" echo <?php echo "value='" . $nom . "'";?> required>
					<input type="text" name="prenom" placeholder="Prénom" value="" required><br/>
					
					<input class="rue" type="text" name="no_civique" placeholder="No civique" value="" required>
					<input class="adresse" type="text" name="rue" placeholder="Rue" value="" required>
					
					<select name="ville" required>
						<option value="" disabled selected>Ville</option>
						<?php
							//Chercher les villes
							try {
								$dbh = db_connect();
								$stmt = $dbh->query('SELECT * FROM ville');
								
								foreach($stmt as $row) {
									//Sélectionner la ville l'utilisateur
									if($row['ville'] == $ville) {
										echo "<option value='". $row["pk_ville"] . "' Selected>" . $row["ville"] . " </option>";
									} else {
										echo "<option value='". $row["pk_ville"] . "'>" . $row["ville"] . " </option>";
									}
								}
								
								$dbh = null;
							} catch (PDOException $e) {
								print "Error!: " . $e->getMessage() . "<br/>";
								die();
							}					
						?>
					</select><br/>
					
					<input type="text" name="code_postal" id="code_postal" placeholder="Code postal" value="" onblur="Valider('code_postal')" required>
					<input type="text" name="telephone" id="telephone" placeholder="Téléphone" value="" onblur="Valider('telephone')" required>
					<br/>
					<div class="textNoir"><br/>Votre courriel servira à vous identifier lors de votre prochaine visite</div>
					<div class="textRouge">Le mot de passe doit avoir au moins 1 chiffre, 1 lettre, et 8 caractères minimum</div>
					
					<!-- Courriel -->
					<input type="email" name="courriel" id="courriel" placeholder="Courriel" value="" onblur="Valider('courriel')" required/>
					<input type="email" name="courriel2" id="courriel2" placeholder="Confirmer Courriel" value="" onblur="Valider('courriel2')" required/><br/>
					
					<!-- Mot de passe -->
					<input type="password" name="mot_de_passe" placeholder="Mot de passe" value="" required/>
					<input type="password" name="mot_de_passe2" placeholder="Confirmer mot de passe" value="" onblur="verifierPassword()" required/>
					<br/>
					
					<?php
						//verifer si infolettre est checked
						if ($infolettre == 1) {
							print_r("<div class='textBleu'><input type='checkbox' name='infolettre' value='1' checked> Souhaitez-vous recevoir les promotions et les nouveautés</div>");
						} else {
							print_r("<div class='textBleu'><input type='checkbox' name='infolettre' value='0' > Souhaitez-vous recevoir les promotions et les nouveautés</div>");
						}
					?>

					<!-- Submit -->
					<input type="image" src="../../images/icones/boutonConfirmer.png" class="imgButton confirmer" title="Confirmer" alt="Confirmer" onclick="return verifyPassEmail();"/>
					<br/>
					
					<?php
					//Inscrire ou modifier le profil d'un utilisateur
					if ($_SERVER["REQUEST_METHOD"] == "POST") {
						//Vérifie si le email est rempli
						//if(isset($_POST['courriel']) && !empty($_POST['courriel'])){
							
							$no_civique = $_POST["no_civique"];
							$rue = $_POST["rue"];
							$ville = $_POST["ville"];
							$code_postal = $_POST["code_postal"];
							$courriel = $_POST["courriel"];
							$mot_de_passe = $_POST["mot_de_passe"];
							$nom = $_POST["nom"];
							$prenom = $_POST["prenom"];
							$telephone = $_POST["telephone"];
							$infolettre = $_POST["infolettre"];
							
							try{
								$dbh = db_connect();
								
								//Verifier pour meme courriel
								foreach($dbh->query('SELECT * from utilisateur') as $row) {
									if(($row["courriel"]==$_POST["courriel"]))
									{
										 echo '<script type="text/javascript">';
										 echo 'alert("Le courriel est déja utilisé");';
										 echo '</script>';
										 
										 break;
									} 
								}
									
								if (isset($_SESSION['pk_utilisateur'])) {
								//Modifier le profil
									
									
								} else {
									//Inscrire le nouveau profil dans la base de données
									try {
										$sql1 = 'INSERT INTO `adresse` (`no_civique`, `rue`, `fk_ville`, `code_postal`) 
										VALUES (:no_civique, :rue, :ville, :code_postal);';
										
										$sql2 = 'INSERT INTO utilisateur (courriel, mot_de_passe, administrateur) 
										VALUES (:courriel, :mot_de_passe, "0");';
										
										$sql3 = 'INSERT INTO client (fk_utilisateur, prenom, nom, fk_adresse, telephone, infolettre) 
										VALUES ((SELECT pk_utilisateur FROM utilisateur WHERE courriel=:courriel2), :prenom, :nom,
										(SELECT pk_adresse FROM adresse WHERE rue=:rue2), :telephone, :infolettre);';

										$dbh->beginTransaction();
										$stmt1 = $dbh->prepare($sql1);
										$stmt1->execute(['no_civique' => $no_civique, 'rue' => $rue, 'ville' => $ville,
											'code_postal' => $code_postal]);
										
										$stmt2 = $dbh->prepare($sql2);
										$stmt2->execute(['courriel' => $courriel, 'mot_de_passe' => $mot_de_passe]);
										
										$stmt3 = $dbh->prepare($sql3);
										$stmt3->execute(['courriel2' => $courriel, 'prenom' => $prenom, 'nom' => $nom, 'rue2' => $rue,
										'telephone' => $telephone, 'infolettre' => $infolettre]);
										
										$dbh->commit();
										
										//Message de succès
										echo '<script type="text/javascript">';
										echo 'alert("Profil inscrit!");';
										echo '</script>';
										
										header("location: pages/communes/Catalogue.php");
										
									}catch (Exception $e){
										$dbh->rollback();
										throw $e;
									}
								}
								
								$dbh = null;
							} catch (PDOException $e) {
								print "Error!: " . $e->getMessage() . "<br/>";
								die();
							}
						//}							
					}
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
					case "code_postal":
						if(!/^[a-z][0-9][a-z](\s|-)?[0-9][a-z][0-9]$/i.test(document.profil.codepostal.value)) {
							alert('Erreur code postal : A9A 9A9 | A9A-9A9 | A9A9A9');
							setTimeout(function(){ 
							document.profil.codepostal.focus();
							}, 0001);
						}
						break;
					case "courriel":
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
				if (document.profil.courriel.value != document.profil.courriel2.value ) {
					alert("Courriel différent");
					return false;
				} else if (document.profil.mot_de_passe.value != document.profil.mot_de_passe2.value) {
					alert("Mot de passe différent");
					return false;
				} else {
					return true;
				}
			}
			
			//verifier le mot de passe -> a faire
		
		</script>
	
		<footer>
		</footer>
	</body>
</html>