<?php

define("db_host","localhost");
define("db_user","root");
define("db_pass","");
define("db_name","pwds26");



// $conn = mysqli_connect(db_host,db_user,db_pass,db_name);

// if(!$conn){
//     die("database connection is faild").mysqli_connect_error();
// }

// echo "your database connection is successfully";

// oop connection 


// $conn = new mysqli(db_host,db_user,db_pass,db_name);

// if(!$conn){
//     die("database connection is faild").$conn->connect_error();
// }

// echo "your database connection is successfully";



// pdo connection

try {
$conn = new PDO("mysql:host=".db_host.";dbname=".db_name,db_user,db_pass);
$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
//  echo "your Database connection is successfully";
}
catch(PDOException $e){
die('database connection is faid');
}


?>