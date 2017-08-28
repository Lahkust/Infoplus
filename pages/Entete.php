<!-- /**************************************************************************************************/
/* Fichier ...................... : EnteteNonConnect.php */
/* Type ......................... : Document PHP */
/* Titre ........................ : Entête pour le site*/
/* Auteur ....................... : Christopher Brown */
/* Date de création ............. : 2017-08-21 */
/* Date de mise en ligne ........ : 2017-08-21 */
/* Date de mise à jour .......... : 2017-08-28 */
/*******************************************************************************************************/
/* Entête pour le site. L'entête change s'il y a un utilisateur, administrateur ou personne de connecté. */
/*******************************************************************************************************/
-->
<?php
	session_start (); 
?>
<!DOCTYPE HTML>
<html lang="fr">
<head>
	<link rel="stylesheet" href="../../styles/style.css">
</head>
<body>
	<div class="backgroundEntete">
		<img src="../../images/icones/logo.png" class="infoPlusPlus" Title="Info++"/>
		<?php
		
		$_SESSION['administrateur'] = '1';
		
		if (isset($_SESSION['administrateur'])) {
			
			if ($_SESSION['administrateur'] == 0) {
				?>
				<div class="optionEntete">
					<a href="./communes/Erreur404.php" class="optionEnteteText">Mon panier (1)</a>
					<a href="./Logout.php" class="optionEnteteText">Se déconnecter</a>
				</div>
				<div class="optionEnteteClient">
					<a href="" class="optionRouge" >Catalogue</a>
					<a href="" class="optionOrange" >Profil</a>
					
						<input type="text" name="recherche" >
						<img src="../../images/icones/loupe.png" Title="Rechercher"/>
					
				</div>
				<?php
			} else {
				?>
				<div class="optionEntete">
					<a href="./Logout.php" class="optionEnteteText">Se déconnecter</a>
				</div>
				<div class="optionEnteteClient">
					<a href="" class="optionRouge" >Service</a>
					<a href="" class="optionOrange" >Facture</a>	
					<input type="text" name="recherche" >
					<img src="../../images/icones/loupe.png" Title="Rechercher"/>
				</div>
				<?php
			}
		} else {
			 ?><a class="optionUtilsiateur" href="">S'identifier</a><?php
		}
		?>
	</div>
</body>
</html>