<?php
include "../database/connect.php";
session_start();


if(isset($_GET['id']) && !empty($_GET['id'])){

$id = trim($_GET['id']);
$sql = " DELETE FROM tag WHERE id=:id";
$stmp = $conn->prepare($sql);
$stmp->bindParam(':id',$id,PDO::PARAM_INT);
$stmp->execute();
$_SESSION['success'] = 'tag delete successfully';
header('location:tag.php');

}




?>