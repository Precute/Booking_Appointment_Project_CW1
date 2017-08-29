<?php
require_once 'connection.php';
     /*WHERE NOT ((end <= :start) OR (start >= :end))*/
$stmt = $db->prepare('SELECT * FROM bookings WHERE appid = :bookingid');

$stmt->bindParam(':bookingid', $_POST['bookingid']);

//$stmt->bindParam(':start', $_POST['start']);
//$stmt->bindParam(':end', $_POST['end']);

$stmt->execute();
$result = $stmt->fetchAll();

class Event {}
$events = array();

foreach($result as $row) {
    $e = new Event();
  $e->bookingid = $row['bookingid'];
  $e->appid = $row['appid'];
  $e->student_id = $row['student_id'];
  $events[] = $e;
}

header('Content-Type: application/json');
echo json_encode($events);
error_log(json_encode($events));
?>