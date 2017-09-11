<!-- /**************************************************************************************************/
/* Fichier ...................... : Logout.php */
/* Type ......................... : Document PHP */
/* Titre ........................ : Logout*/
/* Auteur ....................... : Christopher */
/* Date de création ............. : 2017-08-28 */
/* Date de mise en ligne ........ : 2017-08-28 */
/* Date de mise à jour .......... : 2017-08-28 */
/*******************************************************************************************************/
/* Logout */
/*******************************************************************************************************/
-->
<?php
session_start();
unset($_SESSION['administrateur']);
// On détruit les variables de notre session
session_unset ();
// On détruit notre session
session_destroy ();
// On redirige le visiteur vers la page d'accueil
header ('location: ../../index.php');
die();
?>