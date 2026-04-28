<!DOCTYPE html>
<html>
<head>
<title>Register</title>
<link rel="stylesheet" href="../styles.css">
</head>

<body>

<div class="container">

<h1>Create Account</h1>

<form action="../includes/register_process.php" method="POST">

<input type="text" name="username" placeholder="Username" required>

<input type="email" name="email" placeholder="Email" required>

<input type="password" name="password" placeholder="Password" required>

<button type="submit">Register</button>

</form>

<br>

<a href="login.php">Already have an account?</a>

</div>

</body>
</html>