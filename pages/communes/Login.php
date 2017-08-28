<!-- /**************************************************************************************************/
/* Fichier ...................... : Login.php */
/* Type ......................... : Document PHP */
/* Titre ........................ : Login*/
/* Auteur ....................... : Guillaume Bergs */
/* Date de création ............. : 2017-08-21 */
/* Date de mise en ligne ........ : 2017-08-21 */
/* Date de mise à jour .......... : 2017-08-28 */
/*******************************************************************************************************/
/* Login */
/*******************************************************************************************************/
-->
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
		
		<form method="post" action="cible.php" enctype="multipart/form-data">
		<!-- Intitulé -->
		<p>
			Veuillez-vous identifier pour avoir la possibilité d'acheter des formations.
		</p>
		<!-- Courriel -->
		<input type="email" name="mail" value="Courriel" required/>
		</br>
		<!-- Mot de passe -->
		<input type="password" name="password" value="Mot de passe" required/>
		</br>
		<!-- Mot de passe oublié -->
		<a href="http://www.perdu.com">Mot de passe oublié<a>
		</br>
		<!-- Connexion -->
		<a href="http://www.perdu.com">
			<img src="../../images/icones/boutonConnexion.png" class="button"/>
		</a>
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