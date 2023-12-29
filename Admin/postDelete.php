<?php
include "../database/connect.php";
session_start();


if(isset($_GET['id']) && !empty($_GET['id'])){

$id = trim($_GET['id']);

$sql = " DELETE FROM post WHERE id=:id";
$stmp = $conn->prepare($sql);
$stmp->bindParam(':id',$id,PDO::PARAM_INT);
$stmp->execute();



    /*select post image for delete */
    $sql = "SELECT * FROM post WHERE id=:id";
    $selectStmt = $conn->prepare($sql);
    $selectStmt->bindParam(':id', $id, PDO::PARAM_INT);
    $selectStmt->execute();
    $row = $selectStmt->fetch(PDO::FETCH_OBJ);
    print_r($row);
    if (isset($row->image)){
        unlink($row->image);}



$_SESSION['success'] = 'post delete successfully';
header('location:post.php');

}




?>