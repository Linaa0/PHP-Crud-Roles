<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: ../login.php");
    exit();
}

if ($_SESSION['role'] !== 'admin') {
    echo "Access denied. Admins only.";
    exit();
}

require "../../config/db.php";

$error= "";

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $name= mysqli_real_escape_string($conn, trim($_POST['name']));
    $email= mysqli_real_escape_string($conn, trim($_POST['email']));
    $phone= mysqli_real_escape_string($conn, trim($_POST['phone']));
    $address= mysqli_real_escape_string($conn, trim($_POST['address']));

    $check= mysqli_query($conn, "SELECT id FROM learners WHERE email= '$email'");

    if(mysqli_num_rows($check)>0){
        $error= "Email already exists.";
            } 
            else {
                $sql= "INSERT INTO learners(name, email, phone, address)
                VALUES
                ('$name', '$email', '$phone', '$address')";

                if (mysqli_query($conn, $sql)){
                    header("Location: ../dashboard.php");
                    exit();
                }else{
                    $error= "Something went wrong. Try again";
                }
            }
}
            ?>


<!DOCTYPE html>
<html>
<head>
    <title>Add Learner</title>
     <link rel="stylesheet" href="../../styles.css">
</head>
<body>

    <div class="container">

<h1>Add New Learner</h1>

<?php if ($error): ?>
    <div class="alert alert-error"><?= $error ?></div>
<?php endif; ?>

<form method="POST">
    <div class="form-group">
    <label>Name:</label><br>
    <input type="text" name="name" placeholder="Enter full name" required>
</div>

<div class="form-group">
    <label>Email:</label><br>
    <input type="email" name="email" placeholder="Enter email" required>
</div>

<div class="form-group">
    <label>Phone:</label><br>
    <input type="text" name="phone" placeholder="Enter phone number">
</div>

<div class="form-group">
    <label>Address:</label><br>
    <input type="text" name="address" placeholder="Enter address">
</div>

    <button type="submit" class="btn-full">Save Learner</button>
    <div class="divider">or</div>
    <a href="../dashboard.php" class="btn btn-secondary btn-full">Cancel</a>
</form>
</div>
</body>
</html>