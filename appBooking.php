<?php

include_once 'connection.php';


if(!isset($_SESSION)) { session_start(); }

$studentID = $_SESSION['user_session'];

$insert = "INSERT INTO bookings (appid, student_id) VALUES (:appid, :student_id)";

$stmt = $db->prepare($insert);

$stmt->bindParam(':appid', $_POST['appid']);
$stmt->bindParam(':student_id', $studentID);

$stmt->execute();

class Result {}

$response = new Result();
$response->result = 'OK';
$response->message = 'Created with id: '.$db->lastInsertId();

$insert = "UPDATE appointments SET availability = :availability WHERE id = :id";

$stmt = $db->prepare($insert);

$stmt->bindParam(':availability', $_POST['availability']);
$stmt->bindParam(':id', $_POST['appid']);

$stmt->execute();

class Result {}

$response = new Result();
$response->result = 'OK';
$response->message = 'Appointment Update successful';

header('Content-Type: application/json');
echo json_encode($response);
ob_end_flush();
?>