<!-- /**************************************************************************************************/
/* Fichier ...................... : Annulation.php */
/* Type ......................... : Document PHP */
/* Titre ........................ : Annulation*/
/* Auteur ....................... : Guillaume Bergs */
/* Date de création ............. : 2017-11-05 */
/* Date de mise en ligne ........ : 2017-11-05 */
/* Date de mise à jour .......... : 2017-11-05 */
/*******************************************************************************************************/
/* Erreur 404 */
/*******************************************************************************************************/
-->
<!doctype HTML>
<html lang="fr">
<?php	 session_start(); ?>

<head>
    <meta charset="utf-8">
    <title>Erreur 404</title>
    <link rel="stylesheet" href="../../styles/style.css"/>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</head>

<body>
<header>
    <?php include_once '../Entete.php' ?>
</header>

<div class="container-fluid">
    <div class="row">
    </div>
    <div class="row">
        <div class="col-md-4">
        </div>
        <div class="col-md-4 err404">
            Vous avez annulé la transaction!
        </div>
        <div class="col-md-4">
        </div>
    </div>
</div>

<footer>
</footer>
</body>