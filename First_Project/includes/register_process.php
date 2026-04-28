<?php
include'../config/db.php';
$username= $_POST['username'];
$email= $_POST['email'];
$password= $_POST['password'];

$hashed= password_hash($password, PASSWORD_DEFAULT);

$sql= "INSERT INTO users(username,email,password)
VALUES
('$username',
'$email',
'$hashed')
";

if($conn->query($sql)== TRUE){
    echo "Registration successfully! Redirecting to Login...";
    header("Refresh:3; URL= ../pages/login.php");
    exit();
}else{
    echo "Error: ". $conn->error;
}

?>