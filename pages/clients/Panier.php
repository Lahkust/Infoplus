<?php/**************************************************************************************************/
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
?>
<!doctype HTML>
<html lang="fr">
<?php	 session_start();
require_once '../../Objects/Connection.php';
$dbh = db_connect();

?>

<head>
    <meta charset="utf-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="../../styles/style.css"/>
    <script src="../../scripts/GestionPromotions.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>


    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

</head>

<header>
    <?php include_once '../Entete.php' ?>
</header>

<body>

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

            <div class='service_entry col-10'>

                <!-- articles -->
                <div class='row'>

                    <div class='col-3'>
                        <?php print_r("<img src='../../images/services/" . $row["image"]. ".png' class='img_service'/><br/>"); ?>
                    </div>

                    <div class='col-9'>

                        <div class='row'>
                            <div class='col-6'>
                                <?php print_r("<div class='service_title'>" . $row["service_titre"]. "</div><br/>"); ?>
                            </div>
                            <div class='col-3'></div>
                            <div class="col-3"><?php print_r("<div class='service_price'>Tarif : " . $row["tarif"]. "$</div><br/>"); ?></div>
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
                <div class="row">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-9">
                            </div>
                            <div class="col-md-3">
                                <a href="#" id="retirer_service_<?php echo $id_service_panier_tableau?>">Retirer</a>
                                <?php $id_service_panier_tableau +=1;?>
                            </div>
                        </div>
                    </div>
                </div>




            </div>
            <div class='col-1'></div>
        </div>

        <div class='row'>
            <div class='col-12'></div>
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

    <div class='col-1'></div>

    <div class='col-10'>
        <div class="row">

                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <h5>Entrer le code additionnel pour un rabais promotionnel</h5>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-group">
                                <span class="input-group-addon">Code promotionnel</span>
                                <input id="codepromo" type="text" class="form-control" name="codePromo" placeholder="CODE">
                            </div>
                            <button type="button" class="btn btn-secondary btn-lg btn-block" id="btn_promo">Ajouter</button>
                        </div>

                    </div>

                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row" id="sousTotal">Sous-total: <?php echo $_SESSION["sousTotal"] = $sousTotal?></div>
                                <div class="row">Promotions: <?php echo $rabaisTotal?></div>
                                <div class="row" id="promoAddtionnelle">Rabais additionnel: <?php echo $_SESSION["RabaisPromotionnel"] = $_SESSION["sousTotal"] * $_SESSION["promoAdditionnelle"];?></div>
                                <div class="row">Total: <?php echo $_SESSION["Total"] = $sousTotal - $rabaisTotal - $_SESSION["RabaisPromotionnel"];?></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-secondary btn-lg btn-block" id="btn_payer">Payer</button>
                            </div>
                        </div>

                    </div>

        </div>
    </div>

    <div class='col-1'></div>
</div>

<div id="paypal-button"></div>
<script>
    paypal.Button.render({
        env: 'sandbox',  // Or 'sandbox'
        client: {
            sandbox:    'AVTdCibv8td2mvA40JE5nY0NDKY8CbRkc6vE9sYG8Buhn_lQ2RKJUYyKCmBFyt-O89zrVPNCdqQUsIKo',
            production: '<insert production client id>'
        },
        commit: true,       // Show 'Pay Now' button
        payment: function(data, actions) {
            return actions.payment.create({
                payment: {
                    transactions: [
                        {
                            amount: { total: <?php echo $_SESSION["Total"]; ?>, currency: 'CAD' }
                        }
                    ]
                }
            });
        },
        onAuthorize: function (data, actions) {
            /*return actions.payment.execute().then(function() {
                //location.href = 'Confirmation.php';
            });*/
            // Get the payment details

            location.href = 'Confirmation.php';

        },

        onCancel: function(data, actions) {
            // Show a cancel page or return to cart
            location.href = 'Annulation.php';
        }

    }, '#paypal-button');
</script>

</body>
<script type="text/javascript">

    $(document).ready(function() {

            //rabais promotionnel
            //click sur boutton valider
            $("#btn_promo").click(function (event) {

                //Vérifier si un rabais a été appliqué
                var myElement = document.getElementById("promoAddtionnelle");
                console.log(myElement.innerText);
                var res = myElement.innerText.split(" ");
                console.log(res[2]);

                if ( res[2] === "0")
                {

                    //Aller chercher la valeur du code promontionnel
                    var promo = document.getElementById("codepromo");
                    console.log(promo.value);

                    //string qui contient id du service pour l'envoyer dans la rqt ajax
                    var dataString = {'rabais': promo.value};

                    $.ajax({
                        type: "POST",
                        url: "../../scripts/ajouterRabais.php",
                        data: dataString,
                        success: function (data) {
                            console.log("sortie rqt : " + data);
                            if (data != "0") {
                                var result = JSON.parse(data);

                                var rabais = result.rabais;
                                console.log(rabais);

                                //Calculer le rabais
                                /*var STString = document.getElementById("sousTotal").innerText;
                                var res = STString.split(" ");
                                var soustotal = parseFloat(res[1]);
                                console.log(soustotal);
                                rabais = parseFloat(rabais);
                                rabais = soustotal * rabais;*/

                                //Afficher nouveau total
                                $.post("../../scripts/MontantRabais.php", {"rabais": rabais});

                                location.reload();
                                alert("Rabais valide!");
                            }
                            else
                                alert("Rabais refusé!");
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            alert(JSON.stringify(jqXHR) + " " + textStatus + " " + errorThrown);
                            //alert("error occurred");
                        }
                    });

                } else
                    alert("1 rabais par achat!");
            });

    });

    //Retirer un service
    $(document).on('click', "a[id^='retirer_service_']", function(){

        //Aller chercher l'id du service
        var IdPanier = event.target.id;
        console.log(IdPanier);
        var res = IdPanier.split("_");
        console.log(res[2]);

        $.post("../../scripts/RetirerServicePanier.php", {"id_service": res[2]});
        location.reload();

    });


</script>
<footer>
</footer>

</html>