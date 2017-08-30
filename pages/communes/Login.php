<!-- /**************************************************************************************************/
/* Fichier ...................... : Login.php */
/* Type ......................... : Document PHP */
/* Titre ........................ : Login*/
/* Auteur ....................... : Guillaume Bergs */
/* Date de création ............. : 2017-08-21 */
/* Date de mise en ligne ........ : 2017-08-21 */
/* Date de mise à jour .......... : 2017-08-30 */
/*******************************************************************************************************/
/* Login */
/*******************************************************************************************************/
-->
<!doctype html>

<?php
   define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', '');
   define('DB_DATABASE', 'infoplus');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $dbh = new PDO('mysql:host=localhost;dbname=infoplus', 'root', '');
	  $is_admin=0;
	  $is_in_db = false;
	  foreach($dbh->query('SELECT * from utilisateur') as $row)
	  {
		  if(($row["courriel"]==$_POST["mail"])&&($row["mot_de_passe"])==$_POST["password"])
		{
			$is_in_db = true;
			$is_admin = $row["administrateur"];
		}
	  }
		
      if($is_in_db) {
         $_SESSION['mail'] = $mymail;
		 $_SESSION['administrateur'] = $is_admin;
         header("location: ../clients/Catalogue.php");
      }else {
         echo "<script type='text/javascript'>alert('Courriel ou mot de passe invalide!')</script>";
      }
   }
?>

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
		
		<form method="post"  action = "" enctype="multipart/form-data">
			<!-- Intitulé -->
			<p>
				Veuillez-vous identifier pour avoir la possibilité d'acheter des formations.
			</p>
			<!-- Courriel -->
			<label>Courriel  :</label><input type = "text" name = "mail" class = "box" required/>
			</br>
			<!-- Mot de passe -->
			<label>Mot de passe  :</label><input type = "password" name = "password" class = "box" required/>
			</br>
			<!-- Mot de passe oublié -->
			<a href="http://www.perdu.com">Mot de passe oublié<a>
			</br>
			<!-- Connexion -->
			<input type = "submit" value = " Submit ">
				<img src="../../images/icones/boutonConnexion.png" class="button"/>
			</input>
			</br>
			<!-- S'inscrire -->
			<a href="../clients/Inscription.php">
				<img src="../../images/icones/boutonInscription.png" class="button"/>
			</a>
			</br>
			<!-- Connexion avec Facebook -->
			<a href="http://www.perdu.com">
				<img src="../../images/icones/facebook.png" class="button"/>
			</a>
			</br>
		</form>

	</body>
	
	<footer>
	</footer>
	
</html>