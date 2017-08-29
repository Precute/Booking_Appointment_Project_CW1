<?php
$dbhost = 'mysql:host=mudfoot.doc.stu.mmu.ac.uk;dbname=igbinoso' ; // the database host
$dbuser = 'igbinoso' ; 
$dbpass = 'jesSplam6' ; // password

//$dbhost = 'mysql:host=127.0.0.1;dbname=test';
//$dbname = 'root';
//$dbpass = 'password';
try{
$db = new PDO($dbhost,$dbuser,$dbpass);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
error_log("Connected to Database");
    //create the database
    $db->exec("CREATE TABLE IF NOT EXISTS students (
                        id INTEGER AUTO_INCREMENT,
                        surname TEXT,
                        forename TEXT,
                        middlename TEXT,
                        email TEXT,
                        phone TEXT,
                        address TEXT,
                        password TEXT,
                        PRIMARY KEY(id));
    ALTER TABLE students AUTO_INCREMENT=105;");
    }
catch(PDOException $e)
    {
    echo $e->getMessage();
    }   
?>