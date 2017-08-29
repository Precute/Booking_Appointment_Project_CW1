<?php
require_once 'student-connection.php';


 if($_POST)
 {
  $surname = $_POST['student-surname'];
  $forename = $_POST['student-fname'];
  $middlename = $_POST['student-mname'];
  $phone = $_POST['student-phone'];
  $address = $_POST['student-address'];
  $user_email = $_POST['student-email'];
  $user_password = md5($_POST['student-password']);

  try
  { 
  	 $stmt = $db->prepare("SELECT MAX(id)+1 AS max FROM STUDENTS");
   $stmt->execute();
   $user_id = $stmt->fetch(PDO::FETCH_OBJ)->max;
   if ($user_id < 100){
    $user_id=100;
   }

   $stmt = $db->prepare("SELECT * FROM tbl_users WHERE user_email=:email");
   $stmt->execute(array(":email"=>$user_email));
   $count = $stmt->rowCount();
   
   if($count==0){
   $stmt = $db->prepare("INSERT INTO students(id, surname, forename, middlename, email, phone, address, password) 
			VALUES (:id, :surname, :forename, :middlename, :email, :phone, :address, :password)");
   $stmt->bindParam(":id",$user_id);
   $stmt->bindParam(":middlename",$middlename);
   $stmt->bindParam(":surname",$surname);
   $stmt->bindParam(":forename",$forename);
   $stmt->bindParam(":email",$user_email);
   $stmt->bindParam(":phone",$phone);
   $stmt->bindParam(":address",$address);
   $stmt->bindParam(":password",$user_password);

    if($stmt->execute())
    {
     echo "added";
    }
    else
    {
     echo "Query could not execute!";
    }
   $stmt = $db->prepare("INSERT INTO tbl_users (user_name, user_email, user_password, student_id) 
			VALUES (:email, :user, :password, :uid)");
   $stmt->bindParam(":email",$user_email);
   $stmt->bindParam(":user",$user_email);
   $stmt->bindParam(":password",$user_password);
   $stmt->bindParam(":uid",$user_id);
   
    if($stmt->execute())
    {
     echo "registered";
    }
    else
    {
     echo "Query could not execute!";
    }
   
   }
   else{
    
    echo "Email already in use"; //  not available
   }
    
  }
  catch(PDOException $e){
       echo $e->getMessage();
  }
 }



/*

$insert = "INSERT INTO students (surname, forename, middlename, email, phone, address, password) 
			VALUES (:surname, :forename, :middlename, :email, :phone, :address, :password)";
                       

$stmt = $db->prepare($insert);

$stmt->bindParam(':surname', $_POST['student-surname']);
$stmt->bindParam(':forename', $_POST['student-fname']);
$stmt->bindParam(':middlename', $_POST['student-mname']);
$stmt->bindParam(':email', $_POST['student-email']);
$stmt->bindParam(':phone', $_POST['student-phone']);
$stmt->bindParam(':address', $_POST['student-address']);
$stmt->bindParam(':password', $_POST['student-password']);
$stmt->execute();


$student_id = $db->lastInsertId('students');


$insert = "INSERT INTO tbl_users (user_name, user_email, user_password, student_id) 
			VALUES (:email, :email, :password, :id)";
                       

$stmt = $db->prepare($insert);

$stmt->bindParam(':id', $student_id);
$stmt->execute();


$response = new Result();
$response->result = 'OK';

//header('Content-Type: application/json');
echo $response;
*/
?>
