<!-- /**************************************************************************************************/
/* Fichier ...................... : Connection.php */
/* Type ......................... : Document PHP */
/* Titre ........................ : Connection*/
/* Auteur ....................... : Christopher Brown */
/* Date de création ............. : 2017-09-28 */
/* Date de mise en ligne ........ : 2017-09-28 */
/* Date de mise à jour .......... : 2017-09-28 */
/*******************************************************************************************************/
/* Connection à la BD */
/*******************************************************************************************************/
-->
<?php
	//Ouvrir la connection à la BD
	function db_connect(){
		$host = 'localhost';
		$db   = 'infoplus';
		$user = 'root';
		$pass = '';
		$charset = 'utf8';

		$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
		$opt = [
			PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			PDO::ATTR_EMULATE_PREPARES   => false,
		];
		$pdo = new PDO($dsn, $user, $pass, $opt);

		return $pdo;
	}
	
	//Pour fermer la connection mettre les variables a null.
	//Ex : $pdo = null;
	
	//Documentation au complet -> https://phpdelusions.net/pdo#mysqlnd
?>