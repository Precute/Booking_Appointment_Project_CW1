<?php
require_once 'student-connection.php';
     /*WHERE NOT ((end <= :start) OR (start >= :end))*/
$stmt = $db->prepare('SELECT * FROM students');

//$stmt->bindParam(':start', $_POST['start']);
//$stmt->bindParam(':end', $_POST['end']);

$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$result = $stmt->fetchAll();

class Event {}
$allStuds = array();

foreach($result as $row) {
  $e = new Event();
  $e->id = $row['id'];
  $e->surname = $row['surname'];
  $e->forename = $row['forename'];
  $e->middlename = $row['middlename'];
  $e->email = $row['email'];
  $e->phone = $row['phone'];
  $e->address = $row['address'];
  $e->password = $row['password'];
  $allStuds[] = $e;
}

header('Content-Type: application/json');
echo json_encode($allStuds);
?>