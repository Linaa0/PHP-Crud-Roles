<?php
$host= "localhost";
$user="root";
$password="your_password_here";
$database="auth_db";

$conn= new mysqli($host, $user, $password, $database);

if($conn->connect_error){
    die("Connection Failed: ". $conn->connect_error);
}

?>