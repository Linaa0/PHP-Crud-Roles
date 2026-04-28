<?php
session_start();

if(!isset($_SESSION['user_id'])){
header("Location: login.php");
exit();
}

require '../config/db.php';

$isadmin= $_SESSION['role']==='admin';

$result= mysqli_query($conn, "SELECT *FROM learners");

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>
<link rel="stylesheet" href="../styles.css">
</head>

<body>

<div class="dashboard">
<div class="dashboard-header">
<h1>Welcome To Your Dashboard, <?= htmlspecialchars($_SESSION['username'])?>
<span style="font-size:14px; color:#7aafc8;">(<?= $_SESSION['role'] ?>)</span>
</h1>

<div class="header-actions">
    <?php if ($isadmin):?>
<a href="learners/create.php" class="btn btn-success">+ Add Learner</a>
<?php endif; ?>
<a href="../includes/logout.php" class="logout-link" >Logout</a>
</div>
</div>

<?php if(mysqli_num_rows($result)>0): ?>
    <div class="table-wrapper">

    <table>
        <thead>
        <tr>
            <th>ID</th>
                <th>Name</th>
                 <th>Email</th>
                  <th>Phone</th>
                   <th>Address</th>
                    <th>Created at: </th>
                     <th>Actions</th>
        </tr>
</thead>
<tbody>

 <?php 
 $counter = 1; 
 while($learner= mysqli_fetch_assoc($result)): ?>
    <tr>
    <td><?= $counter++ ?></td>
    <td><?= htmlspecialchars($learner['name']) ?></td>
     <td><?= htmlspecialchars($learner['email']) ?></td>
      <td><?= htmlspecialchars($learner['phone']) ?></td>
       <td><?= htmlspecialchars($learner['address']) ?></td>
        <td><?= $learner['created_at'] ?></td>
        <td>
            <div class="table-actions">
                <?php
                $canEdit= $isadmin || $learner['id'] == $_SESSION['user_id'];
                ?>

                <?php if ($canEdit): ?>
                <a href="learners/edit.php?id=<?=$learner['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                <?php endif; ?>

                <?php if($isadmin): ?>
            <a href="learners/delete.php? id=<?=$learner['id'] ?>" class="btn btn-danger btn-sm"
            onclick="return confirm('Delete this learner?')">Delete</a>
            <?php endif; ?>
 </div>
        </td>
    </tr>  

    <?php endwhile; ?>
 </tbody>
 </table>  
 <?php else: ?>
    <p>No learners found. Add one!</p>
    <?php endif; ?>


</div>

</body>
</html>