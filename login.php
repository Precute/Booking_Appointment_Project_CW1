<?php
 session_start();
  require_once 'connection.php';
if(isset($_POST['btn-login']))
 {
  $user_email = trim($_POST['user_email']);
  $user_password = trim($_POST['password']);
  
  $password = md5($user_password);
  
  try
  { 
  
   $stmt = $db->prepare("SELECT * FROM tbl_users WHERE user_email=:email");
   $stmt->execute(array(":email"=>$user_email));
   $row = $stmt->fetch(PDO::FETCH_ASSOC);
   $count = $stmt->rowCount();
   
   if($row['user_password']==$password){
    
    echo "ok"; // log in
    $_SESSION['user_session'] = $row['student_id'];
    $_SESSION['user_email'] = $row['user_email'];
   }
   else{
    
    echo "Email or password does not exist."; // wrong details 
   }
    
  }
  catch(PDOException $e){
   echo $e->getMessage();
  }
 }

?>