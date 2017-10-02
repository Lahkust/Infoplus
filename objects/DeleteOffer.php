<?php
/* Fichier ...................... : deleteOffer.php */
/* Type ......................... : Document PHP */
/* Titre ........................ : Delete Offer*/
/* Auteur ....................... : Guillaume Bergs */
/* Date de création ............. : 2017-10-01 */
/* Date de mise en ligne ........ : 2017-10-01 */
/* Date de mise à jour .......... : 2017-10-01 */
/*******************************************************************************************************************/
/* Permet de supprimer une offre (association entre un service et une promotion) 								   */
/*******************************************************************************************************************/


require_once 'Connection.php';
$dbh = db_connect();  


if(empty( $_POST['promoService']) == false)
	{	
		//il existe. vérifier s'il est valide
		foreach($dbh->query('SELECT * FROM ta_promotion_service WHERE pk_promotion_service = ' . $_POST['promoService']) as $row)
		{
			//il est valide.
			$serviceExiste = true;
			
			//statement
			$sql = "UPDATE ta_promotion_service SET code='DELETE'";
			//var_dump($sql);
			// Preparer le statement
			$stmt = $dbh->prepare($sql);

			// exécuter la requête
			$stmt->execute();
		}
		
	}
	
?>