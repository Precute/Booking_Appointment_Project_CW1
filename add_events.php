<?php
ob_start();
require_once 'connection.php';

$insert = "INSERT INTO appointments (title, start, end, apptype, availability) 
			VALUES (:title, :start, :end, :apptype, :availability)";

$stmt = $db->prepare($insert);

$stmt->bindParam(':start', $_POST['start']);
$stmt->bindParam(':end', $_POST['end']);
$stmt->bindParam(':title', $_POST['title']);
$stmt->bindParam(':apptype', $_POST['apptype']);
$stmt->bindParam(':availability', $_POST['availability']);
$stmt->execute();

class Result {}

$response = new Result();
$response->result = 'OK';
$response->message = 'Created with id: '.$db->lastInsertId();

header('Content-Type: application/json');
echo json_encode($response);
ob_end_flush();
?>
