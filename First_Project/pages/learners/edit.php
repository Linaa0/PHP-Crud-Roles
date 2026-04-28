<?php 
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: ../login.php");
    exit();
}

require '../../config/db.php';

$id= $_GET['id'] ?? null;

if(!$id){
    header("Location: ../dashboard.php");
    exit();
}

if($_SESSION['role'] !== 'admin' && $id != $_SESSION['user_id']){
    echo "Access denied. You can only edit your own profile.";
    exit();
}

$result= mysqli_query($conn, "SELECT * FROM learners WHERE id= $id");
$learner= mysqli_fetch_assoc($result);

if(!$learner){
    die("Learner not found.");
}

$error="";

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $name= mysqli_real_escape_string($conn, trim($_POST['name']));
     $email= mysqli_real_escape_string($conn, trim($_POST['email']));
      $phone= mysqli_real_escape_string($conn, trim($_POST['phone']));
       $address= mysqli_real_escape_string($conn, trim($_POST['address']));

       $sql= "UPDATE learners SET
       name= '$name',
       email='$email',
       phone='$phone',
       address= '$address'
       WHERE id='$id'
       ";

       if(mysqli_query($conn, $sql)){
        header("Location: ../dashboard.php");
        exit();
       }else{
        $error="Update failed. Try again";
       }

}


       ?>

       <!DOCTYPE html>
<html>
<head>
    <title>Edit Learner</title>
    <link rel="stylesheet" href="../../styles.css">
</head>
<body>
  <div class="container">
<h1>Edit Learner</h1>
<p class="subtitle">Fill in the details below</p>

<?php if ($error): ?>
    <div class="alert alert-error"><?= $error ?></div>
<?php endif; ?>

<form method="POST">
    <div class="form-group">
    <label>Name:</label><br>
    <input type="text" name="name" value="<?= htmlspecialchars($learner['name']) ?>" required>
</div>
     
 <div class="form-group">
    <label>Email:</label><br>
    <input type="email" name="email" value="<?= htmlspecialchars($learner['email']) ?>" required>
     </div>
     
     <div class="form-group">
    <label>Phone:</label><br>
    <input type="text" name="phone" value="<?= htmlspecialchars($learner['phone']) ?>">
</div>

<div class="form-group">
    <label>Address:</label><br>
    <input type="text" name="address" value="<?= htmlspecialchars($learner['address']) ?>">
</div>

    <button type="submit">Update Learner</button>
    <div class="divider">or</div>
    <a href="../dashboard.php" class="btn btn-secondary btn-full">Cancel</a>
</form>
</div>
</body>
</html>