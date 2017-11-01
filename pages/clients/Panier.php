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

                            <?php
                            $promos;
                            //TODO: modifier le statement pour ne prendre que les promotions actives
                            foreach($dbh->query('SELECT * FROM promotion JOIN ta_promotion_service ON promotion.pk_promotion = ta_promotion_service.fk_promotion AND ta_promotion_service.fk_service = '.$row["pk_service"]) as $row2) {

                                $promos[$row2["pk_promotion_service"]] = new Promotion($row2);

                                //TODO: code pour afficher le prix des promotions

                                $rabaisTotal += $row2["rabais"] * $row["tarif"];
                            }
                            ?>

                        </div>
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
                                <?php $id_service_panier_tableau +=1; ?>
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
                                <div class="row">Sous-total: <?php echo $sousTotal?></div>
                                <div class="row">Promotions: <?php echo $rabaisTotal?></div>
                                <div class="row">Rabais additionnel: <?php echo $promoAdditionnelle?></div>
                                <div class="row">Total: <?php echo $sousTotal - $rabaisTotal - $promoAdditionnelle?></div>
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

<!-- The Modal -->
<div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content" id="requete">
        //contenu de la fenetre modale
    </div>

</div>

</body>
<script type="text/javascript">

    //fenetre modale
    var modal = document.getElementById('myModal');

    $(document).ready(function() {
        //Gestion des services
        /*$("#ajouterService").click(function() {
            modal.style.display = "block";
            //var string = "include '../administrateurs/GestionService.php';
            //$("#ajouterService").html(string);
        });*/

        //Fenetre pour ajouter au panier un service
        $("img[id^='ajouterPanier']").click(function (event) {

            //Aller rechercher l'id complet de l'image cliquer
            var IdPanier = event.target.id;
            console.log(IdPanier);

            //separer la string pour avoir l'id
            var res = IdPanier.split("_");
            console.log(res[1]);

            //string qui contient id du service pour l'envoyer dans la rqt ajax
            var dataString = {'id': res[1]};

            //Faire apparaitre notre fenetre modale
            modal.style.display = "block";

            $.ajax({
                type:"POST",
                url:"../../scripts/InfoService.php",
                data: dataString,
                success: function(data){
                    var result = JSON.parse(data);

                    var string = "<div class='row'>" + "<div class='col-md-10'>" + result.service_titre + "</div>" +
                        "<div class='col-md-2'>" + result.tarif + "</div>" + "</div>" + "<div class='row'>" +
                        "<div class='col-md-12'>" + result.service_description + "</div>" + "</div>" + "<div class='row'>" +
                        "<div class='col-md-12'>" + "<a href='#' id='panierService_" + result.pk_service + "'" + ">Ajouter au panier</a>" + "</div>" + "</div>";



                    $("#requete").html(string);
                },
                error: function(jqXHR,textStatus,errorThrown){
                    alert(JSON.stringify(jqXHR)+" "+textStatus+" "+errorThrown);
                    //alert("error occurred");
                }
            });
        });

        //$().on('click', function(event) {
        $(document).on('click', "a[id^='panierService_']", function(){

            //Aller chercher l'id du service
            var IdPanier = event.target.id;
            console.log(IdPanier);
            var res = IdPanier.split("_");
            console.log(res[1]);

            $.post("../../scripts/AjouterServicePanier.php", {"id_service": res[1]});
            location.reload();
        });

    });

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }


</script>
<footer>
</footer>

</html>