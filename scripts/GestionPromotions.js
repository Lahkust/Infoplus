/* Fichier ...................... : GestionPromotions.js */
/* Type ......................... : Document JavaScript */
/* Titre ........................ : Gestion Promotions*/
/* Auteur ....................... : Guillaume Bergs */
/* Date de création ............. : 2017-08-27 */
/* Date de mise en ligne ........ : 2017-08-27 */
/* Date de mise à jour .......... : 2017-09-27 */
/*******************************************************************************************************************/
/* Code javascript de la page qui permet de lister toutes les promotions, en créer de nouvelles, 				   */
/* modifier les existantes et les appliquer en masse 															   */
/*******************************************************************************************************************/


function addPromo()
{
	var insertLine = "<div class='row service_entry'>";
			insertLine += "<div class='col-md-6'>";
				insertLine += "<input type='text' class='form-control' id='usr'>";			insertLine += "</div>";
			insertLine += "<div class='col-md-5'>";
				insertLine += "<input type='text' class='form-control' id='usr'>";
			insertLine += "</div>";
			insertLine += "<div class='col-md-1'>";
			insertLine += "</div>";
		insertLine += "</div>";
	
    $secondLast = $('#btnConfirm').prev();
	$( insertLine ).insertAfter( $secondLast );
	return false;
}

function updateDB()
{
	alert("BANANAS");
}