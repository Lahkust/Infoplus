<!-- /**************************************************************************************************/
/* Fichier ...................... : EnteteNonConnect.php */
/* Type ......................... : Document PHP */
/* Titre ........................ : Entête utilisateur non connecté*/
/* Auteur ....................... : Christopher Brown */
/* Date de création ............. : 2017-08-21 */
/* Date de mise en ligne ........ : 2017-08-21 */
/* Date de mise à jour .......... : 2017-08-23 */
/*******************************************************************************************************/
/* Entête utilisateur non connecté */
/*******************************************************************************************************/
-->
<!DOCTYPE HTML>
<html lang="fr">
<head>
	<link rel="stylesheet" href="../../styles/style.css">
</head>
<div class="backgroundEntete">
	<img src="../../images/icones/logo.png" class="infoPlusPlus" Title="Info++"/>
	<?php

	if (isset($_GET['client'])) {
	echo "Tu es un client";
	?>
	<div class="optionEntete">
		<a href="" class="optionEnteteText">Mon panier (1)</a>
		<a href="" class="optionEnteteText">Se déconnecter</a>
	</div>
	<div class="optionEnteteClient">
		<a href="" class="optionRouge" >Catalogue</a>
		<a href="" class="optionOrange" >Profil</a>
		Recherche
	</div>
	<form>
		 <input type="text" name="recherche" >
		 <img src="../../images/icones/loupe.png" Title="Rechercher"/>
	</form>
	<?php
	/*} else if (isset($_GET['admin'])) {
		echo "Tu es un admin";
		 
	} else {
		echo "Qui es-tu?"
		 ?><a class="optionUtilsiateur" href="">S'identifier</a><?php
	}*/
	?>
</div>
</html>