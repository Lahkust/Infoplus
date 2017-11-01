<?php
/**************************************************************************************************/
/* Fichier ...................... : EnteteNonConnect.php */
/* Type ......................... : Document PHP */
/* Titre ........................ : Entête pour le site*/
/* Auteur ....................... : Christopher Brown */
/* Date de création ............. : 2017-08-21 */
/* Date de mise en ligne ........ : 2017-08-21 */
/* Date de mise à jour .......... : 2017-10-01 */
/*******************************************************************************************************/
/* Entête pour le site. L'entête change s'il y a un utilisateur, administrateur ou personne de connecté. */
/*******************************************************************************************************/

?>
<head>
	<link rel="stylesheet" href="../../styles/style.css">
</head>
<body>

	<div class="container-fluid backgroundEntete">
		<div class="row">
			<div class="col-md-4">
		
				<?php
				//Commence par vérifier si il a une variable administrateur
				if (isset($_SESSION['administrateur'])) {
					
					//si c'est un client
					if ($_SESSION['administrateur'] == 0) {
						?>				
						<img src="../../images/icones/logo.png" class="infoPlusPlus" Title="Info++"/>
						</div>
						<div class="col-md-8">
						<div class="row">
						
							<div class="col-md-4">
							</div>
							<div class="col-md-4">
								<a href="../clients/Panier.php" class="optionEnteteText align-middle">Mon panier (<?php echo count($_SESSION["panier"]); ?>)</a>
							</div>
							<div class="col-md-4">
								<a href="../communes/Logout.php" class="optionEnteteText align-middle">Se déconnecter</a>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<a href="../communes/Catalogue.php" class="optionRouge align-middle" >Catalogue</a>
							</div>
							<div class="col-md-4">
								<a href="../communes/Profil.php" class="optionOrange align-middle" >Profil</a>
							</div>	
							<div class="col-md-4 recherche">
								<img src="../../images/icones/loupe.png" Title="Rechercher"/>
							</div>			
						</div>

                            <?php
						//si c'est un admin
					} else {
					    ?>

						<img src="../../images/icones/logo.png" class="infoPlusPlus" Title="Info++"/>
						</div>
						<div class="col-md-8">
						<div class="row">
						
							<div class="col-md-4">
							</div>
							<div class="col-md-4">
							</div>
							<div class="col-md-4">
								<a href="../communes/Logout.php" class="optionEnteteText align-middle">Se déconnecter</a>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<a href="../communes/Catalogue.php" class="optionRouge align-middle" >Service</a>
							</div>
							<div class="col-md-4">
								<a href="../administrateurs/Facture.php" class="optionOrange align-middle" >Facture</a>
							</div>			
							<div class="col-md-4 recherche">
								<img src="../../images/icones/loupe.png" Title="Rechercher"/>
							</div>			
						</div>

                            <?php
					}
					//sinon un visiteur
				} else {
				    ?>

						<img src="images/icones/logo.png" class="infoPlusPlus" Title="Info++"/>
						</div>
						<div class="col-md-8">
						<div class="row">
										
							<div class="col-md-4">
							</div>
							<div class="col-md-4">
							</div>
							<div class="col-md-4">
								<a class="right optionEnteteText align-middle" href="../../index.php">S'identifier</a>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
							</div>
							<div class="col-md-4">
							</div>		

							<div class="col-md-4 recherche">
								<img src="images/icones/loupe.png" Title="Rechercher"/>
							</div>			
						</div>

                            <?php
				    }
				    ?>
		</div>
	</div>
</body>
</html>
