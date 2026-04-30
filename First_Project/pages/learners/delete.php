<?php

session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: ../login.php");
    exit();
}

require "../../config/db.php";

$id= $_GET['id'] ?? null;

if(!$id){
     header("Location: ../dashboard.php");
    exit();
}

$result  = mysqli_query($conn, "SELECT * FROM learners WHERE id = $id");
$learner = mysqli_fetch_assoc($result);

if (!$learner) {
    header("Location: ../dashboard.php");
    exit();
}

$isAdmin = $_SESSION['role'] === 'admin';
$isMine  = $learner['created_by'] == $_SESSION['user_id'];

if (!$isAdmin && !$isMine) {
    echo "<p style='color:red; text-align:center; margin-top:50px;'>
            Access denied. You can only delete learners you created.
          </p>";
    exit();
}

mysqli_query($conn, "DELETE FROM learners WHERE id = $id");

header("Location: ../dashboard.php");
exit();
?>