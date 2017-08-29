<?php
require_once 'connection.php';
     /*WHERE NOT ((end <= :start) OR (start >= :end))*/
$stmt = $db->prepare('SELECT * FROM appointments');

//$stmt->bindParam(':start', $_POST['start']);
//$stmt->bindParam(':end', $_POST['end']);

$stmt->execute();
$result = $stmt->fetchAll();

class Event {}
$events = array();

foreach($result as $row) {
  $e = new Event();
  $e->id = $row['id'];
  $e->title = $row['title'];
  $e->start = $row['start'];
  $e->end = $row['end'];
  $e->apptype = $row['apptype'];
  $e->availability = $row['availability'];
  $events[] = $e;
}

header('Content-Type: application/json');
echo json_encode($events);
error_log(json_encode($events));
?>