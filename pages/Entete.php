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
		<img src="../../images/icones/logo.png" class="infoPlusPlus col-3" Title="Info++"/>
		<?php
		
		//Commence par vérifier si il a une variable administrateur
		if (isset($_SESSION['administrateur'])) {
			
			//si c'est un client
			if ($_SESSION['administrateur'] == 0) {
				?>
				<div class="row 3">
					<div class="optionEntete col-6">
						<a href="../communes/Erreur404.php" class="optionEnteteText">Mon panier (1)</a>
						<a href="../communes/Logout.php" class="optionEnteteText">Se déconnecter</a>
					</div>
					<div class="optionEnteteClient col-6">
						<a href="" class="optionRouge" >Catalogue</a>
						<a href="../communes/Profil.php" class="optionOrange" >Profil</a>
						
						<input type="text" name="recherche" >
						<img src="../../images/icones/loupe.png" Title="Rechercher"/>
						
					</div>
				</div>
				<?php
				//si c'est un admin
			} else {
				?>
				<div class="optionEntete">
					<a href="../communes/Logout.php" class="optionEnteteText">Se déconnecter</a>
				</div>
				<div class="optionEnteteClient">
					<a href="" class="optionRouge" >Service</a>
					<a href="" class="optionOrange" >Facture</a>	
					<input type="text" name="recherche" >
					<img src="../../images/icones/loupe.png" Title="Rechercher"/>
				</div>
				<?php
			}
			//sinon un visiteur
		} else { ?>
			<div class="col-7"></div>
			<a class="col-2" href="../../index.php">S'identifier</a><?php
		}
		?>
	</div>
</body>
</html>