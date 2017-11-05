<?php
/**
 * Created by PhpStorm.
 * User: Christopher
 * Date: 2017-10-11
 * Time: 2:27 PM
 */

require_once '../Objects/Connection.php';

$dbh1 = db_connect();
$rabais = $_POST['rabais'];
$result = 0;

$stmt = $dbh1->prepare('SELECT fk_promotion FROM ta_promotion_service a WHERE a.code =:rabais');

$stmt->execute(['rabais' => $rabais]);
$rqt = $stmt->fetch();

if ($rqt["fk_promotion"] != "")
{
    $stmt = $dbh1->prepare('SELECT rabais FROM promotion a join ta_promotion_service b on a.pk_promotion = b.fk_promotion WHERE b.fk_promotion=:id');

    $stmt->execute(['id' => $rqt["fk_promotion"]]);
    $result = $stmt->fetch();
}

echo json_encode($result);

$dbh1 = null;
?>