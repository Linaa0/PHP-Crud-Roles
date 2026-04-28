<?php
include'connection.php';
if(isset($_POST['submit'])){
    $first_name= $_POST['fname'];
     $last_name= $_POST['lname'];
      $email= $_POST['email'];
      $gender= $_POST['gender'];
      $password= md5($_POST['password']);

      $sql= "INSERT INTO users(fname,lname, email, password, gender) 
      VALUES 
      ('$first_name',
      '$last_name',
      '$email',
      '$password',
      '$gender')";

      $result= $conn->query($sql);

      if($result == true){
        echo "New record inserted successfully";
      }else{
        echo 'Error: '.sql.'<br>'.$conn->error;
      }

      $conn->close();

}
?>

<html>
<a class="btn btn info" href="signup.html">Back</a>
<a class= "btn btn info" href="read.php">Back</a>

</html>

?>