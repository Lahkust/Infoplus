<?php
/**
 * Created by PhpStorm.
 * User: Christopher
 * Date: 2017-10-11
 * Time: 2:27 PM
 */

require_once '../Objects/Connection.php';
session_start();

$_SESSION["panier2"] = $_SESSION["panier"];
$_SESSION["panier"] = array();
$_SESSION["RabaisPromotionnel2"] = $_SESSION["RabaisPromotionnel"];
$_SESSION["RabaisPromotionnel"] = 0;
$_SESSION["promoAdditionnelle"] = 0;

$dbh1 = db_connect();

$stmt = $dbh1->prepare('SELECT courriel FROM utilisateur WHERE pk_utilisateur = :id');

$stmt->execute(['id' => $_SESSION['pk_utilisateur']]);
$result = $stmt->fetch();

$courriel = $result["courriel"];


// the message
$msg = "Merci pour votre achat!\nVoici les directives pour vos services.";

// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);

// send email
mail($courriel, "infosPlusPlus",$msg);

$dbh1 = null;
?>