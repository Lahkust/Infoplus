<?php
/**
 * Created by PhpStorm.
 * User: Christopher
 * Date: 2017-10-11
 * Time: 2:27 PM
 */

require_once '../Objects/Connection.php';

$dbh1 = db_connect();

$nom = $_POST['nom'];
$prenom = $_POST['prenom'];

$stmt = $dbh1->prepare('SELECT * FROM client a JOIN adresse b on a.fk_adresse=b.pk_adresse join ville c
                        on b.fk_ville=c.pk_ville WHERE a.nom=:nom AND a.prenom=:prenom');

$stmt->execute(['nom' => $nom, 'prenom' => $prenom]);
$result = $stmt->fetch();

echo json_encode($result);

$dbh1 = null;
?>