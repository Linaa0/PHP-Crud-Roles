<?php

session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: ../login.php");
    exit();
}

if($_SESSION['role'] !== 'admin'){
    echo "Access denied. Admins only.";
}

require "../../config/db.php";

$id= $_GET['id'] ?? null;

if($id){
    mysqli_query($conn, "DELETE FROM learners WHERE id= $id");
}

header("Location: ../dashboard.php");
exit();
?>