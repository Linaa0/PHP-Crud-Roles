<?php

session_start();

include'../config/db.php';

$email= $_POST['email'];
$password=$_POST['password'];

$sql= "SELECT * FROM users WHERE email='$email'";
$result= $conn->query($sql);
$user= $result->fetch_assoc();

if ($user && password_verify($password, $user['password'])){
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['role']= $user['role'];
    $_SESSION['username']= $user['username'];
    header("Location: ../pages/dashboard.php");
    exit();
}else{
    echo "Invalid email or password. <br> Let's Go back to Register or Login";
}
?>

<html>

<a href="../pages/login.php">Login</a>
<a href="../pages/register.php">Register</a>
    </html>