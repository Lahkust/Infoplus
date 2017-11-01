<!-- /**************************************************************************************************/
/* Fichier ...................... : Panier.php */
/* Type ......................... : Document PHP */
/* Titre ........................ : Panier*/
/* Auteur ....................... : Guillaume Bergs */
/* Date de création ............. : 2017-11-01 */
/* Date de mise en ligne ........ : 2017-11-01 */
/* Date de mise à jour .......... : 2017-11-01 */
/*******************************************************************************************************/
/* Catalogue */
/*******************************************************************************************************/
-->


<!doctype HTML>
<html lang="fr">
<?php	 session_start();
require_once '../../Objects/Connection.php';
$dbh = db_connect();  ?>

<head>
    <meta charset="utf-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="../../styles/style.css"/>
    <script src="../../scripts/GestionPromotions.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>


    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

</head>

<header>
    <?php include_once '../Entete.php' ?>
</header>

<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
        </div>
        <div class="col-md-4 err404">
            La transaction a été annulée.
        </div>
        <div class="col-md-4">
        </div>
    </div>
</div>
</body>
<footer>
</footer>

</html>