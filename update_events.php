<?php
ob_start();
require_once 'connection.php';

$update = "UPDATE appointments SET start= :start, end = :end WHERE id = :id";


$stmt = $db->prepare($update);

$stmt->bindParam(':start', $_POST['start']);
$stmt->bindParam(':end', $_POST['end']);
$stmt->bindParam(':id', $_POST['id']);

$stmt->execute();

class Result {}

$response = new Result();
$response->result = 'OK';

header('Content-Type: application/json');
echo json_encode($response);
ob_end_flush();
?>
