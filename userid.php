<?php
ob_start();
session_start();
$userid = $_SESSION['user_session'];
echo $userid;
ob_end_flush();
?>