<?php
/**
 * Created by PhpStorm.
 * User: Christopher
 * Date: 2017-10-11
 * Time: 2:27 PM
 */

require_once '../Objects/Connection.php';

$dbh1 = db_connect();

$id = $_POST['id'];

$stmt = $dbh1->prepare('SELECT * FROM service a WHERE a.pk_service=:id');

$stmt->execute(['id' => $id]);
$result = $stmt->fetch();

echo json_encode($result);

$dbh1 = null;
?>