<!-- /**************************************************************************************************/
/* Fichier ...................... : EnteteNonConnect.php */
/* Type ......................... : Document PHP */
/* Titre ........................ : Entête pour le site*/
/* Auteur ....................... : Christopher Brown */
/* Date de création ............. : 2017-08-21 */
/* Date de mise en ligne ........ : 2017-08-21 */
/* Date de mise à jour .......... : 2017-09-10 */
/*******************************************************************************************************/
/* Entête pour le site. L'entête change s'il y a un utilisateur, administrateur ou personne de connecté. */
/*******************************************************************************************************/
-->
<!DOCTYPE HTML>
<html lang="fr">

<head>
	<link rel="stylesheet" href="../../styles/style.css">
</head>
<body>
	<div class="backgroundEntete">
		<img src="../../images/icones/logo.png" class="infoPlusPlus" Title="Info++"/>
		<?php
		
		//Commence par vérifier si il a une variable administrateur
		if (isset($_SESSION['administrateur'])) {
			
			//si c'est un client
			if ($_SESSION['administrateur'] == 0) {
				?>
				<div class="right col-3">
					<div class="row">
						<a href="../communes/Erreur404.php" class="optionEnteteText col-6">Mon panier (1)</a>
						<a href="../communes/Logout.php" class="optionEnteteText col-6">Se déconnecter</a>
					</div>
				</div>
				<div class="row">
					<a href="./Catalogue.php" class="optionRouge col-1" >Catalogue</a>
					<a href="../communes/Profil.php" class="optionOrange col-1" >Profil</a>
					<div class="col-3">
						<input type="text" name="recherche" >
						<img src="../../images/icones/loupe.png" Title="Rechercher"/>
					<div>
				</div>
				
				<?php
				//si c'est un admin
			} else {
				?>
				<a  class="optionEnteteText right col-1" href="../communes/Logout.php" class="optionEnteteText">Se déconnecter</a>
					
				<div class="row">
					<a href="./Catalogue.php" class="optionRouge col-1" >Service</a>
					<a href="../communes/Erreur404.php" class="optionOrange col-1" >Facture</a>
					<div class="col-2">
						<input type="text" name="recherche" >
						<img src="../../images/icones/loupe.png" Title="Rechercher"/>
					</div>
				</div>
					
				<?php
			}
			//sinon un visiteur
		} else { ?>
			<a class="right col-1 optionEnteteText" href="../../index.php">S'identifier</a><?php
		}
		?>
	</div>
</body>
</html>