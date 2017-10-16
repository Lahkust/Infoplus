/* Fichier ...................... : GestionPromotions.js */
/* Type ......................... : Document JavaScript */
/* Titre ........................ : Gestion Promotions*/
/* Auteur ....................... : Guillaume Bergs */
/* Date de création ............. : 2017-08-27 */
/* Date de mise en ligne ........ : 2017-08-27 */
/* Date de mise à jour .......... : 2017-10-01 */
/*******************************************************************************************************************/
/* Code javascript de la page qui permet de lister toutes les promotions, en créer de nouvelles, 				   */
/* modifier les existantes et les appliquer en masse 															   */
/*******************************************************************************************************************/

function addPromo(ran)
{
	var insertLine = "<div class='row service_entry'>";
			insertLine += "<div class='col-md-6'>";
				insertLine += "<input type='text' class='form-control' name='titre_"+ran+"' >";
			insertLine += "</div>";
			insertLine += "<div class='col-md-5'>";
				insertLine += "<input type='text' class='form-control' name='rabais_"+ran+"'>";
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

function insertPromo()
{
	alert("BANANAS");
}

function modifyPromo(ran)
{
	var rabaisId = "#rabais_" + ran;
	var titreId = "#titre_" + ran;
	
	
	$( titreId ).prop('disabled', false);
	$( rabaisId ).prop('disabled', false);
	
}
