<?php
/**
 * Created by PhpStorm.
 * User: Christopher
 * Date: 2017-10-11
 * Time: 2:27 PM
 */

session_start();
// Recoit l'id du service et le mettre dans le panier de la session
$rabais = $_POST['rabais'];

$_SESSION["promoAdditionnelle"] = $rabais;

?>