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
<?php	 session_start();
require_once '../../Objects/Connection.php';
$dbh = db_connect();

?>

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
        <div class="col-md-4"></div>
        <div class="col-md-4 merci">Merci pour votre achat!</div>
        <div class="col-md-4"></div>
    </div>

    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4 merci">Voici le résumé de votre commande:</div>
        <div class="col-md-4"></div>
    </div>

    <div class="row">
        <hr/>
    </div>

    <?php
    $sousTotal = 0;
    $rabaisTotal = 0;
    $promoAdditionnelle = 0;
    $id_service_panier_tableau = 0;
    try {
    foreach($_SESSION["panier"] as $id_service_panier)
    foreach($dbh->query('SELECT * from service WHERE pk_service = '.$id_service_panier) as $row) {
    ?>
    <div class='row'>

        <div class='col-1'></div>

        <div class='col-10'>

            <!-- articles -->
            <div class='row'>

                <div class='col-3'>

                </div>

                <div class='col-9'>

                    <div class='row'>
                        <div class='col-6'>
                            <?php print_r("<div class='service_title'>" . $row["service_titre"]. "</div><br/>"); ?>
                        </div>
                        <div class='col-3'></div>
                        <div class="col-3"><?php print_r("<div class='service_price'>" . $row["tarif"]. "$</div><br/>"); ?></div>
                        <?php $sousTotal += $row["tarif"]?>
                    </div>
                    <?php
                    $promos;
                    //modifier le statement pour ne prendre que les promotions actives
                    $date = date("Y-m-d");
                    foreach($dbh->query('SELECT * FROM promotion JOIN ta_promotion_service ON promotion.pk_promotion = ta_promotion_service.fk_promotion AND ta_promotion_service.fk_service = '.$row["pk_service"]
                        . " WHERE date_debut >= " . $date . " AND date_fin <= " . $date) as $row2) {



                        //code pour afficher le prix des promotions
                        ?>
                        <div class="row">
                            <div class='col-6'>
                                <?php print_r("<div class='promo_title'>" . $row2["promotion_titre"]. "</div><br/>"); ?>
                            </div>
                            <div class='col-3'></div>
                            <div class="col-3"><?php print_r("<div class='promo_price'> -". $row2["rabais"] * $row["tarif"]. "$</div><br/>"); ?></div>
                        </div>
                        <?php
                        $rabaisTotal += $row2["rabais"] * $row["tarif"];
                    }
                    ?>

                </div>
            </div>

            <?php $id_service_panier_tableau +=1;?>



        </div>
        <div class='col-1'></div>
    </div>

    <div class="row">
        <hr/>
    </div>


    <?php
    }
    $dbh = null;
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
?>


    <div class="row">
        <hr/>
    </div>

    <div class="row">
        <div class="col-md-6"></div>
        <div class="col-md-3">
            Sous-Total
        </div>
        <div class="col-md-3">
            <?php echo $sousTotal ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6"></div>
        <div class="col-md-3">
            Rabais additionnel
        </div>
        <div class="col-md-3">
            <?php echo $_SESSION["RabaisPromotionnel"] ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6"></div>
        <div class="col-md-3">
            Total
        </div>
        <div class="col-md-3">
            <?php echo $sousTotal - $_SESSION["RabaisPromotionnel"] ?>
        </div>
    </div>

</div>

<footer>
</footer>
</body>